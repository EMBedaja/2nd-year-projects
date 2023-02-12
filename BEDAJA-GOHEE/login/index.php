<?php
/* include the class file (global - within application) */
include_once 'classes/class.user.php';
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

$user = new User();
if(!$user->get_session()){
	header("location: login.php");
}
$user_id = $user->get_user_id($_SESSION['user_email']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Application Name</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
</head>
<body>

    <div id="header">
      <h2>Your Application Name</h2>
    </div>
<div id="wrapper">
  <div id="menu">
      <a href="index.php">Home</a> | 
      <a href="#">Link 3</a> | 
      <a href="#">Link 4</a> |
      <a href="index.php?page=settings">Settings</a> | 
      <a href="logout.php" class="move-right">Log Out</a> |
      <span class="move-right"><?php echo $user->get_user_lastname($user_id).', '.$user->get_user_firstname($user_id);?>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span> 
  </div>
  <div id="content">
    <?php
      switch($page){
                case 'settings':
                    require_once 'settings-module/index.php';
                break; 
                case 'module_two':
                    require_once 'module-folder';
                break; 
                case 'module_xxx':
                    require_once 'module-folder';
                break; 
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>
</div>

</body>
</html>