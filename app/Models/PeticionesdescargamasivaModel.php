<?php

namespace App\Models;

use CodeIgniter\Model;

class PeticionesdescargamasivaModel extends Model {

    protected $table = 'peticionesdescargamasiva';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id', 'desdeFecha', 'hastaFecha', 'emitidoRecibido'
        , 'tipoPeticion', 'uuidPeticion', 'created_at', 'updated_at', 'deleted_at', 'nombreArchivo', 'status', 'idEmpresa'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

}