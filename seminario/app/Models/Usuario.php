<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'apellidos', 'nombres', 'nomusuario', 
        'claveacceso', 'avatar', 'nivelacceso',
        'create_at', 'update_at'
    ];

    protected $useTimestamps = false;
    protected $createdField = 'create_at';
    protected $updatedField = 'update_at';

    /**
     * Obtiene un usuario por nombre de usuario
     */
    public function getUser($nomusuario = '')
    {
        return $this->where('nomusuario', $nomusuario)->first();
    }
}