<?php
namespace app\controllers;


use app\models\validation\ContactModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../config/config.php';
require_once '../function/renderer.php';
 require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php'; 





class ContactController
{
    protected $EMAIL_USERNAME= EMAIL_USERNAME;
    protected $EMAIL_PASSWORD= EMAIL_PASSWORD;
    protected $EMAIL_HOST= EMAIL_HOST;
    protected $EMAIL_SECURE = EMAIL_SECURE;
    public function handleContact()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contactModel = new ContactModel();
            $contactModel->getData($_POST);
            if ($contactModel->validateData()) {
            
                    $name =$_POST['first_name'].$_POST['last_name'];
                    $email =$_POST['email'];
                    $message = $_POST['message'];
                
                    $mail = new PHPMailer();
            
              
                //Server settings
                $mail->SMTPDebug = true;                      //Enable verbose debug output
                $mail->isSMTP();     
                $mail->Mailer = "smtp";                                       //Send using SMTP
                $mail->Host       = $this->EMAIL_HOST;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $this->EMAIL_USERNAME;                     //SMTP username
                $mail->Password   = $this->EMAIL_PASSWORD;                               //SMTP password
                $mail->SMTPSecure = $this->EMAIL_SECURE;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom($this->EMAIL_USERNAME, $name);
                $mail->addAddress($this->EMAIL_USERNAME, 'Blog Admin');     //Add a recipient
               
            
                //Attachments
               
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Blog contact form';
                $mail->Body    ="Name: ".$name."<br>"."Email: ".$email."<br>"."Message:".$message;
              
              /*   echo '<pre>';
            var_dump($mail);
            echo '</pre>'; */
            if( $mail->send()){
                echo 'Your messsage already sent, I will contact to soon as I can!';
            

            } else {
                echo 'Message Error:'.$mail->ErrorInfo;
            }
               
               
            


             
             
               
           
            }
            if (!empty($contactModel->errors)) {
                $_SESSION['post_errors'] = $contactModel->errors;

            }
            header('Location:index.php');
            exit;
        }
      
    }
}