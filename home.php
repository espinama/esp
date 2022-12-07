<!DOCTYPE html>
<html>
  <head>
    <title>Espina - Ajouter Client</title>
    <script>
      $(docment).ready(function()){
        $('.search_select_box select').selectpicker();
      }
   //   $(function () {
  //var nua = navigator.userAgent
  //var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)
  //if (isAndroid) {
   // $('select.form-control').removeClass('form-control').css('width', '100%')
  //}
//})
      </script>
    <style>
      input, select {
      text-align: center;
            }
            .spn{
              color: red;
            }
            .readonly{
            border: none;
            text-align: center;
            margin-top: -10px;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 17px;
            font-weight: bold;
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
  <?php include 'config/dateconfig.php';?>
     <?php include 'config/connect.php';
     include('config/session.php'); ?>
     <?php
     if (!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) {
      header("location: ../index.php");
      exit();
  }
  $session_id=$_SESSION['ID'];
  if($session_id == 1):
    $maxclient = mysqli_query($connect, "SELECT Max(client.ID) AS maxID FROM client WHERE client.`Statut de laivraison`=0;");
  else:
$maxclient = mysqli_query($connect, "SELECT Max(client.ID) AS maxID FROM client WHERE client.`Confimation Par`=2 AND client.`Statut de laivraison`=0;");endif;
$row = mysqli_fetch_array($maxclient);
$maxid = $row['maxID'];
$maxdonnes = mysqli_query($connect, "SELECT client.`Nom & Prénom`, client.Telephone, client.`Confimation Par`, ville.Ville
FROM ville INNER JOIN client ON ville.ID = client.Ville WHERE client.ID=$maxid");
$max = mysqli_fetch_array($maxdonnes);
//login
$result=mysqli_query($connect, "SELECT * FROM users WHERE ID='$session_id'")or die('Error In Session');
$usern=mysqli_fetch_array($result);
//
                                    ?>
     <div class="banner"></div>
     <div class="container">
    <p><h4 style="color:black; margin-top:-50px"><?php echo $usern['name']; ?></h4><a href="logout.php">Log out</a></p></div>
</div><div class="container">
<div class="card mt-3">
         <div class="card-body" style="background-color:#E6E6E6;">
          <div class="row">
                                    <input style="background-color:#E6E6E6;" class="readonly" type="text" value="dernière client    :     0<?php echo $max['Telephone'];?>     -     <?php echo $max['Nom & Prénom'];?>     -     <?php echo $max['Ville'];?>" readonly>
                                    </div></div></div></div>
     <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card mt-3">
                    <div class="card-body">
                    <div class="row">
                                <div class="col-md-4">                           
                                    <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                         <form action="" method="POST">
                                            <label for="date">Date<span class="spn">*</span></label>
                                            <input type="date" placeholder="yyyy-mm-dd" class="form-control" name="date" value="<?php echo $today;?>" min="<?php echo $sevenday; ?>" max="<?= date('Y-m-d') ?>" required/>          
                                              </div></div>
                                          <div class="col-md-4">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                <label>Telephone<span class="spn">*</span></label>
                                                <input class="form-control" id="tel" type="number" name="telephone1" placeholder="Telephone" required/>
                                           </div></div>
                                           <div class="col-md-4">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                            <label for="name">Nom & Prénom<span class="spn">*</span></label>
                                            <input class="form-control" id="name" type="text" name="name" placeholder="Nom & Prénom" required/>
                                            </div></div>
                                            <div class="col-md-4">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                          
                                                <label for="ville">Ville<span class="spn">*</span></label>
                                              
                                          <select class="selectpicker" data-width="100%" title="Select Ville" data-live-search="true" onchange="selectville(this)" name="ville">
                                                        <?php
                                            while($r = mysqli_fetch_array($ville))
                                  {
                                              ?>
                                          <option id="<?php echo $r['Frais de livraison'];?>" value="<?php echo $r['ID'];?>"><?php echo $r['Ville'];?></option>
                                            <?php
                                  }
                                              ?>
                                              </select>
                                              </div></div>
                                              <div class="col-md-1">
                                                <div class="form-group" style="margin-top:10px; margin-bottom:10px;margin-left:-13px;margin-right:-13px;">
                                                <div id="frliv">
                                                  <label>Frais<span class="spn">*</span></label>
                                                <input class="form-control" type="number" name="frlivraison" id="fr" required/>
                                                </div></div></div>
                                                <div class="col-md-7">
                                                <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                  <label for="address">Adresse<span class="spn">*</span></label>
                                                <input class="form-control" id="adresse" type="text" name="address" required/>
                                                </div></div>
                                                <div class="col-md-4">
                                               <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                  <label for="number">Produit<span class="spn">*</span></label>
                                            <select class="form-select" title="Select Produit" onchange='selectproduit(this)' name="produit">
                                            <option>Select Produit</option>
                                                          <?php
                                              while($p = mysqli_fetch_array($produit))
                                    {                   
                                                ?>	
                                            <option title="<?php echo $p['Prix dachat'];?>" id="<?php echo $p['Prix de vente'];?>" value="<?php echo $p['ID'];?>"><?php echo $p['Produitname'];?></option>
                                              <?php
                                    }
                                                ?>
                                                </select>
                                                </div></div>	
                                                <div class="col-md-1">
                                               <div class="form-group" style="margin-top:10px; margin-bottom:10px;margin-left:-13px;margin-right:-13px;">					
            
                                              <label>Qty<span class="spn">*</span></label>
                                               <input class="form-control" onchange="selectqty(this.value)" id="Qty" type="number" name="Qty" value="1" required/>
                                                </div></div>
                                               <div class="col-md-2">
                                               <div class="form-group" style="margin-top:10px; margin-bottom:10px">					
                                                      <label>Vente<span class="spn">*</span></label>
                                                    <input class="form-control" id="prixproduit" type="number" name="vente" required/>
                                                    </div></div> 
                                                    <div class="col-md-4">
                                                     <div class="form-group" style="margin-top:10px; margin-bottom:10px">
                                                      <label for="name">Réference<span class="spn">*</span></label>
                                                      <input class="form-control" type="text" name="ref" placeholder="Réference" required/>
                                                      </div></div> 
                                                      <div class="col-md-1">
                                                     <div class="form-group" style="padding-top:30%">
                                                              <label>CUpsel</label>
                                                    <input onclick="upsel()" name="ckeckupselbox" type="checkbox" value="<%=directorio.isPrincipal()%>" id="ckeckupselbox">
                                                    </div></div> 
                                                    <div class="col-md-2"></div>
                                                   	
                                                     
                                                      <div class="col-md-4">
                                                     <div class="form-group" style="margin-top:10px; margin-bottom:10px;">	
                                                
                                                      <label>Confirmation par<span class="spn">*</span></label>
                                                       <select class="form-select" name="par" value="">
                                                                        <?php
                                                            while($c = mysqli_fetch_array($confirmepar))
                                                  {
                                                              ?>
                                                              
                                                          <option value="<?php echo $c['ID'];?>"><?php echo $c['Par'];?></option>

                                                            <?php
                                                  }
                                                              ?>
                                                              </select>
                                                              </div></div>
                                                            
          <div class="col-md-4">
          <div class="form-group" style="margin-top:10px; margin-bottom:10px;"> 
              <label>Statuts<span class="spn">*</span></label>
            <select class="form-select" name="statut">
<?php
					while($s = mysqli_fetch_array($statuts))
{
						?>
						
				<option value="<?php echo $s['ID'];?>"><?php echo $s['Statut'];?></option>

					<?php
}
						?>
						</select></div></div> </div></div></div></div></div><br>
        
       
            <div class="text-center">
          <button class="btn btn-primary btn-lg" style="margin-left:-150px;" type="submit" name="send" value="INSERT DATA">Ajouter Client</button>
            <br><br>
            </div>
           <input type="hidden" id="prixunite" value="">
          <input type="hidden" name="achat" id="achat" value="">
		  <input type="hidden" name="ckeckvalue" id="ckeckupsel" value="">
      <input type="hidden" name="boxville" id="boxville" value="">
      <input type="hidden" name="boxproduit" id="boxproduit" value="">
      </form>
      <div class="text-center">
      <button class="btn btn-outline-info" style="margin-top:-110px; margin-right:-150px;" type="submit" onclick="location.href='confirmation';">Confirmation</button></div>
      <?php if($session_id == 1): ?>
      <div class="text-center"> <button class="btn btn-info" style="margin-top:-20px" type="submit" onclick="location.href='charges.php';">Ajouter Charges</button>
       <button class="btn btn-info" style="margin-top:-20px" type="submit" onclick="location.href='list client';">List de Client</button></div>
      <?php else:
      endif; ?>
      <?php
if(isset($_POST['send'])){
          
if($query_run)
{ ?>
<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-success text-white">Client a été Ajouté</p></div></div>
<?php }
else
  { ?>
<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-danger text-white">Client pas Ajouté</p></div></div>
  <?php }}
          ?>
      </div></div></div></div>
  </body>
</html>