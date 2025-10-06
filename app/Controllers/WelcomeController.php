<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class WelcomeController extends BaseController
{
    public function index()
    {
        // Verificar si está logueado
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Debe iniciar sesión primero');
            return redirect()->to(base_url());
        }

        $data = [
            'titulo' => 'Bienvenido - Sistema de Motos',
            'usuario' => [
                'nombres' => session()->get('nombres'),
                'apellidos' => session()->get('apellidos'),
                'nomusuario' => session()->get('nomusuario'),
                'avatar' => session()->get('avatar'),
                'nivelacceso' => session()->get('nivelacceso')
            ],
            'motos' => [
                [
                    'marca' => 'Kawasaki',
                    'modelo' => 'Ninja 650',
                    'cilindrada' => '650cc',
                    'precio' => '$8,500',
                    'imagen' => 'kawasaki.jpg',
                    'descripcion' => 'Moto deportiva con excelente rendimiento y diseño aerodinámico.'
                ],
                [
                    'marca' => 'Honda',
                    'modelo' => 'CBR 600RR',
                    'cilindrada' => '600cc',
                    'precio' => '$7,200',
                    'imagen' => 'honda.jpg',
                    'descripcion' => 'Ideal para pista con tecnología avanzada y gran potencia.'
                ],
                [
                    'marca' => 'Yamaha',
                    'modelo' => 'YZF-R6',
                    'cilindrada' => '600cc',
                    'precio' => '$7,800',
                    'imagen' => 'yamaha.jpg',
                    'descripcion' => 'Perfecta combinación de potencia y agilidad urbana.'
                ],
                [
                    'marca' => 'Suzuki',
                    'modelo' => 'GSX-R750',
                    'cilindrada' => '750cc',
                    'precio' => '$8,100',
                    'imagen' => 'suzuki.jpg',
                    'descripcion' => 'Gran cilindrada con tecnología de punta y máximo rendimiento.'
                ]
            ]
        ];

        return view('welcome/index', $data);
    }
}