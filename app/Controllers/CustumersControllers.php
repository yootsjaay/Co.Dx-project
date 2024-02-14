<?php
 namespace App\Controllers;
 use App\Controllers\BaseController;
 use \App\Models\{CustumersModel};
 use App\Models\LogModel;
 use CodeIgniter\API\ResponseTrait;
 class CustumersController extends BaseController {
     use ResponseTrait;
     protected $log;
     protected $custumers;
     public function __construct() {
         $this->custumers = new CustumersModel();
         $this->log = new LogModel();
         helper('menu');
         helper('utilerias');
     }
     public function index() {
         if ($this->request->isAJAX()) {
             $datos = $this->custumers->select('id,firstname,lastname,taxID,email,direction,birthdate,created_at,updated_at,deleted_at')->where('deleted_at', null);
             return \Hermawan\DataTables\DataTable::of($datos)->toJson(true);
         }


         $fechaActual =  fechaMySQLADateTimeHTML5(fechaHoraActual());

         $titulos["title"] = lang('custumers.title');
         $titulos["subtitle"] = lang('custumers.subtitle');
         $titulos["fecha"] = $fechaActual;
         return view('custumers', $titulos);
     }
     /**
      * Read Custumers
      */
     public function getCustumers() {
         $idCustumers = $this->request->getPost("idCustumers");
         $datosCustumers = $this->custumers->find($idCustumers);
         echo json_encode($datosCustumers);
     }
     /**
      * Save or update Custumers
      */
     public function save() {
         helper('auth');
         $userName = user()->username;
         $idUser = user()->id;
         $datos = $this->request->getPost();
         if ($datos["idCustumers"] == 0) {
             try {
                 if ($this->custumers->save($datos) === false) {
                     $errores = $this->custumers->errors();
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
             if ($this->custumers->update($datos["idCustumers"], $datos) == false) {
                 $errores = $this->custumers->errors();
                 foreach ($errores as $field => $error) {
                     echo $error . " ";
                 }
                 return;
             } else {
                 $dateLog["description"] = lang("custumers.logUpdated") . json_encode($datos);
                 $dateLog["user"] = $userName;
                 $this->log->save($dateLog);
                 echo "Actualizado Correctamente";
                 return;
             }
         }
         return;
     }
     /**
      * Delete Custumers
      * @param type $id
      * @return type
      */
     public function delete($id) {
         $infoCustumers = $this->custumers->find($id);
         helper('auth');
         $userName = user()->username;
         if (!$found = $this->custumers->delete($id)) {
             return $this->failNotFound(lang('custumers.msg.msg_get_fail'));
         }
         $this->custumers->purgeDeleted();
         $logData["description"] = lang("custumers.logDeleted") . json_encode($infoCustumers);
         $logData["user"] = $userName;
         $this->log->save($logData);
         return $this->respondDeleted($found, lang('custumers.msg_delete'));
     }
 }
        