<?php

namespace julio101290\boilerplate\Controllers\Users;

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\SettingsMailModel;
use App\Models\LogModel;
use julio101290\boilerplate\Controllers\BaseController;
use julio101290\boilerplate\Entities\Collection;
use julio101290\boilerplate\Models\GroupModel;
use CodeIgniter\Config\Services;
use App\Models\RegisterModel;
use App\Controllers\RegisterController;
use PHPMailer\PHPMailer;

/**
 * Class UserController.
 */
class SettingsMailController extends BaseController
{

    use ResponseTrait;

    /** @var \agungsugiarto\boilerplate\Models\GroupModel */
    protected $group;
    protected $settingsMail;
    protected $log;
    protected $register;
    protected $registerController;
    protected $custumer;

    /** @var \agungsugiarto\boilerplate\Models\UserModel */
    protected $users;

    public function __construct()
    {
        $this->group = new GroupModel();
        $this->log = new LogModel();
        $this->settingsMail = new SettingsMailModel();
        $autorize = $this->authorize = Services::authorization();
        helper('menu');
    }

    public function index()
    {




        $datos = $this->settingsMail->where("id", 1)->first();

        $data["title"] = "Correo Electronicos";
        $data["subtitle"] = "Configuraciones de Correo Electronico";
        $data["data"] = $datos;

        return view('mailSettings', $data);
    }

    /** 
    public function sendMailPDF($uuid)
    {

        //DATOS CORREO
        $datos = $this->settingsMail->where("id", 1)->first();

        //DATOS  REGISTRO

        $register = $this->register->select("*")->where("uuid", $uuid)->first();

        $custumer = $this->custumer->select("*")->where("id", $register["custumer"])->first();

        $mailsTarjets = "";

        $correo = $datos["email"];
        $SMTPDebug = $datos["smtpDebug"];
        $host = $datos["host"];

        if ($datos["SMTPAuth"] == 1) {
            $SMTPAuth = true;
        } else {
            $SMTPAuth = false;
        }

        $puerto = $datos["port"];
        $clave = $datos["pass"];

        $SMTPSeguridad = $datos["smptSecurity"];

        // Load Composer's autoloader
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer\PHPMailer();

        try {


            //Server settings
            $mail->SMTPDebug = $SMTPDebug;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = $host;                    // Set the SMTP server to send through
            $mail->SMTPAuth = $SMTPAuth;                                   // Enable SMTP authentication
            $mail->Username = $correo;                     // SMTP username
            $mail->Password = $clave;                               // SMTP password
            $mail->SMTPSecure = $SMTPSeguridad;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = $puerto;

            $nombreEmpresa = "";
            // TCP port to connect to
            //Recipients
            $mail->setFrom($correo, $nombreEmpresa);

            if ($custumer["email1"] != "") {
                try {
                    $mailAddress = $mail->addAddress($custumer["email1"], '');

                    if (!$mailAddress) {

                        echo "Error con el correo Electronico";
                        return;
                    }
                } catch (Exception $ex) {

                    echo $ex->getMessage();
                }
            }

            if ($custumer["email2"] != "") {

                try {
                    $mailAddress = $mail->addAddress($custumer["email2"], '');

                    if (!$mailAddress) {

                        echo "Error con el correo Electronico";
                        return;
                    }
                } catch (Exception $ex) {

                    echo $ex->getMessage();
                }
            }

            if ($custumer["email3"] != "") {

                try {
                    $mailAddress = $mail->addAddress($custumer["email3"], '');

                    if (!$mailAddress) {

                        echo "Error con el correo Electronico";
                        return;
                    }

                    if (!$mailAddress) {

                        echo "Error con el correo Electronico";
                        return;
                    }
                } catch (Exception $ex) {

                    echo $ex->getMessage();
                }
            }

            if ($custumer["email4"] != "") {

                try {
                    $mailAddress = $mail->addAddress($custumer["email4"], '');

                    if (!$mailAddress) {

                        echo "Error con el correo Electronico";
                        return;
                    }
                } catch (Exception $ex) {

                    echo $ex->getMessage();
                }
            }

            if ($custumer["email5"] != "") {

                try {
                    $mailAddress = $mail->addAddress($custumer["email5"], '');

                    if (!$mailAddress) {

                        echo "Error con el correo Electronico";
                        return;
                    }
                } catch (Exception $ex) {

                    echo $ex->getMessage();
                }
            }
            // Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');
            //mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            // Attachments
            $attachment = $this->registerController->report($uuid, 1);
            $mail->AddStringAttachment($attachment, 'registro' . $register["codeCustumer"] . '.pdf', 'base64', 'application/pdf');

            // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Envio de Registro";
            $mail->Body = "Adjuntamos el registro de verificación de neumaticos";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            try {
                $send = $mail->send();
            } catch (Exception $ex) {

                echo $ex->getMessage();
                return;
            }

            if ($send) {
                echo 'Correo Enviado Correctamente';
            } else {
                echo 'Error al enviar el correo';
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$e->ErrorInfo}";
        }
    }
*/
    public function guardar()
    {


        helper('auth');
        $userName = user()->username;
        $idUser = user()->id;

        //GUARDA CONFIGURACIONES
        $this->settingsMail->update(1, $_POST);

        //  return redirect()->to("/admin/hospital");
        return redirect()->back()->with('sweet-success', 'Actualizado Correctamente');
        // return redirect()->back()->with('sweet-success','Guardado Correctamente');
    }
}