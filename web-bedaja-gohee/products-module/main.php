<script>
function showResults(str) {
  //alert(str.length);
  // if (str.length == 0) {
    // document.getElementById("search-result").innerHTML = "";
    // return;
  // } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("search-result").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "orders-module/search.php?q=" + str, true);
    xmlhttp.send();
  // }
}
</script>


  <div class="header">
   <h3>Product Details</h3>
   <div class="search">
<i class='fas fa-search' style='color:#6D612D;font-size:15px'></i>&nbsp;<input type="text" id="search" name="search" onkeyup="showResults(this.value)">
</div>
   <hr>
</div>

<div class="upbtn" style="margin-left:815px">
<?php
   //var_dump($_SESSION['user_access']);
   if($_SESSION['user_access'] !=  'Staff')
   {
?>
     <a href="index.php?page=settings&subpage=products&action=create">New Product</a>


    <a href="index.php?page=settings&subpage=products&action=types">Product Types</a><?php
   }
?>
</div>
<span id="search-result">
<div id="subcontent">
    <table id="data-list" style="width:70%">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Type</th>
      </tr>
<?php
$count = 1;
$count = 1;
if($product->list_product() != false){
foreach($product->list_product() as $value){
   extract($value);
  
?>  <tr>
<td><?php echo $count; ?></td>
<td>
  <?php 
    //var_dump($_SESSION['user_access']);
    if ($_SESSION['user_access'] == 'Staff') {
      echo $prod_name;
    } else {
  ?>
      <a href="index.php?page=settings&subpage=products&action=profile&id=<?php echo $prod_id; ?>" style="color:#4D3E01"><?php echo $prod_name; ?></a>
  <?php
    }
  ?>
</td>
<td><?php echo $prod_description; ?></td>
<td><?php echo $prod_price; ?></td>
<td><?php echo $product->get_prod_type_name($product->get_prod_type($prod_id)); ?></td>
</tr>
<?php
 $count++;
}
}else{
  echo "No Record Found.";
}
?>
    </table>
</div> 
</span>