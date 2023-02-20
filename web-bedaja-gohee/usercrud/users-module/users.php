<!DOCTYPE>
<html>
<head>
    </head>
<body>
    <?php
include_once 'classes/class.user.php';
/* instantiate class object */
$user = new User();
?>
<div id="third-submenu">
    <a href="index.php?page=settings&subpage=users">List Users</a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <a href="index.php?page=settings&subpage=users&action=create">Create New User</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search <input type="text"/>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'create':
                    require_once 'users-module/create-user.php';
                break; 
                case 'modify':
                    require_once 'users-module/modify-user.php';
                break; 
                case 'profile':
                    require_once 'users-module/view-profile.php';
                break;
                case 'result':
                    require_once 'users-module/search-user.php';
                break;
                default:
                    require_once 'users-module/main.php';
                break; 
            }
    ?>
  </div>

    </body></html>
