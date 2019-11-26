<?php
// Initialize the session
include("connect.php");
session_start();

$error = "";


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}
else
{
	$sql = "SELECT * FROM light";
	$result = mysqli_query($db,$sql);
 
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		if($row["name"] == "hall")
		{
			$hall = $row["status"];
		}
		else if ($row["name"] == "kitchen")
		{
			$kitchen = $row["status"];
		}
		else if ($row["name"] == "bathroom")
		{
			$bathroom = $row["status"];
		}
		else if ($row["name"] == "bedroom")
		{
			$bedroom = $row["status"];
		}
		
		//printf ("%s (%s)\n", $row["id"], $row["name"]);
	}
}
?>

 
<!DOCTYPE html>
<html lang="hu">
<head>
<script>
var myVar = <?php echo json_encode($val); ?>;
</script>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.3/styles/github.min.css" rel="stylesheet" >
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap-toggle.css" rel="stylesheet">
	<link href="doc/stylesheet.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="doc/script.js"></script>

	<script src="js/bootstrap-toggle.js"></script>
</head>
<body>
    <div class="limiter">
		<div class="container-login100" style="background-image: url('images/background.jpg')" >  <!--style="background-image: url('images/bg-01.jpg'); " !--> 
			
			<div  class="wrap-login100" >
				<form class="login100-form validate-form">
				
					<div style="text-align: center; font-weight: bold; font-size:20px; color:white; margin-bottom: 15px;">
							Széchenyi István Egyetem</br>
							DJLF47</br>
								Mikroelektronikai rendszerek
							<p>
					</div>
					
					<div style = "margin-bottom: 20px;">
						<a href = "index.php" style = "text-decoration:none;"><button type="button" class="btn btn-primary btn-lg btn-block" style = "margin-bottom: 15px;">Világítás vezérlés</button> </a>
						<a href = "temperature.php" style = "text-decoration:none;"><button type="button" class="btn btn-primary btn-lg btn-block" style = "margin-bottom: 15px;">Hőmérsékleti adatok</button> </a>
					</div>
					
					<div style = "padding-bottom:5px;">
						<b style="color:black;  margin-left:55px;">Konyha</b>
						<b  style = "float:right; color:black; margin-right:50px;">Előszoba</b>
					</div>
					
					<div style = "margin-bottom:30px; margin-left:25px;">
						<input id = 'kitchen' type="checkbox" data-toggle="toggle" data-on="Bekapcsolva" data-off="Kikapcsolva">
						<span style = "float:right; margin-right:25px;">
							<input id = 'hall' type="checkbox" data-toggle="toggle" data-on="Bekapcsolva" data-off="Kikapcsolva">
						</span>
					</div>
						
					<div style = "padding-bottom:5px;">
						<b style="color:black;  margin-left:45px;">Fürdőszoba</b>
						<b  style = "float:right; color:black; margin-right:45px;">Hálószoba</b>
					</div>
						
					<div style = "margin-left:25px;">
						<input id = 'bathroom'  type="checkbox" data-toggle="toggle" data-on="Bekapcsolva" data-off="Kikapcsolva">
						<span style = "float:right; margin-right:25px;">
							<input id = 'bedroom' type="checkbox" data-toggle="toggle" data-on="Bekapcsolva" data-off="Kikapcsolva">
						</span>
					</div>
					<div style="color:black; font-weight:bold; padding-top:45px;">
						<a class = "link" href = "https://it.sze.hu/" target="_blank" style = "text-decoration:none;" > SZE Informatikai tanszék</a>
							<span style="float:right;">
								<a style = "text-decoration:none;" style="text-align:right;" href = "https://github.com/debnarikroland/SZE-GKLB_INTM020-Mikroelektromechanikai-rendszerek-DJLF47" target="_blank"> GitHub repository</a>
							</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	<style>
a:link {
  color: black;
}

a:visited {
  color: black;
}

a:hover {
  color: white;
}

a:active {
  color: yellow;
} 
</style>
</body>
<script>
$('#hall').bootstrapToggle('<?php echo $hall ?>')
$('#kitchen').bootstrapToggle('<?php echo $kitchen ?>')
$('#bathroom').bootstrapToggle('<?php echo $bathroom ?>')
$('#bedroom').bootstrapToggle('<?php echo $bedroom ?>')
	
	
	var switchStatus = false;
	
	$("#kitchen").on('change', function() {
    if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
		update("kitchen", "on");
    }
    else {
       switchStatus = $(this).is(':checked');
	   update("kitchen", "off");
    }
});
var switchStatus = false;
	$("#hall").on('change', function() {
    if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
		update("hall","on")
    }
    else {
       switchStatus = $(this).is(':checked');
	   update("hall","off");
    }
});

var switchStatus = false;
	$("#bathroom").on('change', function() {
    if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
		update("bathroom","on")
    }
    else {
       switchStatus = $(this).is(':checked');
	   update("bathroom","off");
    }
});

var switchStatus = false;
	$("#bedroom").on('change', function() {
    if ($(this).is(':checked')) {
        switchStatus = $(this).is(':checked');
		update("bedroom","on")
		
    }
    else {
       switchStatus = $(this).is(':checked');
	   update("bedroom","off");
    }
});
function update(name, status)
{
	jQuery.ajax({
       type: "POST",
       url: "update.php",
       data: 'name='+name+'&status='+status,
       cache: false,
       success: function(response)
       {}          
     });
}
	
</script>

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

</html>