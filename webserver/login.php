<?php
   include("connect.php");
   session_start();
   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 1) 
	  {
         $_SESSION['loggedin'] = true;
         header("location: index.php");
      }
	  else 
	  {
         $error = "Felhasználónév vagy jelszó hibás";
      }
   }
?>


<!DOCTYPE html>
<html lang="hu">
<head>
	<title>SZE-Mikroelektronikai rendszerek</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!--===============================================================================================-->


</head>
<body>
<form class "" method = "post">
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/background.jpg')" >  <!--style="background-image: url('images/bg-01.jpg'); " !--> 
			
			<div class="wrap-login100">
				<form class="login100-form validate-form">
				<div style="text-align: center; font-weight: bold; color:white; margin-bottom: 15px;">
						<a href= "https://uni.sze.hu/kezdolap" target="_blank" style = "font-family: Verdana,sans-serif; color:black;" >Széchenyi István Egyetem</a></br>
					</div>
					<span class="login100-form-logo">
						<!--<i class="zmdi zmdi-landscape"></i>!-->
						<img style = "width:120px; height:120px;!" src = 'images/icons/arduino.jpg' class="w3-circle">
					</span>
					<div style="text-align: center; font-weight: bold; color:white; margin-bottom: 15px;">
							</br>DJLF47</br>
							Mikroelektronikai rendszerek
						<p>
					</div>
					<span class="login100-form-title p-b-34 p-t-27">
						
					</span>
					
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input required class="input100" type="text" name="username" placeholder="Felhasználónév">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input required class="input100" type="password" name="password" placeholder="Jelszó">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Bejelentkezés
						</button>
					</div>
					<div style="text-align: center; color:yellow; font-weight: bold;">
					<?php echo $error ?>
					</div>
					<div style="color:black; font-weight:bold; padding-top:15px;">
						<a href = "https://it.sze.hu/" target="_blank"> SZE Informatikai tanszék</a>
							<span style="float:right;">
								<a style="text-align:right;" href = "https://github.com/debnarikroland/SZE-GKLB_INTM020-Mikroelektromechanikai-rendszerek-DJLF47" target="_blank"> GitHub repository</a>
							</span>
					</div>
				</form>
			</div>
			
		</div>
	</div>
	</form>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>