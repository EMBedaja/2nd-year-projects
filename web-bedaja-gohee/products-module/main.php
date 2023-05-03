<div class="header">
   <h3>Product Details</h3><br>
   </div>

   <div class="searchBox">
    <input class="searchInput"type="text" name="" placeholder="Search" onkeyup="showResults(this.value)">
    <button class="searchButton" href="#">
    <i class="fa fa-search"></i>
    </button>
</div>

<div class="upbtn" style="margin-right:70px">
<a href="index.php?page=settings&subpage=products&action=create">New Product</a>
    <a href="index.php?page=settings&subpage=products&action=types">Product Types</a>
</div>
<div id="subcontent">
    <table id="data-list">
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
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><a href="index.php?page=settings&subpage=products&action=profile&id=
        <?php echo $prod_id;?>"><?php echo $prod_name;?></a></td>
        <td><?php echo $prod_description;?></td>
        <td><?php echo $prod_price;?></td>
        <td><?php echo $product->get_prod_type_name($product->get_prod_type($prod_id));?></td>
      </tr>
      <tr>
<?php
 $count++;
}
}else{
  echo "No Record Found.";
}
?>
    </table>
</div>