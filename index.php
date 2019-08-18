<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP kullanarak Mail Gonderme Islemi</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
<h1></h1>

<div class="container">
	<h1 class="text-center mt-5 mb-5">Php ilə poçt göndərmək</h1>
	<div class="row justify-content-center">
		<div class="col-md-6">
			
<?php if (isset($_SESSION["alert"])) { //sessionda  bir xəbərdarlıq indeksi varsa?>

<div class="alert alert-<?php echo $_SESSION["alert"]["type"];?>">
<?php 	 echo $_SESSION["alert"]["message"];//burada bir dəyişən($alert) yaradın və  gələn bir xəbərdarlıq dəyişən($alert) təyin edin?>
</div>
<?php unset($_SESSION["alert"]);//ve bu kod dogru veya sehf olan alert mesajin sehifeni yeniledikde alerti xeberdarligini siler ?>
 <?php } ?>

         <form action="send_email.php" method="post" enctype="multipart/form-data">
         	<div class="form-group">
			<label>Göndərmək istədiyin ünvan</label>
			<input class="form-control" type="email" required name="to_email">
			</div>
			<div class="form-group">
				<label>Göndərənin adı</label>
			<input class="form-control" type="text" required name="sender">
			</div>
			<div class="form-group">
				<label>Mövzu</label>
			<input class="form-control" type="text" required name="subject">
			</div>
            <div class="form-group">
            <label>Mesaj</label>
			<textarea name="message"  required cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
             <label>Fayl yukle</label>
             <input type="file" class="form-control-file" name="attachment">
             </div>
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
         </form>	
		</div>
	</div>
</div>



</body>
</html>


