<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioEmpresasModel extends Model
{
    protected $table = 'usuario_empresas';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_id', 'empresa_id'];
    protected $useTimestamps = false;
    protected $skipValidation = false;
}
