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
<link rel="icon" type="image/x-icon" href="img/logo2.png" style="width:100%">  <title>Wrap a Meal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />   
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
    <link href="https://fonts.googleapis.com/css2?family=Dongle&family=Neuton:wght@200&family=Tangerine:wght@700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="banner">
    <div class="navebar">
            <a href="index.php"><img class="logo" src="img/logo.jpeg.png"></a>
         <span class="move-right" style="color:#FFFAE6"><i class='fa fa-user' style=" color:#E4D8AB;"></i>&nbsp;&nbsp;<?php echo $user->get_user_lastname($user_id).', '.$user->get_user_firstname($user_id);?>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span>   
            <hr style="margin-top:24%;">

         <ul> 
                <li> <i class='fa-solid fa-house'></i>&nbsp;&nbsp;<a href="index.php">Home</a></li>
                <li> <i class='fa-solid fa-cart-shopping'></i>&nbsp;&nbsp;<a href="index.php?page=orders">Food Orders</a></li>
                <li> <i class='fas fa-clipboard-list'></i>&nbsp;&nbsp;<a href="index.php?page=settings&subpage=products">Products</a> </li>
                <li> <i class='fa-solid fa-users'></i>&nbsp;&nbsp;<a href="index.php?page=settings&subpage=users">Users</a></li>
                <li> <i class='fa fa-sign-out'></i> &nbsp;&nbsp;<a href="logout.php">Sign Out</a> </li>
             <span class="move-right"> <?php //echo $user->get_user_lastname($user_id).', '.$user->get_user_firstname($user_id);?> </span>  
         </ul>
                
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