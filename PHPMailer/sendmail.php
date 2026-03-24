<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mailprueba155@gmail.com';           //credenciales de donde se envian los correos
        $mail->Password = 'muhyghlyjlmpjowv';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('mailprueba155@gmail.com', 'Ruta Comercial Santa Barbara');      //send from
        $mail->addReplyTo($email, $name);
        $mail->addAddress('ofifam@santabarbara.go.cr');     //correo destino

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = '<h1>Formulario de contacto</h1>
                       <p><strong>Nombre:</strong> ' . $name . '</p>
                       <p><strong>Número de teléfono:</strong> ' . $phone . '</p>
                       <p><strong>Email:</strong> ' . $email . '</p>
                       <p><strong>Asunto:</strong> ' . $subject . '</p>
                       <p><strong>Mensaje:</strong> ' . $message . '</p>';

        // Agregar imagen adjunta si se seleccionó un archivo
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
            $attachmentPath = $_FILES['attachment']['tmp_name'];
            $attachmentName = $_FILES['attachment']['name'];
            $mail->addAttachment($attachmentPath, $attachmentName);
        }

        $mail->send();
        echo 'El mensaje ha sido enviado.';
        header("Location: success.html");
    } catch (Exception $e) {
        echo 'El mensaje no pudo ser enviado. Error del correo: ' . $mail->ErrorInfo;
    }
}
?>
