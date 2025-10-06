<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;

class Test extends BaseController
{
    public function index()
    {
        $usuarioModel = new Usuario();
        
        // Verificar usuarios en la base de datos
        $usuarios = $usuarioModel->findAll();
        
        echo "<h1>Usuarios en la Base de Datos:</h1>";
        echo "<pre>";
        print_r($usuarios);
        echo "</pre>";
        
        // Verificar usuario admin específico
        $admin = $usuarioModel->getUser('admin');
        echo "<h1>Usuario Admin:</h1>";
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
        
        // Verificar contraseña
        if ($admin) {
            $passwordCheck = password_verify('Admin123*', $admin['claveacceso']);
            echo "<h1>Verificación de Contraseña:</h1>";
            echo "Contraseña correcta: " . ($passwordCheck ? 'SÍ' : 'NO');
        }
    }
}