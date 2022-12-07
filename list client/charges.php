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
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <form action="" method="GET">
                                      <label for="">du date</label><br>
                                       <input id="date" class="form-control" name ="dudate" type="date" value="<?php echo $moismonth; ?>" min="" max="<?php echo $today; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">au date</label>
                                          <input id="date" class="form-control" type="date" name ="audate" value="<?php echo $today; ?>" min="" max="<?php echo $today; ?>">
                                    </div>
                                </div>
                                
                                </div>
  
                                <div class="col-md-12">
                                    <div class="form-group">
                                    
                                        <label style="float: right;">Cliquez ici pour rechercher</label> <br>
                                      <button style="float: right;" type="submit" name ="recherche" class="btn btn-primary">Rechercher</button></form>
                                     <button style="float: right; margin-right: 5px;" class="btn btn-outline-secondary" onclick="location.href='charges.php';">Annuler la Recherche</button>
                                      <button style="float: left;" class="btn btn-success"  onclick="location.href='../home.php';">Ajouter Client</button>
                                      <button style="float: left; margin-left: 5px;"class="btn btn-outline-dark"  onclick="location.href='../list client';">List Client</button>
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
          <table id="table" class="table table-striped table-hover">       
<?php


if(isset($_GET['recherche'])){
if(isset($_GET['dudate']) && isset($_GET['audate'])){

    $from_date = $_GET['dudate'];
    $to_date = $_GET['audate'];                  
    $sqltable1 = mysqli_query($connect,"SELECT * FROM charges WHERE `Date` >= '{$from_date}%' AND `Date` <= '{$to_date}%' ORDER BY `Date` desc ,`ID` desc");
    $sqltable2 = mysqli_query($connect,"SELECT SUM(Prix) AS chargetotale FROM charges");


    if(mysqli_num_rows($sqltable1) > 0){
      ?>
                <div class="form-group">
           <div class="p-3 mb-2 bg-info text-white" style="text-align:center; font-size:22px;font-weight:bold;">Charges</div></div>
           <br>

                        <thead class="table table-dark">
                    <tr>
                        <th>Réference</th>
                        <th>Date</th>
                        <th>Charge</th>
                        <th>Prix</th>
                
                      </tr>
                      </thead>
                    <tbody>
<?php
        foreach($sqltable1 as $p)
        {
            ?>
            <tr>
            <td><?php echo $p['ID'];?></td>
            <td><?php echo $p['Date'];?></td>
            <td><?php echo $p['Charge'];?></td>
            <td><?php echo $p['Prix'];?></td>
         
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
}}else{
 ?>

<div class="text-center"><div class="fw-bold"><p class="p-3 mb-2 bg-secondary text-white">Choisi la date</p></div></div>
<?php } ?>
                          
      </tbody>
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
                          sumVal = sumVal + parseInt(table.rows[i].cells[3].innerHTML);
                        }
                        
                         // document.getElementById("val").innerHTML = sumVal;
                        console.log(sumVal);
                        document.getElementById("total").value = "Le Total des Charges au cours de la période indiquée ci-dessus  : " + sumVal + " DH";
                    </script>
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
<?php else: echo "access refusé"; endif;?>