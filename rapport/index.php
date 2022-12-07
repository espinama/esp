<?php include '../config/dateconfig.php';?>
<?php include '../config/connect.php';
//Start session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) {
    header("location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
  <style>
      select, table {
      text-align: center;
            }
      </style>
    <title>Espina - Rapport</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
   <link rel="stylesheet" href="../styles2.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">                       
</head>
  <body>     
  <div class="banner"></div>
  <div class="container" style="height:10px;">
    <p><a href="../logout.php">Log out</a></p></div>

  <div class="container">
        <div class="row justify-content-center">

        <!-- full view -->
        <div class="col-md-12">
<!-- full view -->
        <div class="card mt-3">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <form action="" method="GET">
                                      <label for="">du date</label><br>
                                       <input id="date" class="form-control" name ="dudate" type="date" value="<?php echo $moismonth; ?>" max="<?php echo $yesterday; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">au date</label>
                                          <input id="date" class="form-control" type="date" name ="audate" value="<?php echo $today; ?>" max="<?php echo $today; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="margin-top:18px">
                      
                                <button type="submit" name ="recherche" class="btn btn-primary">Rechercher</button></form>
                                      <button style="float: right;" class="btn btn-success"  onclick="location.href='../home.php';">Ajouter Client</button>
                                      <button style="float: right; margin-right: 15px;" class="btn btn-info"  onclick="location.href='../confirmation';">Confirmation</button>

                              
                                    
                                    
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
<?php
if(isset($_GET['dudate']) && isset($_GET['audate']))
{
  $from_date = $_GET['dudate'];
  $to_date = $_GET['audate'];
  $rapportd = mysqli_query($connect,"SELECT client.ID, client.Date, DATE_FORMAT(`Date`,  '%d/%m/%Y') as datecreate, 
  DATE_FORMAT(`Date de livraison`,  '%d/%m/%Y') as datelivre, client.`Date de livraison`, client.`Statuts`, client.`Nom & Prénom`, produit.Produitname, ville.Ville, client.Qty, 
  client.CUpsell, client.`Statut de laivraison`, statuts.Statut, client.`Confimation Par`, confirmationpar.`Prix de confirmation`, confirmationpar.`Prix de upsul`
  FROM confirmationpar INNER JOIN (statuts INNER JOIN (ville INNER JOIN (produit INNER JOIN client ON produit.ID = client.Produit) ON ville.ID = client.Ville) 
  ON statuts.ID = client.Statuts) ON confirmationpar.ID = client.`Confimation Par`
  WHERE `Confimation Par`=2 AND `Date de livraison` >= '{$from_date}%' AND `Date de livraison` <= '{$to_date}%' ORDER BY `ID` desc");                                                              

  $count = mysqli_query($connect,"SELECT Count(client.ID) AS CountOfID FROM client
  WHERE `Confimation Par`=2 AND `Date de livraison` >= '{$from_date}%' AND `Date de livraison` <= '{$to_date}%'");                                                              
  $countlivre = mysqli_query($connect,"SELECT Count(client.ID) AS CountOfID FROM client
  WHERE `Confimation Par`=2 AND `Statut de laivraison`=0 AND `Date de livraison` >= '{$from_date}%' AND `Date de livraison` <= '{$to_date}%'");                                                              
  $countnonlivre = mysqli_query($connect,"SELECT Count(client.ID) AS CountOfID FROM client
  WHERE `Confimation Par`=2 AND `Statut de laivraison`>0 AND `Date de livraison` >= '{$from_date}%' AND `Date de livraison` <= '{$to_date}%'");                                                              

  while($ps = mysqli_fetch_assoc($count)){
    $countall = $ps['CountOfID'];
  }
  while($ps = mysqli_fetch_assoc($countlivre)){
    $livre = $ps['CountOfID'];
  }
  while($ps = mysqli_fetch_assoc($countnonlivre)){
    $nonlivre = $ps['CountOfID'];
  }
    if(mysqli_num_rows($rapportd) > 0){
      ?>
      <div class="text-center"><div class="fw-bold"><h3 class="p-3 mb-2 bg-success text-white">Rapport de Confirmation</h3></div></div>
                <h5 class="text-center"><?php echo $countall;?> Commandes :: <?php echo $nonlivre;?> Livré et <?php echo $livre;?> non livré </h5>

          <table id="table" class="table table-striped table-hover">  
                        <thead class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Date-Creation</th>
                        <th>Date-Livraison</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Qty</th>
                        <th>Ville</th>
                        <th>Statut de livraison</th>
                        <th>Profit</th>
                      </tr>
                      </tr>
                    </thead>
                    <tbody>
<?php
        foreach($rapportd as $p)
        {
            ?>
          <tr>
          <td><?php if ($p['Statut de laivraison']==1):
         echo "ES"; echo $p['ID'];
          else:
            if($p['Statuts']==6):
              echo "ES"; echo $p['ID'];
            else:
              echo "-";
            endif;
          endif; ?></td>
          <td><?php echo $p['datecreate'];?></td>
          <td><?php 
          if($p['Statut de laivraison'] > 0):
            echo $p['datelivre'];
          else:
            echo "...";
          endif;
          ?></td>
          <td><?php echo $p['Nom & Prénom'];?></td>
          <td><?php echo $p['Produitname'];?></td>
          <td><?php echo $p['Qty'];?></td>
          <td><?php echo $p['Ville'];?></td>
          <td><?php if($p['Statut de laivraison'] > 0):
          echo "Livré";
          else:
            echo "Non-Livré";
          endif;
          ?></td>

<td><?php 
if($p['Statut de laivraison'] > 0):
      if($p['CUpsell'] > 0):
           if($p['Qty'] > 1):
               echo $p['Prix de upsul']*$p['Qty'];echo " CUpsell"; //Cupsell
               else:
               echo $p['Prix de upsul'];echo " CUpsell"; //Cupsell
            endif;
      else:
      if($p['Qty'] > 1):
       echo $p['Prix de confirmation']+$p['Prix de upsul']*$p['Qty']-$p['Prix de upsul'];echo " Upsell";
        else:
       echo $p['Prix de confirmation'];
     endif;
    endif;
  else:
echo "0";
endif;    ?></td>
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

?>
<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-secondary text-white">Choisissez une date de et à, appuyez sur le bouton de recherche</p></div></div>
    <?php
}


						?>
                          
      </tbody>
    </form>
<style>
    .readonly{
            border: none;
            text-align: center;
            margin-top: -10px;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 18px;
          }
        
</style>
<input class="readonly" type="text" id="count" value="" readonly>
<input class="readonly" type="text" id="total" value="" readonly>     
</table>
<script>
              //sum rapport
            var table = document.getElementById("table"), sumVal = 0;
                        
                        for(var i = 1; i < table.rows.length; i++)
                        {
                          sumVal = sumVal + parseInt(table.rows[i].cells[8].innerHTML);
                        }
                        
                         // document.getElementById("val").innerHTML = sumVal;
                        console.log(sumVal);
                        document.getElementById("total").value = "Le Total des Revenus au cours de la période indiquée ci-dessus  : " + sumVal + " DH";
                    </script>

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