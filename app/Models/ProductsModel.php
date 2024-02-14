<?php
namespace App\Models;
use CodeIgniter\Model;
class ProductsModel extends Model{
    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','idEmpresa','idCategory','code','barcode','unidad','description','stock','validateStock','inventarioRiguroso','buyPrice','salePrice','porcentSale','porcentTax','unidadSAT','claveProductoSAT','nombreUnidadSAT','nombreClaveProducto','porcentIVARetenido','porcentISRRetenido','routeImage','created_at','updated_at','deleted_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    =  [
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
        