<?php include '../config/dateconfig.php';
include '../config/connect.php';
//Start session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) {
    header("location: ../index.php");
    exit();
}
$session_id=$_SESSION['ID'];
if($session_id == 1):
?>
<!DOCTYPE html>
<html>
  <head>
  <style>
      select, table {
      text-align: center;
            }
            .confirmer{
     border-radius: 15px 50px 30px;
     background-color: rgb(255, 255, 0);
    /* box-shadow: 1px 1px 7px #A0A0A0; */
     color: black;
        }
        .saisez{
            border-radius: 15px 50px 30px;
            background-color: rgb(39, 235, 0);
        /* box-shadow: 1px 1px 7px #A0A0A0; */
            color: black;

               }
               .reporter{
                border-radius: 15px 50px 30px;
                background-color: rgb(240, 24, 60);
           /* box-shadow: 1px 1px 7px #A0A0A0; */
                color: white;
               }
      </style>
    <title>Espina - Client Manger</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
   <link rel="stylesheet" href="../styles2.css">
   <script src="../scriptespina.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
  <body> 
  <div class="banner"></div>
  <div class="container" style="height:10px;">
    <p><a href="../logout.php">Log out</a></p></div>

  <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card mt-3">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <form action="" method="GET">
                                      <label for="">du date</label><br>
                                       <input id="date" class="form-control" name ="dudate" type="date" value="<?php echo $moismonth; ?>" min="" max="<?php echo $today; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <label for="">au date</label>
                                          <input id="date" class="form-control" type="date" name ="audate" value="<?php echo $today; ?>" min="" max="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Statuts de livraison</label>
                                    <select class="form-select" name="livraisonsearch">
                                    <option value=">-1">Tous<r/option>
                                    <option value=">0">Livré<r/option>
                                    <option value="<1">Non-Livré<r/option></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Confirmation par</label>
                                    <select class="form-select" name="searchpar">
                                    <option value=">0">Tous<r/option>
                                            <?php
                                                      while($p = mysqli_fetch_array($confirmationpar))
                                            {
                                                        ?>
                                                        
                                                    <option value="=<?php echo $p['ID'];?>"><?php echo $p['Par'];?></option>

                                                      <?php
                                            }
                                                        ?>
                                                        </select>
                                    </div></div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Telephone</label>
                                          <input class="form-control" type="number" placeholder="Telephne Sans '0'" name ="searchtelephone" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Nom & Prénom</label>
                                          <input class="form-control" type="text" placeholder="Nom & Prénom" name ="searchname" value="">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Ville</label>
                                    <select class="form-select" name="searcheville">
                                    <option value=">0">Tous<r/option>
                                            <?php
                                                      while($p = mysqli_fetch_array($ville))
                                            {
                                                        ?>
                                                        
                                                    <option value="=<?php echo $p['ID'];?>"><?php echo $p['Ville'];?></option>

                                                      <?php
                                            }
                                                        ?>
                                                        </select>
                                    </div>
                                </div>


                                
                                </div>
  
                                <div class="col-md-12">
                                    <div class="form-group">
                                    
                                        <label style="float: right;">Cliquez ici pour rechercher</label> <br>
                                      <button style="float: right;" type="submit" name ="recherche" class="btn btn-primary">Rechercher</button></form>
                                     <button style="float: right; margin-right: 5px;" class="btn btn-outline-secondary" onclick="location.href='index.php';">Annuler la Recherche</button>
                                      <button style="float: left;" class="btn btn-success"  onclick="location.href='../home.php';">Ajouter Client</button>
                                      <button style="float: left; margin-left: 5px;"class="btn btn-outline-dark"  onclick="location.href='charges.php';">Charges</button>
                                      <button style="float: left; margin-left: 5px;"class="btn btn-outline-dark"  onclick="location.href='../rapport';">Agent de confimation</button>

                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
<div class="container-xxl">
<div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card mt-2">
         <!-- <p style="color:white; background-color: #F34669; border-radius: 50px 50px 50px; text-align:center; font-size:14px; margin-top:-20px;margin-left:20%; margin-right:20%">Remarque : lorsque vous changez le Statut en <span style="font-weight: bold;">Saisissez</span>, ne sera pas autorisé à les modifier.</p>-->
          <table id ="table" class="table table-striped table-hover">       
          <div class="p-3 mb-2 bg-info text-white" style="text-align:center; font-size:22px;font-weight:bold;">List de Client</div></div>
<?php



if(isset($_GET['dudate']) && isset($_GET['audate']) && isset($_GET['livraisonsearch']) && isset($_GET['searchtelephone']) && isset($_GET['searchname'])&& isset($_GET['searcheville'])){

    $from_date = $_GET['dudate'];
    $to_date = $_GET['audate'];
    $livresearch = $_GET['livraisonsearch'];                    
    $searchtelephone = $_GET['searchtelephone'];
    $searchname = $_GET['searchname'];
    $searcheville = $_GET['searcheville'];
    $searchpar = $_GET['searchpar'];
    $sqltable1 = mysqli_query($connect,"SELECT client.ID, client.Date, client.`Nom & Prénom`, DATE_FORMAT(`Date`, '%d/%m/%Y') as fdate, 
    DATE_FORMAT(`Date de livraison`, '%d/%m/%Y') as datelivre, client.`Frais de livraison`, 
    client.Telephone, produit.Produitname, client.Ref, client.`Prix dachat`,client.Qty, client.Prix, client.Statuts, `Confimation Par`, `Statut de laivraison`, 
    ville.Ville, client.Adresse, statuts.Statut 
    FROM statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) ON statuts.ID = client.Statuts
     WHERE `Date` >= '{$from_date}%' AND `Date` <= '{$to_date}%'  AND `Statut de laivraison`$livresearch AND client.Ville$searcheville AND client.`Confimation Par`$searchpar AND Telephone LIKE '%$searchtelephone%%' AND `Nom & Prénom` LIKE '%$searchname%%' ORDER BY `Date` desc ,`ID` desc");



    if(mysqli_num_rows($sqltable1) > 0){
      ?>
              <div class="form-group">
           <br>

                        <thead class="table table-dark">
                    <tr>
                    <th>ID</th>
                        <th>Date-Creation</th>
                        <th>Date-Livraison</th>
                        <th>Nom & Prénom</th>
                        <th>Telephone</th>
                        <th>Produit</th>
                        <th>Réf</th>
                        <th>Qty</th>
                        <th>Achat</th>
                        <th>Vente</th>
                        <th>Ville</th>
                        <th>Frais</th>
                        <th>Statuts</th>
                        <th>View</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
        foreach($sqltable1 as $p)
        {
            ?>
            <tr>
            <td>ES<?php echo $p['ID'];?></td>
            <td><?php echo $p['fdate'];?></td>
            <td><?php if ($p['Statut de laivraison']==0): echo "-"; else: echo $p['datelivre']; endif;?></td>
            <td><?php echo $p['Nom & Prénom'];?></td>
            <td>0<?php echo $p['Telephone'];?></td>
            <td><?php echo $p['Produitname'];?></td>
            <td><?php echo $p['Ref'];?></td>
            <td><?php echo $p['Qty'];?></td>
            <td><?php echo $p['Prix dachat']*$p['Qty'];?></td>
            <td><?php echo $p['Prix'];?></td>
            <td><?php echo $p['Ville'];?></td>
            <td><?php echo $p['Frais de livraison'];?></td>
            <td><?php if($p['Statut de laivraison'] > 0): echo "Livré"; else: echo "Non-Livré"; endif;?></td>
            
      
            <td><?php if ($p['Statut de laivraison'] < 1):?>
              <a class="btn btn-primary btn-sm" href="view.php?id=<?php echo $p['ID'];?>">View</a><?php else: endif;?></td>
           
            </tr>

            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>

<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-danger text-white">Il n'y a aucun résultat dans la recherche</p></div></div>
    <?php
                                    }
                                }else{

 $sqltable2 = mysqli_query($connect,"SELECT client.ID, client.Date, client.`Nom & Prénom`, DATE_FORMAT(`Date`,  '%d/%m/%Y') as fdate, 
 DATE_FORMAT(`Date de livraison`, '%d/%m/%Y') as datelivre, client.`Frais de livraison`, 
 client.Telephone, produit.Produitname, client.Ref, client.`Prix dachat`,client.Qty, client.Prix, client.Statuts, `Confimation Par`, `Statut de laivraison`, 
 ville.Ville, client.Adresse, statuts.Statut 
 FROM statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) ON statuts.ID = client.Statuts ORDER BY `Date` desc ,`ID` desc");
                              
if(mysqli_num_rows($sqltable2) > 0){
?>
        <div class="form-group">
           <br>

              <thead class="table table-dark">
              <tr>
              <th>ID</th>
                        <th>Date-Creation</th>
                        <th>Date-Livraison</th>
                        <th>Nom & Prénom</th>
                        <th>Telephone</th>
                        <th>Produit</th>
                        <th>Réf</th>
                        <th>Qty</th>
                        <th>Achat</th>
                        <th>Vente</th>
                        <th>Ville</th>
                        <th>Frais</th>
                        <th>Statuts</th>
                        <th>View</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
                            
while($p = $sqltable2->fetch_assoc()){ 

?>
                    
          <tr>
          <td>ES<?php echo $p['ID'];?></td>
          <td><?php echo $p['fdate'];?></td>
          <td><?php if ($p['Statut de laivraison']==0): echo "-"; else: echo $p['datelivre']; endif;?></td>
            <td><?php echo $p['Nom & Prénom'];?></td>
            <td>0<?php echo $p['Telephone'];?></td>
            <td><?php echo $p['Produitname'];?></td>
            <td><?php echo $p['Ref'];?></td>
            <td><?php echo $p['Qty'];?></td>
            <td><?php echo $p['Prix dachat']*$p['Qty'];?></td>
            <td><?php echo $p['Prix'];?></td>
            <td><?php echo $p['Ville'];?></td>
            <td><?php echo $p['Frais de livraison'];?></td>
            <td><?php if($p['Statut de laivraison'] > 0): echo "Livré"; else: echo "Non-Livré"; endif;?></td>
            
      
            <td><?php if ($p['Statut de laivraison'] < 1):?>
              <a class="btn btn-primary btn-sm" href="view.php?id=<?php echo $p['ID'];?>">View</a><?php else: endif;?></td>
          </tr>
<?php
}}
else
{ ?>

<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-danger text-white">Pas de nouveau client Essayez une autre fois</p></div></div>
    <?php
}}


						?>
                          
      </tbody>
</table>	  </div>
    </div>
	  </div>
    </div>
    </div>
</div>        
    </div>
    <div>
    </div>
  </body>
</html>
<?php else: echo "access refusé"; endif;?>