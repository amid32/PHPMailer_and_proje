<?php
// birinci novbede gmail accaunt'da("Daha az təhlükəsiz tətbiq girişi // less secure app access") aktiv etmelisiniz bunu aktiv etmeseniz gmail gondermek hecbir iseyaramaz!!!

/*Birde qeydedimki phpmailer istifade eden zaman ("composer") yuklemey unutmayin  */



session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require"vendor/autoload.php"; //autoload.php file daxil edtmek


if (isset($_POST)) { //əyər hər hansı bir post varsa if icindəki bolumler isləyəcəkdir
   if($_POST["to_email"] && $_POST["sender"] && $_POST["subject"] && $_POST["message"]){ //burada kantroleder "sender" inxden birshey geldimi gelmedimi bosdu baxar
     
    $file = $_FILES["attachment"];
    if(move_uploaded_file($file["tmp_name"],"files/".$file["name"])){//bu yeni file al ("name") index icine gonder
    // print_r($file);
    // die();
$mail = new PHPMailer(true);//php maileri ishesalamq 
  try {
    //xidmət parametrləri
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = "ssl://smtp.gmail.com"; //təhlükəsiz bir göndərmə kodu
    $mail->SMTPAuth = true; //bu kod yeni SMTP'den gonderildiyi ucun aktived
    $mail->Username = "example@gmail.com";//bura maile adini daxil edin
    $mail->Password = "*************";//Burada Mail Password daxil edin
    $mail->CharSet  = "utf8";
    $mail->SMTPSecure = "tls";
    $mail->Port = 465;

    //qəbuledici parametrləri
    $mail->setFrom("example@gmail.com",$_POST["sender"]);//email haradan gedecek
    $mail->addAddress($_POST["to_email"],""); //hara gidecek
    $mail->addAttachment("files/".$file["name"]);//burada file url adresinin yoludur
  //$mail->addBCC("","");
  //$mail->addCC("","");

    //poçt parametrləri
    $mail->isHTML();
    $mail->Subject = $_POST["subject"];//bu haradan gelecey kod
    $mail->Body = $_POST["message"];  //postan gelen mesaj

    if ($mail->send()) {
     $alert = array(         
           "message"  => "Mailer Ugurlusekilde Gonderildi", //xetam mesaji
           "type"    => "success" //dinamik dəyişiklik
      );

    }else {
      $alert = array(         
           "message"  => "Mailer Gonderilmedi xeta basverdi", //xetam mesaji
           "type"    => "danger" //dinamik dəyişiklik
      );
    }
  } catch (Exception $e) { //xeta codu
        $alert = array(         
           "message"  => $e->getMessage(), //xetam mesaji
           "type"    => "danger" //dinamik dəyişiklik
      );
  }    

}else{
   $alert = array(   
           "message"  => "Tesuf ki File yuklenerken xeta bashverdi", //xetam mesaji
           "type"    => "danger" //dinamik dəyişiklik
      );

}

   }else {
   	  $alert = array(   
           "message"  => "xahiş olunur bütün xanalari doldurun", //xetam mesaji
           "type"    => "danger" //dinamik dəyişiklik
   	  );
   } 
        $_SESSION["alert"] = $alert; //array sessiona  təyin etdik
         header("Location:index.php");

}


?>

