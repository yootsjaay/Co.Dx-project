<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\{
    PeticionesdescargamasivaModel
};
use App\Models\LogModel;
use App\Models\EmpresasModel;
use App\Models\XmlModel;
use CodeIgniter\API\ResponseTrait;
use PhpCfdi\SatWsDescargaMasiva\RequestBuilder\RequestBuilderInterface;
use PhpCfdi\SatWsDescargaMasiva\RequestBuilder\FielRequestBuilder\Fiel;
use PhpCfdi\SatWsDescargaMasiva\RequestBuilder\FielRequestBuilder\FielRequestBuilder;
use PhpCfdi\SatWsDescargaMasiva\Service;
use PhpCfdi\SatWsDescargaMasiva\Shared\ServiceEndpoints;
use PhpCfdi\SatWsDescargaMasiva\WebClient\Exceptions\SoapFaultError;
use PhpCfdi\SatWsDescargaMasiva\WebClient\GuzzleWebClient;
use PhpCfdi\SatWsDescargaMasiva\Services\Query\QueryParameters;
use PhpCfdi\SatWsDescargaMasiva\Shared\DateTimePeriod;
use PhpCfdi\SatWsDescargaMasiva\RequestBuilder\RequestBuilderException;
use PhpCfdi\SatWsDescargaMasiva\Shared\ComplementoCfdi;
use PhpCfdi\SatWsDescargaMasiva\Shared\DocumentStatus;
use PhpCfdi\SatWsDescargaMasiva\Shared\DocumentType;
use PhpCfdi\SatWsDescargaMasiva\Shared\DownloadType;
use PhpCfdi\SatWsDescargaMasiva\Shared\RequestType;
use PhpCfdi\SatWsDescargaMasiva\Shared\RfcMatch;
use PhpCfdi\SatWsDescargaMasiva\Shared\RfcOnBehalf;
use PhpCfdi\SatWsDescargaMasiva\Shared\Uuid;
use PhpCfdi\SatWsDescargaMasiva\PackageReader\Exceptions\OpenZipFileException;
use PhpCfdi\SatWsDescargaMasiva\PackageReader\CfdiPackageReader;
use PhpCfdi\CfdiToJson\JsonConverter;
use SoapFault;
use PhpCfdi\SatEstadoCfdi\Consumer;
use PhpCfdi\SatEstadoCfdi\Contracts\ConsumerClientInterface;
use PhpCfdi\SatEstadoCfdi\Soap\SoapConsumerClient;

class PeticionesdescargamasivaController extends BaseController {

    use ResponseTrait;

    protected $log;
    protected $peticionesdescargamasiva;
    protected $XMLArchivo;
    protected $empresa;

    public function __construct() {
        $this->peticionesdescargamasiva = new PeticionesdescargamasivaModel();
        $this->log = new LogModel();
        $this->XMLArchivo = new XmlModel();
        $this->empresa = new EmpresasModel();
        helper('menu');
    }

    public function index() {
        helper('auth');
        
        $idUser = user()->id;
        $titulos["empresas"] = $this->empresa->mdlEmpresasPorUsuario($idUser);
        //dd($titulos["empresas"]);
        if (count($titulos["empresas"]) == "0") {

            $empresasID[0] = "0";
        } else {

            $empresasID = array_column($titulos["empresas"], "id");
        }
        // $empresasID = implode(",", $empresasID);

        if ($this->request->isAJAX()) {
            $datos = $this->peticionesdescargamasiva->select('id,desdeFecha
            ,hastaFecha
            ,emitidoRecibido
            ,tipoPeticion
            ,uuidPeticion
            ,created_at
            ,updated_at
            ,deleted_at
            ,nombreArchivo
            ,status')->where('deleted_at', null)->whereIn("idEmpresa", $empresasID);
            return \Hermawan\DataTables\DataTable::of($datos)->toJson(true);
        }
        $titulos["title"] = lang('peticionesdescargamasiva.title');
        $titulos["subtitle"] = lang('peticionesdescargamasiva.subtitle');

        return view('peticionesdescargamasiva', $titulos);
    }

    /**
     * Read Peticionesdescargamasiva
     */
    public function getPeticionesdescargamasiva() {
        $idPeticionesdescargamasiva = $this->request->getPost("idPeticionesdescargamasiva");
        $datosPeticionesdescargamasiva = $this->peticionesdescargamasiva->find($idPeticionesdescargamasiva);
        echo json_encode($datosPeticionesdescargamasiva);
    }

    /**
     * Save or update Peticionesdescargamasiva
     */
    public function save() {
        helper('auth');
        helper('utilerias');
        $userName = user()->username;
        $idUser = user()->id;
        $datos = $this->request->getPost();

        $datosEmpresa = $this->empresa->find($datos["idEmpresa"]);

        if ($datos["status"] == "descargado") {

            echo "Solicitud ya descargada";

            $zipfile = $datos["nombreArchivo"];

            try {
                $cfdiReader = CfdiPackageReader::createFromFile($zipfile);
            } catch (OpenZipFileException $exception) {
                echo $exception->getMessage(), PHP_EOL;
                return;
            }

            // leer todos los CFDI dentro del archivo ZIP con el UUID como llave
            $datosXML["uuidPaquete"] = $datos["uuidPeticion"];
            $eliminarXML = $this->XMLArchivo->where("uuidPaquete", $datosXML["uuidPaquete"])->delete();
            $this->XMLArchivo->purgeDeleted();

            foreach ($cfdiReader->cfdis() as $uuid => $content) {

                $xml = \PhpCfdi\CfdiCleaner\Cleaner::staticClean($content);

                // create the main node structure
                $comprobante = \CfdiUtils\Nodes\XmlNodeUtils::nodeFromXmlString($xml);

                // create the CfdiData object, it contains all the required information
                $cfdiData = (new \PhpCfdi\CfdiToPdf\CfdiDataBuilder())
                        ->build($comprobante);

                // VALIDAMOS STATUS EN EL SAT
                try {

                    $client = new SoapConsumerClient();
                    $consumer = new Consumer($client);

                    $cfdiStatus = $consumer->execute($cfdiData->qrUrl());

                    if ($cfdiStatus->document()->isActive()) {
                        $datosXML["status"] = 'vigente';
                    } else {
                        $datosXML["status"] = 'cancelado';
                    }
                } catch (Exception $ex) {
                    
                }

                $tfd = $cfdiData->timbreFiscalDigital();
                $emisor = $cfdiData->emisor();
                $receptor = $cfdiData->receptor();

                $datosXML["base16"] = "0.00";
                $datosXML["totalImpuestos16"] = "0.00";

                $datosXML["base8"] = "0.00";
                $datosXML["totalImpuestos8"] = "0.00";

                $impuestos = $comprobante->searchNode('cfdi:Impuestos');

                if (isset($impuestos)) {

                    $traslados = $impuestos->searchNodes('cfdi:Traslados', 'cfdi:Traslado');

                    foreach ($traslados as $key) {


                        if ($key["TasaOCuota"] == 0.16) {

                            if (isset($key["Base"])) {

                                $datosXML["base16"] = $datosXML["base16"] + $key["Base"];
                            } else {

                                $datosXML["base16"] = $datosXML["base16"] + 0;
                            }

                            $datosXML["totalImpuestos16"] = $datosXML["totalImpuestos16"] + number_format($key["Importe"], 6);
                        }

                        if ($key["TasaOCuota"] == 0.08) {


                            if (isset($key["Base"])) {

                                $datosXML["base8"] = $datosXML["base8"] + $key["Base"];
                            } else {

                                $datosXML["base8"] = $datosXML["base8"] + 0;
                            }



                            $datosXML["totalImpuestos8"] = $datosXML["totalImpuestos8"] + $key["Importe"];
                        }
                    }
                }


                //$tfd['UUID']



                $datosXML["uuidTimbre"] = $tfd['UUID'];
                $datosXML["uuidPaquete"] = $datos["uuidPeticion"];
                $datosXML["idEmpresa"] = $datos["idEmpresa"];
                $datosXML["archivoXML"] = $content;

                //  $jsonXML = JsonConverter::convertToJson($content);
                //  $arregloXML = json_decode($jsonXML, true);
                $datosXML["fecha"] = $comprobante["Fecha"];
                $datosXML["fechaTimbrado"] = $tfd['FechaTimbrado'];
                $datosXML["total"] = $comprobante["Total"];
                $datosXML["tipoComprobante"] = $comprobante["TipoDeComprobante"];

                $datosXML["rfcEmisor"] = $emisor['Rfc'];
                $datosXML["rfcReceptor"] = $receptor['Rfc'];

                $datosXML["nombreEmisor"] = $emisor['Nombre'];
                $datosXML["nombreReceptor"] = $receptor['Nombre'];

                $datosXML["metodoPago"] = $comprobante['MetodoPago'];
                $datosXML["formaPago"] = $comprobante['FormaPago'];
                $datosXML["usoCFDI"] = $receptor['UsoCFDI'];
                $datosXML["exportacion"] = $comprobante['Exportacion'];
                $datosXML["emitidoRecibido"] = $datos['emitidoRecibido'];

                if (isset($comprobante["Serie"])) {

                    $datosXML["serie"] = $comprobante["Serie"];
                } else {

                    $datosXML["serie"] = "";
                }

                if (isset($comprobante["Folio"])) {

                    $datosXML["folio"] = $comprobante["Folio"];
                } else {

                    $datosXML["folio"] = "";
                }

                $totalRen = $this->XMLArchivo->selectCount("id")->where("uuidTimbre", $datosXML["uuidTimbre"])->first();
                $totalRen = $totalRen["id"];
                if ($totalRen == 0) {



                    $this->XMLArchivo->insert($datosXML);
                }
            }
            return;
        }
        $desdeFecha = fechaHoraActual($datos["desdeFecha"]);
        $hastaFecha = fechaHoraActualSQLFinal($datos["hastaFecha"]);

        /**
         * HACER PETICION
         */
        // Creación de la FIEL, puede leer archivos DER (como los envía el SAT) o PEM (convertidos con openssl)
        $rutaLlave = ROOTPATH . "writable/uploads/certificates/$datosEmpresa[archivoKey]";
        $rutaCer = ROOTPATH . "writable/uploads/certificates/$datosEmpresa[certificado]";
        $fiel = Fiel::create(
                        file_get_contents($rutaCer),
                        file_get_contents($rutaLlave),
                        $datosEmpresa["contraCertificado"]
        );

        // verificar que la FIEL sea válida (no sea CSD y sea vigente acorde a la fecha del sistema)
        if (!$fiel->isValid()) {
            return;
        }

        // creación del web client basado en Guzzle que implementa WebClientInterface
        // para usarlo necesitas instalar guzzlehttp/guzzle pues no es una dependencia directa
        $webClient = new GuzzleWebClient();

        // creación del objeto encargado de crear las solicitudes firmadas usando una FIEL
        $requestBuilder = new FielRequestBuilder($fiel);

        // Creación del servicio
        $service = new Service($requestBuilder, $webClient, null, ServiceEndpoints::cfdi());

        try {

            $service->authenticate();

            echo "conectado";
        } catch (SoapFaultError $e) {

            var_dump($e->getMessage());
        }




        // ->withPeriod(DateTimePeriod::createFromValues('2018-02-01 00:00:00', '2018-02-31 23:59:59'))
        //                                                2017-03-01 00:00:00    2015-01-01 12:59:00     
        //   ->withPeriod(DateTimePeriod::createFromValues('2018-02-01 00:00:00','2018-02-28 23:59:59'))
        if ($datos["status"] != "aceptada") {


            if ($datos["status"] == "descargado") {

                echo "Solicitud ya descargada";
                return;
            }

            if ($datos["emitidoRecibido"] == "recibido") {
                $request = QueryParameters::create()
                        ->withPeriod(DateTimePeriod::createFromValues($desdeFecha, $hastaFecha))
                        ->withRequestType(RequestType::xml())
                        ->withDownloadType(DownloadType::received());
            }

            if ($datos["emitidoRecibido"] == "emitido") {
                $request = QueryParameters::create()
                        ->withPeriod(DateTimePeriod::createFromValues($desdeFecha, $hastaFecha))
                        ->withRequestType(RequestType::xml())
                        ->withDownloadType(DownloadType::issued());
            }



            $query = $service->query($request);

            // verificar que el proceso de consulta fue correcto
            if (!$query->getStatus()->isAccepted()) {
                echo "Fallo al presentar la consulta: {$query->getStatus()->getMessage()}";
                $datos["status"] = $query->getStatus()->getMessage();
            } else {

                $datos["status"] = "aceptada";
                // el identificador de la consulta está en $query->getRequestId()
                // echo "Se generó la solicitud {$query->getRequestId()}", PHP_EOL;

                $datos["uuidPeticion"] = $query->getRequestId();
            }
        }

        if ($datos["status"] == "aceptada" && $datos["idPeticionesdescargamasiva"] > 0) {

            $requestId = $datos["uuidPeticion"];
            // Verifica los paquetes
            $verify = $service->verify($requestId);

            // revisar que el proceso de verificación fue correcto
            if (!$verify->getStatus()->isAccepted()) {
                echo "Fallo al verificar la consulta {$requestId}: {$verify->getStatus()->getMessage()}";
                return;
            }

            // revisar que la consulta no haya sido rechazada
            if (!$verify->getCodeRequest()->isAccepted()) {
                echo "La solicitud {$requestId} fue rechazada: {$verify->getCodeRequest()->getMessage()}", PHP_EOL;
                return;
            }

            // revisar el progreso de la generación de los paquetes
            $statusRequest = $verify->getStatusRequest();
            if ($statusRequest->isExpired() || $statusRequest->isFailure() || $statusRequest->isRejected()) {
                echo "La solicitud {$requestId} no se puede completar", PHP_EOL;
                return;
            }
            if ($statusRequest->isInProgress() || $statusRequest->isAccepted()) {
                echo "La solicitud {$requestId} se está procesando", PHP_EOL;
                return;
            }
            if ($statusRequest->isFinished()) {
                echo "La solicitud {$requestId} está lista", PHP_EOL;
            }



            echo "Se encontraron {$verify->countPackages()} paquetes", PHP_EOL;
            foreach ($verify->getPackagesIds() as $packageId) {
                echo " > {$packageId}", PHP_EOL;

                $download = $service->download($packageId);
                if (!$download->getStatus()->isAccepted()) {
                    echo "El paquete {$packageId} no se ha podido descargar: {$download->getStatus()->getMessage()}", PHP_EOL;
                    return;
                }
                $zipfile = "$packageId.zip";
                file_put_contents($zipfile, $download->getPackageContent());
                echo "El paquete {$packageId} se ha almacenado", PHP_EOL;

                $datos["nombreArchivo"] = $zipfile;

                $datos["status"] = "descargado";
            }
        }



        if ($datos["idPeticionesdescargamasiva"] == 0) {
            try {
                if ($this->peticionesdescargamasiva->save($datos) === false) {
                    $errores = $this->peticionesdescargamasiva->errors();
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
            if ($this->peticionesdescargamasiva->update($datos["idPeticionesdescargamasiva"], $datos) == false) {
                $errores = $this->peticionesdescargamasiva->errors();
                foreach ($errores as $field => $error) {
                    echo $error . " ";
                }
                return;
            } else {
                $dateLog["description"] = lang("peticionesdescargamasiva.logUpdated") . json_encode($datos);
                $dateLog["user"] = $userName;
                $this->log->save($dateLog);
                echo "Actualizado Correctamente";
                return;
            }
        }
        return;
    }

    /**
     * Delete Peticionesdescargamasiva
     * @param type $id
     * @return type
     */
    public function delete($id) {
        $infoPeticionesdescargamasiva = $this->peticionesdescargamasiva->find($id);
        helper('auth');
        $userName = user()->username;
        if (!$found = $this->peticionesdescargamasiva->delete($id)) {
            return $this->failNotFound(lang('peticionesdescargamasiva.msg.msg_get_fail'));
        }
        $this->peticionesdescargamasiva->purgeDeleted();
        $logData["description"] = lang("peticionesdescargamasiva.logDeleted") . json_encode($infoPeticionesdescargamasiva);
        $logData["user"] = $userName;
        $this->log->save($logData);
        return $this->respondDeleted($found, lang('peticionesdescargamasiva.msg_delete'));
    }

}