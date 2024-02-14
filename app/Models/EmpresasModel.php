<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresasModel extends Model {

    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'id', 'nombre', 'direccion', 'rfc', 'telefono', 'correoElectronico', 'diasEntrega',
        'caja', 'logo', 'certificado', 'archivoKey', 'contraCertificado', 'regimenFiscal', 'razonSocial', 'CURP',
        'codigoPostal', 'created_at', 'updated_at', 'deleted_at'
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'correoElectronico' => 'required|valid_email',
        'razonSocial' => 'required|alpha_numeric_punct|min_length[3]|is_unique[empresas.razonSocial]',
        'rfc' => 'is_unique[empresas.rfc]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;


    
    public function mdlEmpresasPorUsuario($userId)
    {
        // Realiza la consulta para obtener las empresas asociadas al usuario
        $empresas = $this->select('empresas.id, empresas.nombre')
                        ->join('usuario_empresas', 'usuario_empresas.empresa_id = empresas.id')
                        ->where('usuario_empresas.user_id', $userId)
                        ->findAll();
    
        // Formatea los datos para que tengan las claves "id" y "nombre"
        $formattedEmpresas = [];
        foreach ($empresas as $empresa) {
            $formattedEmpresas[] = [
                'id' => $empresa['id'],
                'nombre' => $empresa['nombre'],
                
            ];
        }
    
        return $formattedEmpresas;
    }
    
    
}
