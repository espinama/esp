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
    <title>Espina - Confirmation</title>
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


                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <form action="" method="GET">
                                      <label for="">du date</label><br>
                                       <input id="date" class="form-control" name ="dudate" type="date" value="<?php echo $yesterday; ?>" min="<?php echo $mintoday; ?>" max="<?php echo $today; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">au date</label>
                                          <input id="date" class="form-control" type="date" name ="audate" value="<?php echo $today; ?>" min="<?php echo $mintoday; ?>" max="<?php echo $today; ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Statuts</label>
                                    <select class="form-select" name="statutsearch">
                                    <option value=">0">Tous les Statuts<r/option>
                                            <?php
                                                      while($p = mysqli_fetch_array($statutssearchconfirmation))
                                            {
                                                        ?>
                                                        
                                                    <option value="=<?php echo $p['ID'];?>"><?php echo $p['Statut'];?></option>

                                                      <?php
                                            }
                                                        ?>
                                                        </select>
                                    </div>
                                </div>
                                <?php if($session_id == 1): ?>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Confirmation par</label>
                                    <select class="form-select" name="cofirmationpar">
                                            <?php
                                                      while($p = mysqli_fetch_array($confirmationpar))
                                            {
                                                        ?>
                                                        
                                                    <option value="=<?php echo $p['ID'];?>"><?php echo $p['Par'];?></option>

                                                      <?php
                                            }
                                                        ?>
                                                        </select>
                                    </div></div><?php else: endif; ?>

                                <div class="col-md-12">
                                    <div class="form-group">
                                    
                                        <label style="float: right;">Cliquez ici pour rechercher</label> <br>
                                      <button style="float: right;" type="submit" name ="recherche" class="btn btn-primary">Rechercher</button></form>
                                     <button style="float: right; margin-right: 5px;" class="btn btn-outline-secondary" onclick="location.href='index.php';">Annuler la Recherche</button>
                                      <button style="float: left;" class="btn btn-success"  onclick="location.href='../home.php';">Ajouter Client</button>
                                      <button style="float: left; margin-left: 5px;"class="btn btn-outline-dark"  onclick="location.href='../rapport';">Rapport</button>
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
          <div class="form-group">
          <h2> List de Confirmation 
 
          <button style="float: right; margin-right: 15px; margin-top: 15px" class="btn btn-info" type="button" onclick='window.location.reload(false)' value="Rafraichir">Actualiser</button>
          </h2>  </div><br>
         <!-- <p style="color:white; background-color: #F34669; border-radius: 50px 50px 50px; text-align:center; font-size:14px; margin-top:-20px;margin-left:20%; margin-right:20%">Remarque : lorsque vous changez le Statut en <span style="font-weight: bold;">Saisissez</span>, ne sera pas autorisé à les modifier.</p>-->
          <table class="table table-striped table-hover">       
<?php



if(isset($_GET['dudate']) && isset($_GET['audate']) && isset($_GET['statutsearch'])){

    $from_date = $_GET['dudate'];
    $to_date = $_GET['audate'];
    $statutsearch = $_GET['statutsearch'];
if($session_id == 1): 
    $confirmationpar = $_GET['cofirmationpar']; 
    $sqltable1 = mysqli_query($connect,"SELECT client.ID, client.Date, client.`Nom & Prénom`, DATE_FORMAT(`Date`,  '%d/%m/%Y') as fdate, client.Telephone, produit.Produitname, client.Ref, client.Qty, client.Prix, client.Statuts, `Confimation Par`, `Statut de laivraison`, ville.Ville, client.Adresse, statuts.Statut 
    FROM statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) ON statuts.ID = client.Statuts
     WHERE `Statut de laivraison`=0 AND `Date` >= '{$from_date}%' AND `Date` <= '{$to_date}%' AND Statuts$statutsearch ANd `Confimation Par`$confirmationpar ORDER BY `Date` desc, `Statuts` asc, `ID` desc");

else:
      $sqltable1 = mysqli_query($connect,"SELECT client.ID, client.Date, client.`Nom & Prénom`, DATE_FORMAT(`Date`,  '%d/%m/%Y') as fdate, client.Telephone, produit.Produitname, client.Ref, client.Qty, client.Prix, client.Statuts, `Confimation Par`, `Statut de laivraison`, ville.Ville, client.Adresse, statuts.Statut 
      FROM statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) ON statuts.ID = client.Statuts
       WHERE `Statut de laivraison`=0 AND `Date` >= '{$from_date}%' AND `Date` <= '{$to_date}%' AND Statuts$statutsearch ANd `Confimation Par`=2 ORDER BY `Date` desc, `Statuts` asc, `ID` desc");
      endif;


 if($from_date >= $mintoday && $from_date <= $today && $to_date <= $today && $to_date >= $mintoday&& $from_date <= $to_date):
    if(mysqli_num_rows($sqltable1) > 0){
      ?>
                        <thead class="table table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Nom & Prénom</th>
                        <th>Telephone</th>
                        <th>Produit</th>
                        <th>Réf</th>
                        <th>Qty</th>
                        <th>Prix</th>
                        <th>Ville</th>
                        <th>Adresse</th>
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
            <td><?php echo $p['fdate'];?></td>
            <td><?php echo $p['Nom & Prénom'];?></td>
            <td>0<?php echo $p['Telephone'];?></td>
            <td><?php echo $p['Produitname'];?></td>
            <td><?php echo $p['Ref'];?></td>
            <td><?php echo $p['Qty'];?></td>
            <td><?php echo $p['Prix'];?></td>
            <td><?php echo $p['Ville'];?></td>
            <td><?php echo $p['Adresse'];?></td>
            <td class="fw-bold"> <?php
              if($p['Statuts'] == 1):
                ?>
                <p class="confirmer"><?php echo $p['Statut'];?></p>
                <?php 
                else:
                  if($p['Statuts'] == 3):
                    ?>
                    <p class="reporter"><?php echo $p['Statut'];?></p>
                    <?php 
                    else:
                if($p['Statuts'] == 6):
                  ?>
                  <p class="saisez"><?php echo $p['Statut'];?></p>
                  <?php
                  else:
                    ?>
                  <p><?php echo $p['Statut'];?></p>
                 <?php             
              endif;
            endif;
            endif;?></td>
               <?php if($p['Statuts'] == 6):
                ?>
               <td class="fw-bold" style="font-size:10px;"><p></p></td>
                <?php 
                else:
                  ?>
            <td><a class="btn btn-primary btn-sm" href="view.php?id=<?php echo $p['ID'];?>">View</a></td>
            <?php endif; ?>
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
                                  else:
                                    ?>

<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-warning text-dark">Permet l'affichage des données uniquement des 4 derniers jours</p></div></div>
                                        <?php
                                    
                                  endif;
                                }else{
                            
$sqltable2 = mysqli_query($connect,"SELECT client.ID, client.Date, client.`Nom & Prénom`, `Date`, DATE_FORMAT(`Date`,  '%d/%m/%Y') as fdate, client.Telephone, produit.Produitname, client.Ref, client.Qty, client.Prix, client.Statuts, `Confimation Par`, `Statut de laivraison`, ville.Ville, client.Adresse, statuts.Statut 
FROM statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) ON statuts.ID = client.Statuts
 WHERE `Confimation Par`=2 AND `Statut de laivraison`=0 AND `Date` >= '{$yesterday}%' AND `Date` <= '{$today}%' AND Statuts<>6 ORDER BY `Date` desc, `Statuts` desc, `ID` desc");

if(mysqli_num_rows($sqltable2) > 0){
?>
              <thead class="table table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Nom & Prénom</th>
                        <th>Telephone</th>
                        <th>Produit</th>
                        <th>Réf</th>
                        <th>Qty</th>
                        <th>Prix</th>
                        <th>Ville</th>
                        <th>Adresse</th>
                        <th>Statuts</th>
                        <th>View</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
                            
while($p = $sqltable2->fetch_assoc()){ 

?>
                    
          <tr>
            <td><?php echo $p['fdate'];?></td>
            <td><?php echo $p['Nom & Prénom'];?></td>
            <td>0<?php echo $p['Telephone'];?></td>
            <td><?php echo $p['Produitname'];?></td>
            <td><?php echo $p['Ref'];?></td>
            <td><?php echo $p['Qty'];?></td>
            <td><?php echo $p['Prix'];?></td>
            <td><?php echo $p['Ville'];?></td>
            <td><?php echo $p['Adresse'];?></td>
            <td class="fw-bold"> <?php
              if($p['Statuts'] == 1):
                ?>
                <p class="confirmer"><?php echo $p['Statut'];?></p>
                <?php 
                else:
                  if($p['Statuts'] == 3):
                    ?>
                    <p class="reporter"><?php echo $p['Statut'];?></p>
                    <?php 
                    else:
                if($p['Statuts'] == 6):
                  ?>
                  <p class="saisez"><?php echo $p['Statut'];?></p>
                  <?php
                  else:
                    ?>
                  <p><?php echo $p['Statut'];?></p>
                 <?php             
              endif;
            endif;
            endif;?></td>
            <td><a class="btn btn-primary btn-sm" href="view.php?id=<?php echo $p['ID'];?>">View</a></td>
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
  
</table>
	  </div>
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