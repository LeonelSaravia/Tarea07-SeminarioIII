<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Redirigir al welcome (página principal)
        return redirect()->to(base_url('/welcome'));
    }

    public function perfil()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $data = [
            'titulo' => 'Mi Perfil',
            'usuario' => [
                'nombres' => session()->get('nombres'),
                'apellidos' => session()->get('apellidos'),
                'nomusuario' => session()->get('nomusuario'),
                'avatar' => session()->get('avatar'),
                'nivelacceso' => session()->get('nivelacceso')
            ]
        ];

        return view('dashboard/perfil', $data);
    }

    public function editarPerfil()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $data = [
            'titulo' => 'Editar Mi Perfil',
            'usuario' => [
                'nombres' => session()->get('nombres'),
                'apellidos' => session()->get('apellidos'),
                'nomusuario' => session()->get('nomusuario'),
                'avatar' => session()->get('avatar'),
                'nivelacceso' => session()->get('nivelacceso')
            ]
        ];

        return view('dashboard/editar_perfil', $data);
    }

    public function actualizarPerfil()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $session = session();
        $usuarioModel = new \App\Models\Usuario();
        $userId = session()->get('id');
        
        // Obtener datos del formulario
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $nomusuario = $this->request->getPost('nomusuario');
        $claveacceso = $this->request->getPost('claveacceso');

        // Validar que se enviaron los datos
        if (empty($nombres) || empty($apellidos) || empty($nomusuario)) {
            $session->setFlashdata('error', 'Los campos obligatorios son requeridos');
            return redirect()->to(base_url('/perfil/editar'));
        }

        // Verificar si el nombre de usuario ya existe (excepto para el usuario actual)
        $userExistente = $usuarioModel->getUser($nomusuario);
        if ($userExistente && $userExistente['id'] != $userId) {
            $session->setFlashdata('error', 'El nombre de usuario ya existe');
            return redirect()->to(base_url('/perfil/editar'));
        }

        // Preparar datos para actualizar
        $data = [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'nomusuario' => $nomusuario,
            'update_at' => date('Y-m-d H:i:s')
        ];

        // Solo actualizar contraseña si se proporcionó una nueva
        if (!empty($claveacceso)) {
            $data['claveacceso'] = password_hash($claveacceso, PASSWORD_DEFAULT);
        }

        // Manejar subida de avatar
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validar tipo de archivo
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($file->getMimeType(), $allowedTypes)) {
                // Validar tamaño (máximo 2MB)
                if ($file->getSize() <= 2097152) {
                    // Generar nombre único
                    $newName = 'avatar_' . $userId . '_' . time() . '.' . $file->getExtension();
                    
                    // Mover archivo
                    if ($file->move(ROOTPATH . 'public/images/user/', $newName)) {
                        // Eliminar avatar anterior si no es default.jpg
                        $avatarAnterior = session()->get('avatar');
                        if ($avatarAnterior && $avatarAnterior != 'default.jpg') {
                            $pathAnterior = ROOTPATH . 'public/images/user/' . $avatarAnterior;
                            if (file_exists($pathAnterior)) {
                                unlink($pathAnterior);
                            }
                        }
                        
                        $data['avatar'] = $newName;
                    } else {
                        $session->setFlashdata('error', 'Error al subir la imagen');
                        return redirect()->to(base_url('/perfil/editar'));
                    }
                } else {
                    $session->setFlashdata('error', 'La imagen es demasiado grande. Máximo 2MB');
                    return redirect()->to(base_url('/perfil/editar'));
                }
            } else {
                $session->setFlashdata('error', 'Formato de imagen no válido. Use JPG, PNG o GIF');
                return redirect()->to(base_url('/perfil/editar'));
            }
        }

        if ($usuarioModel->update($userId, $data)) {
            // Actualizar datos en la sesión
            $session->set([
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'nomusuario' => $nomusuario,
                'avatar' => $data['avatar'] ?? session()->get('avatar')
            ]);

            $session->setFlashdata('success', 'Perfil actualizado exitosamente');
            return redirect()->to(base_url('/perfil'));
        } else {
            $session->setFlashdata('error', 'Error al actualizar el perfil');
            return redirect()->to(base_url('/perfil/editar'));
        }
    }
}