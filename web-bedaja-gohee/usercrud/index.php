<?php
/* include the class file (global - within application) */
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';


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

    <div class="banner">
     <div class="navebar">
            <a href="#"><img class="logo" src="logo.jpeg.png"></a>
         <ul> 
           <li><a href="index.php">Home</a></li>
           <li><a href="#">Orders</a></li>
           <li><a href="#">Link 2</a></li>
          <div class="dropdown-menu">
<button class="menu-btn">Settings </button>
<div class="menu-content">
<a class="links-hidden" href="index.php?page=settings&subpage=users">Users</a>
    <a class="links-hidden" href="index.php?page=settings&subpage=systems">System Settings</a></div></div>
             <li><a href="#">Log Out</a></li>
         </ul>
  </div>
    <div class="container">
        <div class="home">
          <h1>WRAP A MEAL</h1>
            <p>Food and Catering Services </p></div>
     
        
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
         <div class="background">
            </div>
</div>
    </div>


</body>
</html>