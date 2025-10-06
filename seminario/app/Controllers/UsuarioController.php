<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class UsuarioController extends BaseController
{
    public function index()
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->findAll();

        $data = [
            'titulo' => 'Gestión de Usuarios',
            'usuarios' => $usuarios,
            'usuario' => [
                'nombres' => session()->get('nombres'),
                'apellidos' => session()->get('apellidos'),
                'nomusuario' => session()->get('nomusuario'),
                'avatar' => session()->get('avatar'),
                'nivelacceso' => session()->get('nivelacceso')
            ]
        ];

        return view('usuario/index', $data);
    }

    public function crear()
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $data = [
            'titulo' => 'Crear Nuevo Usuario',
            'usuario' => [
                'nombres' => session()->get('nombres'),
                'apellidos' => session()->get('apellidos'),
                'nomusuario' => session()->get('nomusuario'),
                'avatar' => session()->get('avatar'),
                'nivelacceso' => session()->get('nivelacceso')
            ]
        ];

        return view('usuario/crear', $data);
    }

    public function guardar()
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $session = session();
        
        // Obtener datos del formulario
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $nomusuario = $this->request->getPost('nomusuario');
        $claveacceso = $this->request->getPost('claveacceso');
        $nivelacceso = $this->request->getPost('nivelacceso');

        // Validar que se enviaron los datos
        if (empty($nombres) || empty($apellidos) || empty($nomusuario) || empty($claveacceso)) {
            $session->setFlashdata('error', 'Todos los campos son requeridos');
            return redirect()->to(base_url('/usuario/crear'));
        }

        // Verificar si el usuario ya existe
        $usuarioModel = new Usuario();
        $userExistente = $usuarioModel->getUser($nomusuario);
        
        if ($userExistente) {
            $session->setFlashdata('error', 'El nombre de usuario ya existe');
            return redirect()->to(base_url('/usuario/crear'));
        }

        // Crear nuevo usuario
        $data = [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'nomusuario' => $nomusuario,
            'claveacceso' => password_hash($claveacceso, PASSWORD_DEFAULT),
            'avatar' => 'default.jpg',
            'nivelacceso' => $nivelacceso ?: 'USER',
            'create_at' => date('Y-m-d H:i:s')
        ];

        if ($usuarioModel->insert($data)) {
            $session->setFlashdata('success', 'Usuario creado exitosamente');
            return redirect()->to(base_url('/usuario'));
        } else {
            $session->setFlashdata('error', 'Error al crear el usuario');
            return redirect()->to(base_url('/usuario/crear'));
        }
    }

    public function editar($id)
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->find($id);

        if (!$usuario) {
            session()->setFlashdata('error', 'Usuario no encontrado');
            return redirect()->to(base_url('/usuario'));
        }

        $data = [
            'titulo' => 'Editar Usuario',
            'usuario_edit' => $usuario,
            'usuario' => [
                'nombres' => session()->get('nombres'),
                'apellidos' => session()->get('apellidos'),
                'nomusuario' => session()->get('nomusuario'),
                'avatar' => session()->get('avatar'),
                'nivelacceso' => session()->get('nivelacceso')
            ]
        ];

        return view('usuario/editar', $data);
    }

    public function actualizar($id)
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $session = session();
        
        // Obtener datos del formulario
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $nomusuario = $this->request->getPost('nomusuario');
        $claveacceso = $this->request->getPost('claveacceso');
        $nivelacceso = $this->request->getPost('nivelacceso');

        // Validar que se enviaron los datos
        if (empty($nombres) || empty($apellidos) || empty($nomusuario)) {
            $session->setFlashdata('error', 'Los campos obligatorios son requeridos');
            return redirect()->to(base_url('/usuario/editar/' . $id));
        }

        $usuarioModel = new Usuario();
        
        // Preparar datos para actualizar
        $data = [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'nomusuario' => $nomusuario,
            'nivelacceso' => $nivelacceso ?: 'USER',
            'update_at' => date('Y-m-d H:i:s')
        ];

        // Solo actualizar contraseña si se proporcionó una nueva
        if (!empty($claveacceso)) {
            $data['claveacceso'] = password_hash($claveacceso, PASSWORD_DEFAULT);
        }

        if ($usuarioModel->update($id, $data)) {
            $session->setFlashdata('success', 'Usuario actualizado exitosamente');
            return redirect()->to(base_url('/usuario'));
        } else {
            $session->setFlashdata('error', 'Error al actualizar el usuario');
            return redirect()->to(base_url('/usuario/editar/' . $id));
        }
    }

    public function eliminar($id)
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $usuarioModel = new Usuario();
        
        if ($usuarioModel->delete($id)) {
            session()->setFlashdata('success', 'Usuario eliminado exitosamente');
        } else {
            session()->setFlashdata('error', 'Error al eliminar el usuario');
        }

        return redirect()->to(base_url('/usuario'));
    }
}