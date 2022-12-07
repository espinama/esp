<?php
include '../config/connect.php';
include '../config/dateconfig.php';
//Start session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) {
    header("location: ../index.php");
    exit();
}$session_id=$_SESSION['ID'];
if($session_id == 1):
$result = mysqli_query($connect,"SELECT * FROM `client` WHERE ID=$_GET[id] AND `Statut de laivraison`=0  AND `Date` >= '{$mintoday}%' AND `Date` <= '{$today}%'");
$sqltable = mysqli_query($connect,"SELECT client.ID, client.`Nom & Prénom`, client.Telephone, produit.Produitname, client.Ref, client.Qty, client.Prix, client.Statuts, client.Ville, ville.Ville, client.Adresse, statuts.Statut 
FROM statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) ON statuts.ID = client.Statuts WHERE client.ID=$_GET[id]");
$result2 = mysqli_query($connect,"SELECT * FROM `client` WHERE ID=$_GET[id] AND `Statut de laivraison`=0 AND `Date` >= '{$mintoday}%' AND `Date` <= '{$dixjourafter}%'");
else:
  $result = mysqli_query($connect,"SELECT * FROM `client` WHERE ID=$_GET[id] AND `Confimation Par`=2 AND `Statut de laivraison`=0  AND `Date` >= '{$mintoday}%' AND `Date` <= '{$today}%'");
  $sqltable = mysqli_query($connect,"SELECT client.ID, client.`Nom & Prénom`, client.Telephone, produit.Produitname, client.Ref, client.Qty, client.Prix, client.Statuts, client.Ville, ville.Ville, client.Adresse, statuts.Statut 
  FROM statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) ON statuts.ID = client.Statuts WHERE client.ID=$_GET[id]");
  $result2 = mysqli_query($connect,"SELECT * FROM `client` WHERE ID=$_GET[id] AND `Confimation Par`=2 AND `Statut de laivraison`=0 AND `Date` >= '{$mintoday}%' AND `Date` <= '{$dixjourafter}%'");
  endif;


$row2 = mysqli_fetch_array($result2);
$row = mysqli_fetch_array($result);
$sql = mysqli_fetch_array($sqltable);

$villereader = $row2['Ville'];
$produitreader = $row2['Produit'];
$statutreader = $row2['Statuts'];
$produit = mysqli_query($connect,"SELECT * FROM `produit` WHERE `show/hide`=1 AND NOT ID=$produitreader");
$statuts = mysqli_query($connect,"SELECT * FROM `statuts` WHERE `show/hide`=1 AND NOT ID=$statutreader");
$ville = mysqli_query($connect,"SELECT * FROM `ville` WHERE `show/hide`=1 AND NOT ID=$villereader");
if(isset($_POST['valide'])){
if(count($_POST)>0){    
$update = "UPDATE client SET `Nom & Prénom`='$_POST[name]', `Date`='$_POST[date]', `Date de livraison`='$_POST[date]', Produit='$_POST[disabledproduit]', Ref='$_POST[Ref]',
`Prix dachat`='$_POST[achat]', Qty='$_POST[Qty]', Prix='$_POST[Prix]', `Frais de livraison`='$_POST[frlivraison]',
Ville='$_POST[Ville]', Adresse='$_POST[Adresse]', Statuts='$_POST[statut]' WHERE ID=$_GET[id]";
if ($connect->query($update) === TRUE) {
    header("location: index.php");
  } else {
    echo "Error de modification: " . $connect->error;
  }
}}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Espina - view client</title>
    <style>
      input, select {
      text-align: center;
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
   <script src="copyscript.js"></script>
</head>
  <body>
  <div class="banner"></div>
  
     <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-7">
  <div class="container" style="height:10px;">
    <p><a href="../logout.php">Log out</a></p></div>
        <div class="card mt-3"> 
          

         <div class="card-body">

           <div class="row">   

          <div class="form-group">
            <?php
          if($row['Statuts'] <> 6):
           ?>
              <form action="" method="POST">
              <div class="row mb-3" style="margin-top:-10px">  
      <label class="col-sm-3 col-form-label"></label>
       <div class="col-sm-6">
    </div><div class="col-sm-3" style="margin-top:-20px;height:17px;"><span style="font-size:13px;text-align:center;padding-top:-24px;">
    <input style="border-width:1px;height:30px;margin-left:-10px;" class="form-control" type="text" id="copytext0" value="ES<?php echo $sql['ID'];?>" readonly></span><p style="color:black;margin-top:-43px;margin-left:-20px">Référence</p></div></div> 

    <div class="row mb-3" style="margin-top:-10px">  
      <label class="col-sm-3 col-form-label">Telephone</label>
       <div class="col-sm-9">
     <input type="text" class="form-control" id="copytext1" name="telephone" value="0<?php echo $row['Telephone'];?>" readonly>
    </div></div> 
           
    
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label" >Date</label>
    <div class="col-sm-9">
       <input class="form-control" type="date" name="date" value="<?php echo $row['Date'];?>" min="<?php echo $row['Date'];?>" max="<?php echo $dixjourafter;?>" required/>          
      </div></div>




                                            
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Nom & Prénom</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="copytext2" name="name" value="<?php echo $row['Nom & Prénom'];?>" required>
        </div></div> 
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Produit</label>
    <div class="col-sm-9">
    <select class="form-select" name="Produit" onchange='selectproduit(this)' disabled>
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
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Référence</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="copytext3" name="Ref" value="<?php echo $row['Ref'];?>" required>
       </div></div> 
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Qty</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" onchange="selectqty(this.value)" name="Qty" id="Qty" value="<?php echo $row['Qty'];?>" required>
    </div></div>
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Prix</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="Prix" id="prixproduit" value="<?php echo $row['Prix'];?>" required>
        </div></div> 
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Ville</label>
    <div class="col-sm-9">
    <select class="selectpicker" data-width="100%" data-live-search="true" name="Ville" onchange='selectville(this)' required>
    <option title="<?php echo $sql['Ville'];?>" id="<?php echo $row['Frais de livraison'];?>" value="<?php echo $row['Ville'];?>"><?php echo $sql['Ville'];?></option>
<?php
					while($p = mysqli_fetch_array($ville))
{
						?>
						
				<option title="<?php echo $p['Ville'];?>" id="<?php echo $p['Frais de livraison'];?>" value="<?php echo $p['ID'];?>"><?php echo $p['Ville'];?></option>

					<?php
}
						?>
						</select>
            </div><!--<div class="col-sm-2"><input type="text" class="form-control" onclick="myFunction5()" value="c" readonly></div>--></div>
            
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Adresse</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="Adresse" id="copytext6" value="<?php echo $row['Adresse'];?>" required>
       </div></div> 
    <div class="row mb-3" style="margin-top:-10px">
    <label class="col-sm-3 col-form-label">Statut</label>
    <div class="col-sm-9">
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
						</select><br></div></div></div></div>
            
            <input type="hidden" id="prixunite" value="<?php echo $sql['Prix'];?>"required/>
            <input type="hidden" name="disabledproduit" value="<?php echo $row['Produit'];?>" required/>
            <input type="hidden" name="achat" id="achat" value="<?php echo $row['Prix dachat'];?>"required/>
           

<input type="hidden" name="frlivraison" id="fr" value="<?php echo $row['Frais de livraison'];?>" required/>




            <div class="text-center">
            
    
          <!--  <input type="text" style="border-width:0px;width:0px;height:0px;margin-top:-400px;" id="copytext0" value="ES<?php echo $sql['ID'];?>"/>-->
<button type="submit" name="valide" class="btn btn-success btn-lg">Appliquée</button></form>
<!--<form action="index.php">-->
<button class="btn btn-outline-danger" onclick="location.href='index.php';">Annuller</button></div>
<?php
else:
  echo "Vous n'êtes pas autorisé";
endif;
?>
<input type="text" style="border-width:0px;color:white;margin-top:-400px;width:1px;height:1px;" id="copytext5" value="<?php echo $sql['Ville'];?>"/>
</div></div></div>

  </body>
</html>