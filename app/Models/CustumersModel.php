<?php
namespace App\Models;
use CodeIgniter\Model;
class CustumersModel extends Model{
    protected $table      = 'custumers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','firstname','lastname','taxID','email','direction','birthdate','created_at','updated_at','deleted_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    =  [
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
        