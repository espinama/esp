<?php

$hostname = "mysql8001.site4now.net";
$username = "a903ef_espina1";
$password = "TN!CZzJ4srsC_3";
$databaseName ="db_a903ef_espina1";

$connect = mysqli_connect($hostname, $username, $password, $databaseName);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$ville = mysqli_query($connect,"SELECT * FROM `ville` WHERE `show/hide`=1");
$produit = mysqli_query($connect,"SELECT * FROM `produit` WHERE `show/hide`=1");
$confirmepar = mysqli_query($connect,"SELECT * FROM `confirmationpar` WHERE `show`=1 ORDER BY `ID` desc");
$statuts = mysqli_query($connect,"SELECT * FROM `statuts` WHERE `show/hide`=1 AND NOT ID=6 ORDER BY `ID` desc");
$statutssearchconfirmation = mysqli_query($connect,"SELECT * FROM `statuts` WHERE `show/hide`=1 ORDER BY `ID` desc");
$confirmationpar = mysqli_query($connect,"SELECT * FROM `confirmationpar` WHERE `Show`=1 ORDER BY `ID` desc");
if(isset($_POST['send'])){
	$Date = $_POST['date'];
	$Datelivraison = $_POST['date'];
	$Nom = $_POST['name'];
	$Telephone = $_POST['telephone1'];
	$Produit = $_POST['boxproduit'];
	$Ref = $_POST['ref'];
	$Prixdachat = $_POST['achat'];
	$Qty = $_POST['Qty'];
	$Prix = $_POST['vente'];
	$frlivraison = $_POST['frlivraison'];
	$Ville = $_POST['boxville'];
	$Adresse = $_POST['address'];
	$Statuts = $_POST['statut'];
	$Confimationpar = $_POST['par'];
	$Cupsel = $_POST['ckeckvalue'];
	$query = "INSERT INTO `client`(`Date`, `Date de livraison`, `Nom & Prénom`, `Telephone`, `Produit`, `Ref`, `Prix dachat`, `Qty`, `Prix`, `Frais de livraison`, `Ville`, `Adresse`, `Statuts`, `Statut de laivraison`, `Confimation Par`, `CUpsell`) VALUES ('$Date','$Datelivraison','$Nom', '$Telephone', '$Produit', '$Ref', '$Prixdachat', '$Qty', '$Prix', '$frlivraison', '$Ville', '$Adresse', '$Statuts', 0, '$Confimationpar', '$Cupsel')";
	$query_run = mysqli_query($connect,$query);
}

//dd

?>