<?php
/* include the class file (global - within application) */
include_once 'classes/class.user.php';
include_once 'classes/class.product.php';
include_once 'classes/class.orders.php';
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

$user = new User();
$product = new Product();
$orders = new Orders();
if(!$user->get_session()){
	header("location: login.php");
}
$user_id = $user->get_user_id($_SESSION['user_email']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://fonts.googleapis.com/css2?family=Dongle&family=Neuton:wght@200&family=Tangerine:wght@700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="banner">
    <div class="navebar">
            <a href="#"><img class="logo" src="img/logo.jpeg.png"></a>
            <i class='fas fa-user-alt' ></i> <span class="move-right"><?php echo $user->get_user_lastname($user_id).', '.$user->get_user_firstname($user_id);?>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span>   
            
         <ul> 
                <li><a href="index.php">Home</a></li>
                <li> <a href="index.php?page=orders">Food Orders</a></li>
                <li><a href="index.php?page=settings&subpage=products">Products</a> </li>
                <li> <a href="index.php?page=settings&subpage=users">Users</a></li>
             <span class="move-right"><?php //echo $user->get_user_lastname($user_id).', '.$user->get_user_firstname($user_id);?> </span>  
         </ul>
         
             <div class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></div>
                
    </div>

    <div id="content">
                <?php
                switch($page){
                            case 'settings':
                                require_once 'settings-module/index.php';
                            break; 
                            case 'orders':
                                require_once 'orders-module/index.php';
                            break; 
                            case 'inventory':
                                require_once 'inventory-module/index.php';
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