<div class="header">
   <h3>Food Order List</h3><br> <br>
</div>

<div class="searchBox">
    <input class="searchInput"type="text" name="" placeholder="Search" onkeyup="showResults(this.value)">
    <button class="searchButton" href="#">
    <i class="fa fa-search"></i>
    </button>
</div>

<div id="subcontent">
<div class="upbtn" style="margin-right:110px"><a href="index.php?page=orders&action=create">New Order</a>
<a href="#">Sales</a>
 </div>

    <table id="data-list" >
      <tr>
        <th>#</th>
        <th>Order's ID</th>
        <th>Customer</th>
        <th>Phone Number</th>
        <th>Pick-up Date</th>
        <th>Pick-up Time</th>
        <th>Status</th>
      </tr>
<?php
$count = 1;
$count = 1;
if($orders->list_orders() != false){
foreach($orders->list_orders() as $value){
   extract($value);
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><a href="index.php?page=orders&action=orders&id=<?php echo $ord_id;?>"><?php echo $ord_id;?></a></td>
        <td><?php echo $ord_customer;?></td>
        <td><?php echo $ord_phone_num;?></td>
        <td><?php echo $ord_pickup_date;?></td>
        <td><?php echo $ord_pickup_time;?></td>
        <td><?php if($ord_saved == 0){
            echo "In Progress";
          }else{
            echo "Saved Transaction";
          }
          ?>
          </td>
      </tr>
      <tr>
<?php
 $count++;
}
}else{
  echo "No order Found.";
}
?>
    </table>
</div>