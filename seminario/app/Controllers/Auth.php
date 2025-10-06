<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class Auth extends BaseController
{
    public function login()
    {
        // Si ya está logueado, redirigir al dashboard
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('/dashboard'));
        }

        // Verificar si es una petición POST (formulario enviado)
        if ($this->request->getMethod() === 'POST') {
            return $this->procesarLogin();
        }

        // Si es GET, mostrar el formulario de login
        return view('home/login');
    }

    private function procesarLogin()
    {
        $session = session();
        
        // Obtener datos del formulario
        $nomusuario = $this->request->getPost('nomusuario');
        $claveacceso = $this->request->getPost('claveacceso');

        // Validar que se enviaron los datos
        if (empty($nomusuario) || empty($claveacceso)) {
            $session->setFlashdata('error', 'Usuario y contraseña son requeridos');
            return redirect()->to(base_url());
        }

        // Buscar usuario en la base de datos
        $usuarioModel = new Usuario();
        $user = $usuarioModel->getUser($nomusuario);

        // Verificar si el usuario existe
        if (!$user) {
            $session->setFlashdata('error', 'Usuario no encontrado');
            return redirect()->to(base_url());
        }

        // Verificar contraseña
        if (!password_verify($claveacceso, $user['claveacceso'])) {
            $session->setFlashdata('error', 'Contraseña incorrecta');
            return redirect()->to(base_url());
        }

        // LOGIN EXITOSO - Crear sesión
        $sessionData = [
            'id' => $user['id'],
            'nombres' => $user['nombres'],
            'apellidos' => $user['apellidos'],
            'nomusuario' => $user['nomusuario'],
            'avatar' => $user['avatar'],
            'nivelacceso' => $user['nivelacceso'],
            'logged_in' => true
        ];
        
        $session->set($sessionData);

        // Redirigir al welcome
        return redirect()->to(base_url('/welcome'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}