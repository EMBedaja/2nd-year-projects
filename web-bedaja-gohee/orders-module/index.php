<div id="subcontent">
    <?php
      switch($action){
                case 'create':
                    require_once 'orders-module/create-transaction.php';
                break; 
                case 'orders':
                    require_once 'orders-module/orders-products.php';
                break; 
                case 'edit-order':
                    require_once 'orders-module/edit-transaction.php';
                break; 
                case 'profile':
                    require_once 'orders-module/view-product.php';
                break;
                case 'types':
                    require_once 'orders-module/list-product-types.php';
                break;
                case 'upload':
                    require_once 'orders-module/imageupload.php';
                break;
                case 'sales':
                    require_once 'orders-module/sales.php';
                    break;
                default:
                    require_once 'orders-module/main.php';
                break; 
            }
    ?>
  </div>