<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\EmpresasModel;
use App\Models\LogModel;
use CodeIgniter\API\ResponseTrait;

class EmpresasController extends BaseController {

    use ResponseTrait;

    protected $log;
    protected $empresas;

    public function __construct() {
        $this->empresas = new EmpresasModel();
        $this->log = new LogModel();
        helper('menu', 'filesystem');
    }

    public function index() {


        if ($this->request->isAJAX()) {
            $datos = $this->empresas->select('id,nombre,direccion,rfc,telefono,correoElectronico,'
                            . 'diasEntrega,caja,logo,certificado,archivoKey,contraCertificado,regimenFiscal,razonSocial,codigoPostal,'
                            . 'CURP,created_at,updated_at')->where('deleted_at', null);

            return \Hermawan\DataTables\DataTable::of($datos)->toJson(true);
        }



        $regimenesFiscales = $this->catalogosSAT->regimenesFiscales40()->searchByField("texto", "%%", 1000);
        


        $titulos["title"] = lang('empresas.title');
        $titulos["subtitle"] = lang('empresas.subtitle');
        $titulos["regimenesFiscales"] = $regimenesFiscales;

        //$data["data"] = $datos;
        return view('empresas', $titulos);
    }

    /**
     * Read Vehicle
     */
    public function obtenerEmpresa() {


        $idEmpresa = $this->request->getPost("idEmpresa");
        $datosEmpresa = $this->empresas->find($idEmpresa);

        echo json_encode($datosEmpresa);
    }

    /**
     * Save or update Vehicle
     */
    public function save() {


        helper('auth');
        $userName = user()->username;
        $idUser = user()->id;

        $datos = $this->request->getPost();

        unset($datos["certificado"]);
        unset($datos["archivoKey"]);
        unset($datos["logo"]);

        $certificado = $this->request->getFile('certificado');
        $archivoKey = $this->request->getFile('archivoKey');
        $logo = $this->request->getFile('logo');

        if ($certificado <> null) {
            if ($certificado->getClientExtension() <> "cer") {

                return lang("empresas.certExtensionIncorrect");
            }

            $datos["certificado"] = $datos["rfc"] . "_certificado.cer";
        }

        if ($archivoKey <> null) {
            if ($archivoKey->getClientExtension() <> "key") {

                return lang("empresas.keyFileExtensionIncorrect");
            }

            $datos["archivoKey"] = $datos["rfc"] . "_certificado.key";
        }

        if ($logo) {

            if ($logo->getClientExtension() <> "png") {

                return lang("empresas.pngFileExtensionIncorrect");
            }
            $datos["logo"] = $datos["rfc"] . "_logo.png";
        }

        if ($datos["idEmpresa"] == 0) {


            try {
                
                if ($this->empresas->save($datos) === false) {

                    $errores = $this->empresas->errors();

                    foreach ($errores as $field => $error) {

                        echo $error . " ";
                    }

                    return;
                }

                $dateLog["description"] = lang("empresas.logDescription") . json_encode($datos);
                $dateLog["user"] = $userName;

                $this->log->save($dateLog);

                if ($certificado <> null) {
                    $certificado->move(WRITEPATH . "uploads\certificates", $datos["rfc"] . "_certificado.cer");
                }

                if ($archivoKey <> null) {
                    $archivoKey->move(WRITEPATH . "uploads\certificates", $datos["rfc"] . "_certificado.key");
                }

                if ($logo <> null) {
                    $logo->move("images\logo", $datos["rfc"] . "_logo.png");
                }

                echo "Guardado Correctamente";
            } catch (\PHPUnit\Framework\Exception $ex) {


                echo "Error al guardar " . $ex->getMessage();
            }
        } else {


            $datosAnteriores = $this->empresas->find($datos["idEmpresa"]);

            if ($this->empresas->update($datos["idEmpresa"], $datos) == false) {

                $errores = $this->empresas->errors();
                foreach ($errores as $field => $error) {

                    echo $error . " ";
                }

                return;
            } else {


                if ($certificado <> null) {
                    
                    unlink(WRITEPATH . "uploads\certificates\\" . $datosAnteriores["rfc"] . "_certificado.cer");
                    $certificado->move(WRITEPATH . "uploads\certificates", $datos["rfc"] . "_certificado.cer");
                }

                if ($archivoKey <> null) {
                    unlink(WRITEPATH . "uploads\certificates\\" . $datosAnteriores["rfc"] . "_certificado.key");
                    $archivoKey->move(WRITEPATH . "uploads\certificates", $datos["rfc"] . "_certificado.key");
                }

                if ($logo <> null) {
                    unlink("images\logo\\" . $datosAnteriores["rfc"] . "_logo.png");
                    $logo->move("images\logo", $datos["rfc"] . "_logo.png");
                }

                $dateLog["description"] = lang("empresas.logUpdated") . json_encode($datosAnteriores);
                $dateLog["user"] = $userName;

                $this->log->save($dateLog);
                echo "Actualizado Correctamente";

                return;
            }
        }

        return;
    }

    /**
     * Delete Empresas
     * @param type $id
     * @return type
     */
    public function delete($id) {

        $infoEmpresa = $this->empresas->find($id);
        helper('auth');
        $userName = user()->username;

        if (!$found = $this->empresas->delete($id)) {
            return $this->failNotFound(lang('empresas.msg.msg_get_fail'));
        }

        $logData["description"] = lang("empresas.logDeleted") . json_encode($infoEmpresa);
        $logData["user"] = $userName;

        if(file_exists(WRITEPATH . "uploads\certificates\\" . $infoEmpresa["rfc"] . "_certificado.cer")){

            unlink(WRITEPATH . "uploads\certificates\\" . $infoEmpresa["rfc"] . "_certificado.cer");

        }

        if(file_exists(WRITEPATH . "uploads\certificates\\" . $infoEmpresa["rfc"] . "_certificado.key")){
            
            unlink(WRITEPATH . "uploads\certificates\\" . $infoEmpresa["rfc"] . "_certificado.key");

        }
        
        if(file_exists("images\logo\\" . $infoEmpresa["rfc"] . "_logo.png")){

            unlink("images\logo\\" . $infoEmpresa["rfc"] . "_logo.png");

        }

        $this->empresas->purgeDeleted();

        $this->log->save($logData);
        return $this->respondDeleted($found, lang('empresas.msg_delete'));
    }

}