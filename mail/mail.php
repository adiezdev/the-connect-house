<?php
//error_reporting( E_ALL );
//ini_set( 'display_errors' , true );
//ini_set( 'display_startup_errors' , true );
/*
    -------------------------------------
    Archivo de: Alejandro Díez
    GitHub: @adilosa95
    Proyecto: the-connect-house
    Nombre del archivo: mail.php
    -------------------------------------
*/
require_once(__DIR__ . '/../includes/constantes.php');
require_once(__DIR__ . '/PHPMailer.php');
require_once(__DIR__ . '/Exception.php');
require_once(__DIR__ . '/SMTP.php');
//Importamos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
//

/*
    -------------------------------------
    Archivo de: Daniel Fernandez Alonso
    GitHub: @dferna10
    Proyecto: SimpleHouse
    Nombre del archivo: Correo.php
    -------------------------------------
*/

class Correo{

    private $empresa;
    private $password;
    private $user;
    private $mail;
    private $imagen;

    public function __construct()
    {
        $this->empresa = SIMPLE_MAIL;
        $this->password = PASSWORD_CORREO;
        $this->user = USER_NAME;
        $this->imagen = 'cid:logo_2u';
    }

    /**
     * Funcion para enviar el correo
     * @param correo a quien enviar
     * @param asunto asunto del correo
     * @param mensaje que enviar
     */
    public function enviaCorreo($correo, $asunto, $mensaje){
        $this->mail = new PHPMailer(true);

        try {
            // if(isset($_GET['id'])){
            // $correo = $_GET['id'];
            // $existe = isRegistrado($correo);
            // if($existe == 1){
            //Server settings
            $this->mail->SMTPDebug = 0;                      // Enable verbose debug output
            $this->mail->isSMTP();                                            // Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = $this->empresa;                     // SMTP username
            $this->mail->Password   = $this->password;                               // SMTP password
            $this->mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $this->mail->Port       = /*465*/587;                                    // TCP port to connect to

            $this->mail->SMTPOptions = array(

                'ssl' => array(

                    'verify_peer' => false,

                    'verify_peer_name' => false,

                    'allow_self_signed' => true

                )

            );
            //Recipients
            $this->mail->setFrom($this->empresa, $this->user);
            $this->mail->AddAddress($correo);  // Add a recipient
            $this->mail->AddReplyTo($this->empresa, $this->user);
            $this->mail->CharSet = 'UTF-8';//Codificacion para que acepte tildes y caracters especiales

            // Attachments para adjuntos
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $this->mail->isHTML(true);    //Para indicar que se envie HTML      // Set email format to HTML
            $this->mail->Subject  = $asunto;//Asunto del correo

            //Para enviar una imagen en el correo
            //$this->mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/SimpleHouse/Imagenes/Logo/Prueba.png', 'logo_2u');


            $this->mail->MsgHTML($mensaje);//Mensaje del correo
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            //
        } catch (Exception $e) {
            echo "Mensaje no enviado. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
    /**
     * Estrucutra para enviar el mensaje
     * @param $datos
     * @return string
     */
    public function enviarinter($datos){

            $mensaje = '<!DOCTYPE html>';
            $mensaje .= '<html lang="es">';
            $mensaje .= '<head>';
            $mensaje .= '<meta charset="UTF-8">';
            $mensaje .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            $mensaje .= '<meta http-equiv="X-UA-Compatible" content="ie=edge">';
            $mensaje .= '<title>Document</title>';
            $mensaje .= '</head>';
            $mensaje .= '<body>';
            $mensaje .= '<div>';
            $mensaje .= '<header>';
            $mensaje .= '<img class="icono" src="https://theconecthouse.000webhostapp.com/img/marca/banner.png" width="200" height="40"><br>';
            $mensaje .= '</header>';
            $mensaje .= '<p>Al usuario '.$datos['mail'].', le interesa tú alquiler.<p><br>';
            $mensaje .= '<p>Respues al alquiler:</p>';
            $mensaje .= '<p>'.$datos['descripcion'].'</p>';
            $mensaje .= '</div>';
            $mensaje .= '</body>';
            $mensaje .= '</html>';
            return $mensaje;

    }
}

?>