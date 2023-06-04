<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>            
            
<?php
include_once 'config/config.php';
include_once 'classes/class.user.php';

$user = new User();
if($user->get_session()){
	header("location: index.php");
}
if(isset($_REQUEST['submit'])){
	extract($_REQUEST);
	$login = $user->check_login($useremail,md5($password));
	if($login){
		header("location: index.php");
	}else{
		?>
        <div id='error_notif'>Wrong email or password.</div>
        <?php
	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wrap a Meal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Neuton:wght@200&family=Tangerine:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
</head>
<body style="background-color:#EDDCAB; background-image: linear-gradient(to right,#DFB12A, #EDDCAB);">

<div id="login-block">
    <img src="img/logo.jpeg.png">
    <h4 >Wrap a Meal</h4>
	<h3>Please LOG IN </h3>
	<form method="POST" action="" name="login">
	<div class="input-container">
	<i class='fa fa-envelope' style="color:black;background-color:#C4C3C1;min-width:30px;padding: 10px;text-align: center;height:40px;margin-top:2.5px"></i><input type="email" class="input"  name="useremail" placeholder="E-mail" required="required" />
	</div>
	<div class="input-container">
	<i class='fa fa-key' style="color:black;background-color:#C4C3C1;min-width:30px;padding: 10px;text-align: center;height:40px;margin-top:2.5px"></i><input type="password" class="input"  name="password" placeholder="Password" required="required" />
	</div>
	<div>
		<input type="submit" name="submit" value="Submit" style="float:right"/>
	</div>
	</form>
</div>
</body>
</html>