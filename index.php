<?php session_start(); ?>
<?php include 'config/connect.php';?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Login</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Identifiant" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Mot de passe" required></input>
    </div>
    <div>
            <small><?= $errors['agree'] ?? '' ?></small>
        </div>
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
  </form>
  <?php
	if (isset($_POST['login']))
		{
			$username = mysqli_real_escape_string($connect, $_POST['user']);
			$password = mysqli_real_escape_string($connect, $_POST['pass']);
			
			$query 		= mysqli_query($connect, "SELECT * FROM users WHERE `password`='$password' and username='$username'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);
			
			if ($num_row > 0) 
				{			
					$_SESSION['ID']=$row['ID'];
					header('location: home.php');
					
				}
			else
				{
					echo 'identifiant ou mot de passe incorrect';
				}
		}
  ?>
</div>

</body>
</html>