<!DOCTYPE html>
<html>
<head>
     <title>Wrap a Meal</title>
</head>
<body>
    <div class="main"  style="margin-left: 120px;">
    <center> 
             <a href="index.php?page=orders&action=create"> <img src="img/food.png"></a>
            <a href="index.php?page=settings&subpage=products"> <img src="img/product.png"></a>
            <?php 
    //var_dump($_SESSION['user_access']);
    if ($_SESSION['user_access'] == 'Staff') {
    } else {
  ?>  <a href="index.php?page=orders&action=sales"><img src="img/sales.png"></a>
  <?php } ?>
</center>
</div>  
<div class="background"> </div>

</body>
</html>