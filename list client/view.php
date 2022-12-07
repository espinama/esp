<?php
include '../config/connect.php';
include '../config/dateconfig.php';
//Start session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not   confirmationpar.ID = client.`Confimation Par` INNER JOIN (confirmationpar
if (!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) {
    header("location: ../index.php");
    exit();
}
$session_id=$_SESSION['ID'];
if($session_id == 1):
$result = mysqli_query($connect,"SELECT * FROM `client` WHERE ID=$_GET[id]");
$sqltable = mysqli_query($connect,"SELECT client.ID, CUpsell, client.`Nom & Prénom`, Par, client.Telephone, `Confimation Par`, produit.Produitname, client.Ref, client.Qty, client.Prix, client.Statuts, client.Ville, ville.Ville, client.Adresse, statuts.Statut 
FROM statuts 
INNER JOIN (ville 
INNER JOIN (confirmationpar
INNER JOIN (produit 
INNER JOIN client 
ON produit.ID = client.Produit) 
ON confirmationpar.ID = `Confimation Par`) 
ON ville.ID = client.Ville) 
ON statuts.ID = client.Statuts WHERE client.ID=$_GET[id]");

$result2 = mysqli_query($connect,"SELECT * FROM `client` WHERE ID=$_GET[id]");
$row2 = mysqli_fetch_array($result2);

$row = mysqli_fetch_array($result);
$sql = mysqli_fetch_array($sqltable);

$confirmationreader = $row2['Confimation Par'];
$villereader = $row2['Ville'];
$produitreader = $row2['Produit'];
$statutreader = $row2['Statuts'];
$produit = mysqli_query($connect,"SELECT * FROM `produit` WHERE `show/hide`=1 AND NOT ID=$produitreader");
$statuts = mysqli_query($connect,"SELECT * FROM `statuts` WHERE `show/hide`=1 AND NOT ID=$statutreader");
$ville = mysqli_query($connect,"SELECT * FROM `ville` WHERE `show/hide`=1 AND NOT ID=$villereader");
$confirmation = mysqli_query($connect,"SELECT * FROM `confirmationpar` WHERE NOT ID=$confirmationreader");
if(isset($_POST['cancel'])){

 header("location: index.php");

}

if(isset($_POST['del'])){
  if($_POST['passdel']=="0011"){
$sql = "DELETE FROM `client` WHERE ID=$_GET[id]";
if ($connect->query($sql) === TRUE) {
  header("location: index.php");
} else {
  echo "Error de modification: " . $connect->error;
}
}}
if(isset($_POST['cancel'])){

 header("location: index.php");

}
  
if(isset($_POST['valide'])){
if(count($_POST)>0){
  if("$_POST[statutdelivraison]"==0):
  $update = "UPDATE client SET `Telephone`='$_POST[telephone]', `Nom & Prénom`='$_POST[name]', 
  `Date`='$_POST[date]', `Date de livraison`='$_POST[date]', 
  Produit='$_POST[Produit]', Ref='$_POST[Ref]', 
  `Prix dachat`='$_POST[Achat]', Qty='$_POST[Qty]', Prix='$_POST[Prix]', `Frais de livraison`='$_POST[frlivraison]', 
  `Confimation Par`='$_POST[par]', `Statut de laivraison`=$_POST[statutdelivraison], `CUpsell`=$_POST[cupsell], 
  Ville='$_POST[boxville]', Adresse='$_POST[Adresse]', Statuts='$_POST[statut]' WHERE ID=$_GET[id]";
  else:
  $update = "UPDATE client SET `Telephone`='$_POST[telephone]', `Nom & Prénom`='$_POST[name]', 
  `Date`='$_POST[date]', `Date de livraison`='$today', 
  Produit='$_POST[Produit]', Ref='$_POST[Ref]', 
  `Prix dachat`='$_POST[Achat]', Qty='$_POST[Qty]', Prix='$_POST[Prix]', `Frais de livraison`='$_POST[frlivraison]', 
  `Confimation Par`='$_POST[par]', `Statut de laivraison`=$_POST[statutdelivraison], `CUpsell`=$_POST[cupsell], 
  Ville='$_POST[boxville]', Adresse='$_POST[Adresse]', Statuts='$_POST[statut]' WHERE ID=$_GET[id]";
  endif;
  if ($connect->query($update) === TRUE) {
    header("location: index.php");
  } else {
    echo "Error de modification: " . $connect->error;
  }
}}

if ($row['Statut de laivraison']==0):
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Espina - view client</title>
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
    <link rel="stylesheet" href="../styles2.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <script src="../scriptespina.js"></script>
</head>
  <body>
  <div class="banner"></div>
  <div class="container" style="height:10px;">
    <p><a href="../logout.php">Log out</a></p></div>
        <div class="row justify-content-center">
        <div class="col-md-12">
  <div class="container">
        <div class="card mt-3">
  
                    <div class="card-body">
                    <div class="row">
                                <div class="col-md-4">                           
                                    <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                         <form action="" method="POST">
                                            <label for="date">Date<span class="spn">*</span></label>
                                            <input class="form-control" type="date" name="date" value="<?php echo $row['Date'];?>" min="<?php echo $row['Date'];?>" max="<?php echo $dixjourafter;?>" required/>          
                                              </div></div>
                                          <div class="col-md-4">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                <label>Telephone<span class="spn">*</span></label>
                                                <input type="text" class="form-control" name="telephone" value="0<?php echo $row['Telephone'];?>" required/>
                                           </div></div>
                                           <div class="col-md-4">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                            <label for="name">Nom & Prénom<span class="spn">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $row['Nom & Prénom'];?>" required>
                                            </div></div>
                                            <div class="col-md-4">
                                          <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                          
                                                <label for="ville">Ville<span class="spn">*</span></label>
                                              
                                                <select name="ville" class="selectpicker" data-width="100%" data-live-search="true" onchange='selectville(this)' required>
    <option id="<?php echo $row['Frais de livraison'];?>" value="<?php echo $row['Ville'];?>"><?php echo $sql['Ville'];?></option>
<?php
					while($p = mysqli_fetch_array($ville))
{
						?>
						
				<option id="<?php echo $p['Frais de livraison'];?>" value="<?php echo $p['ID'];?>"><?php echo $p['Ville'];?></option>

					<?php
}
						?>
						</select>
                                              </div></div>
                                              <div class="col-md-1">
                                                <div class="form-group" style="margin-top:10px; margin-bottom:10px;margin-left:-13px;margin-right:-13px;">
                                                <div id="frliv">
                                                  <label>Frais<span class="spn">*</span></label>
                                                <input class="form-control" type="number" name="frlivraison" id="fr" value="<?php echo $row['Frais de livraison'];?>" required/>
                                                </div></div></div>
                                                <div class="col-md-7">
                                                <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                  <label for="address">Adresse<span class="spn">*</span></label>
                                                  <input type="text" class="form-control" name="Adresse" value="<?php echo $row['Adresse'];?>" required>
                                                </div></div>
                                                <div class="col-md-4">
                                               <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                  <label for="number">Produit<span class="spn">*</span></label>
                                                  <select class="form-select" name="Produit" onchange='selectproduit(this)'>
    <option title="<?php echo $row['Prix dachat'];?>"  id="<?php echo $row['Prix'];?>" value="<?php echo $row['Produit'];?>"><?php echo $sql['Produitname'];?></option>

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
                                              <input type="text" class="form-control" onchange="selectqty(this.value)" name="Qty" id="Qty" value="<?php echo $row['Qty'];?>" required>
                                                </div></div>
                                                <div class="col-md-2">
                                               <div class="form-group" style="margin-top:10px; margin-bottom:10px">					
                                                      <label>Achat<span class="spn">*</span></label>
                                                      <input type="text" class="form-control" name="Achat" id="achat" value="<?php echo $row['Prix dachat'];?>" required>
                                                    </div></div> 
  
                                               <div class="col-md-2">
                                               <div class="form-group" style="margin-top:10px; margin-bottom:10px">					
                                                      <label>Vente<span class="spn">*</span></label>
                                                      <input type="text" class="form-control" name="Prix" id="prixproduit" value="<?php echo $row['Prix'];?>" required>
                                                    </div></div> 
                                                    <div class="col-md-3">
                                                     <div class="form-group" style="margin-top:10px; margin-bottom:10px">
                                                      <label for="name">Réference<span class="spn">*</span></label>
                                                      <input type="text" class="form-control" name="Ref" value="<?php echo $row['Ref'];?>" required>
                                                      </div></div> 
                                                      
                                                      <div class="col-md-3">
                                                     <div class="form-group" style="margin-top:10px; margin-bottom:10px;">
                                                              <label>CUpsell</label>
                                                              <select class="form-select" name="cupsell" value="">
                                                       <option value="<?php echo $row['CUpsell'];?>"><?php if($row['CUpsell']==0): echo "Normal"; else: echo "CUpsell"; endif;?></option>
                                                       <option value="<?php if ($row['CUpsell']==0): echo "1"; else: echo "0"; endif;?>"><?php if($row['CUpsell']==0): echo "CUpsell"; else: echo "Normal"; endif;?></option>
                                                              </select>
                                                              </div></div>
                                                    
                                                   	
                                                     
                                                      <div class="col-md-3">
                                                     <div class="form-group" style="margin-top:10px; margin-bottom:10px;">	
                                                
                                                      <label>Confirmation par<span class="spn">*</span></label>
                                                       <select class="form-select" name="par" value="">
                                                       <option value="<?php echo $row['Confimation Par'];?>"><?php echo $sql['Par'];?></option>

                                                                        <?php
                                                            while($c = mysqli_fetch_array($confirmation))
                                                  {
                                                              ?>
                                                              
                                                          <option value="<?php echo $c['ID'];?>"><?php echo $c['Par'];?></option>

                                                            <?php
                                                  }
                                                              ?>
                                                              </select>
                                                              </div></div>
                                                            
          <div class="col-md-3">
          <div class="form-group" style="margin-top:10px; margin-bottom:10px;"> 
              <label>Statuts<span class="spn">*</span></label>
              <select class="form-select" name="statut" required>
    <option value="<?php echo $row['Statuts'];?>"><?php echo $sql['Statut'];?></option>
<?php
					while($p = mysqli_fetch_array($statuts))
{
						?>
						
				<option value="<?php echo $p['ID'];?>"><?php echo $p['Statut'];?></option>

					<?php
}
						?>
						</select></div></div> 
            <div class="col-md-3">
          <div class="form-group" style="margin-top:10px; margin-bottom:10px;"> 
            <label>Statut de livraison<span class="spn">*</span></label>
              <select class="form-select" name="statutdelivraison" required>
              <option value="<?php echo $row['Statut de laivraison'];?>"><?php if($row['Statut de laivraison']==0): echo "Non-Livré"; else: echo "Livre"; endif;?></option>
              <option value="<?php if ($row['Statut de laivraison']==0): echo "1"; else: echo "0"; endif;?>"><?php if ($row['Statut de laivraison']==0): echo "Livré"; else: echo "Non-Livré"; endif;?></option>
						</select></div></div> 
          </div></div></div></div></div>

            <input type="hidden" id="prixunite" value="<?php echo $sql['Prix'];?>"required/>
            <input type="hidden" id="boxville" name="boxville" value="<?php echo $row['Ville'];?>"required/>
            <div class="text-center"><br><div class="container">
            <button type="submit" name="valide" class="btn btn-success btn-lg">Appliquée</button>
            <button class="btn btn-outline-warning" type="submit" name="cancel">Annuller</button>
            <div> 
            <div class="col-md-1" style="float:right;margin-right:100px;margin-top:-42px">
                                    <div class="form-group">
                                      <input Style="" type="password" placeholder="code pin" class="form-control" name="passdel"/>
                                    <button class="btn btn-outline-danger" Style="margin-top:-58px;margin-left:100%;" type="submit" name="del">Supprimé</button>
                                    </div>
</div>
</div>
                                    
                                    </form>
<?php 
if(isset($_POST['del'])){
if($_POST['passdel']=="0011"){
}else{?>
<h6 style="float:right;color:red;margin-top:-34px"><?php echo "code accées invalid";?></h6>
<?php }} ?>
                                  
                                    </div>
                               


            




-<!--<form action="index.php">-->

  </body>
</html>
<?php else: echo "Cette client livré"; endif;
else: echo "access refusé"; endif;?>