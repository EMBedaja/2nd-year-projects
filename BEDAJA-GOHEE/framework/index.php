<?php
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
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
    <link rel="stylesheet" href="css/style.css?<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="container" class="container"> 
   <div id="header">
       <div class="navbar">
           <h2> Application Name</h2>
            <a href="index.php"> Home</a>
           <a href="#">Link 1</a>
             <a href="#">Link 2</a>
            <a href="index.php?page=settings">Settings</a> 
         <a href="#"><span>Log Out</span></a>
       </div>
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