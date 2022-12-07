<?php
include 'config/dateconfig.php';
include 'config/connect.php';
include 'config/session.php';
//login
$result=mysqli_query($connect, "SELECT * FROM users WHERE ID='$session_id'")or die('Error In Session');
$usern=mysqli_fetch_array($result);

if(isset($_POST['sendcharge'])){
	$Date = $_POST['date'];
	$Charge = $_POST['charge'];
	$Prix = $_POST['prix'];
	$querycharge = "INSERT INTO `charges`(`Date`, `Charge`, `Prix`) VALUES ('$Date','$Charge','$Prix')";
	$charge_run = mysqli_query($connect,$querycharge);
}
$session_id=$_SESSION['ID'];
if($session_id == 1):
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Espina - Charges</title>
    </script>
    <style>
      input, select {
      text-align: center;
            }
            .spn{
              color: red;
            }

                
  </style>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <link rel="stylesheet" type="text/css" href="styles2.css">
   <script src="scriptespina.js"></script>
  </head>
  <body>
     <div class="banner"></div>
     <div class="container" style="height:10px;">
    <p><a href="logout.php">Log out</a></p></div>
     <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card mt-3">
         <div class="card-body">
          <div class="row">
     <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card mt-3">
                    <div class="card-body">
                    <div class="row">
                                <div class="col-md-3">                           
                                    <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                         <form action="" method="POST">
                                            <label for="date">Date<span class="spn">*</span></label>
                                            <input type="date" placeholder="yyyy-mm-dd" class="form-control" name="date" value="<?php echo $today;?>" min="<?php echo $sevenday; ?>" max="<?= date('Y-m-d') ?>" required/>          
                                              </div></div>
                                          <div class="col-md-7">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                <label>Charges<span class="spn">*</span></label>
                                                <input class="form-control" id="" type="text" name="charge" placeholder="Charge" required/>
                                           </div></div>
                                           <div class="col-md-2">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                            <label for="name">Prix<span class="spn">*</span></label>
                                            <input class="form-control" id="" type="text" name="prix" placeholder="Prix" required/>
                                            </div></div>
     
</div></div> </div></div></div></div></div></div></div><br>
<div class="text-center">
<button type="submit" name="sendcharge" class="btn btn-success btn-lg">Appliquée</button></form>
-<!--<form action="index.php">-->
<button class="btn btn-outline-danger" onclick="location.href='home.php';">Annuller</button>
 <?php      
if(isset($_POST['sendcharge'])){    
if($charge_run)
{ ?><br>
<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-success text-white">Charge a été Ajouté</p></div></div>
<?php }
else
  { ?>
<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-danger text-white">Charge pas Ajouté</p></div></div>
  <?php }}
          ?>
      </div></div></div></div>
  </body>
</html>
<?php else: echo "access refusé"; endif;?>