<?php
 namespace App\Controllers;
 use App\Controllers\BaseController;
 use \App\Models\{ProductsModel};
 use App\Models\LogModel;
 use CodeIgniter\API\ResponseTrait;
 class ProductsController extends BaseController {
     use ResponseTrait;
     protected $log;
     protected $products;
     public function __construct() {
         $this->products = new ProductsModel();
         $this->log = new LogModel();
         helper('menu');
     }
     public function index() {
         if ($this->request->isAJAX()) {
             $datos = $this->products->select('id,idEmpresa,idCategory,code,barcode,unidad,description,stock,validateStock,inventarioRiguroso,buyPrice,salePrice,porcentSale,porcentTax,unidadSAT,claveProductoSAT,nombreUnidadSAT,nombreClaveProducto,porcentIVARetenido,porcentISRRetenido,routeImage,created_at,updated_at,deleted_at')->where('deleted_at', null);
             return \Hermawan\DataTables\DataTable::of($datos)->toJson(true);
         }
         $titulos["title"] = lang('products.title');
         $titulos["subtitle"] = lang('products.subtitle');
         return view('products', $titulos);
     }
     /**
      * Read Products
      */
     public function getProducts() {
         $idProducts = $this->request->getPost("idProducts");
         $datosProducts = $this->products->find($idProducts);
         echo json_encode($datosProducts);
     }
     /**
      * Save or update Products
      */
     public function save() {
         helper('auth');
         $userName = user()->username;
         $idUser = user()->id;
         $datos = $this->request->getPost();
         if ($datos["idProducts"] == 0) {
             try {
                 if ($this->products->save($datos) === false) {
                     $errores = $this->products->errors();
                     foreach ($errores as $field => $error) {
                         echo $error . " ";
                     }
                     return;
                 }
                 $dateLog["description"] = lang("vehicles.logDescription") . json_encode($datos);
                 $dateLog["user"] = $userName;
                 $this->log->save($dateLog);
                 echo "Guardado Correctamente";
             } catch (\PHPUnit\Framework\Exception $ex) {
                 echo "Error al guardar " . $ex->getMessage();
             }
         } else {
             if ($this->products->update($datos["idProducts"], $datos) == false) {
                 $errores = $this->products->errors();
                 foreach ($errores as $field => $error) {
                     echo $error . " ";
                 }
                 return;
             } else {
                 $dateLog["description"] = lang("products.logUpdated") . json_encode($datos);
                 $dateLog["user"] = $userName;
                 $this->log->save($dateLog);
                 echo "Actualizado Correctamente";
                 return;
             }
         }
         return;
     }
     /**
      * Delete Products
      * @param type $id
      * @return type
      */
     public function delete($id) {
         $infoProducts = $this->products->find($id);
         helper('auth');
         $userName = user()->username;
         if (!$found = $this->products->delete($id)) {
             return $this->failNotFound(lang('products.msg.msg_get_fail'));
         }
         $this->products->purgeDeleted();
         $logData["description"] = lang("products.logDeleted") . json_encode($infoProducts);
         $logData["user"] = $userName;
         $this->log->save($logData);
         return $this->respondDeleted($found, lang('products.msg_delete'));
     }
 }
        