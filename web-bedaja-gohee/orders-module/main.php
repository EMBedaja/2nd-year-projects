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

<div id="page">
  <div class="header">
   <h3>Food Order List</h3>
   <div class="search">
<i class='fas fa-search' style='color:#6D612D;font-size:15px'></i>&nbsp;<input type="text" id="search" name="search" onkeyup="showResults(this.value)" >
</div>

   <hr>
</div>

<div class="upbtn" style="margin-left:930px">
<?php
   //var_dump($_SESSION['user_access']);
   if($_SESSION['user_access'] !=  'Staff')
   {
?>
<a href="index.php?page=orders&action=sales">Sales</a>
<?php
   }
?>
<a href="index.php?page=orders&action=create">New Order</a> 
 </div>
 <span id="search-result">
 <div id="subcontent">
    <table id="data-list" style="margin-left:250px">
      <tr>
        <th>#</th>
        <th>Order's ID</th>
        <th>Customer</th>
        <th>Phone Number</th>
        <th>Pick-up Date</th>
        <th>Pick-up Time</th>
        <th>Action</th>
      </tr>
<?php
$count = 1;
if($orders->list_orders() != false){
foreach($orders->list_orders() as $value){
   extract($value);
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><a href="index.php?page=orders&action=orders&id=<?php echo $ord_id;?>" style="color:#856A00"><?php echo $ord_id;?></a></td>
        <td><?php echo $ord_customer;?></td>
        <td><?php echo $ord_phone_num;?></td>
        <td><?php echo $ord_pickup_date;?></td>
        <td><?php echo $ord_pickup_time;?></td>
          <td>
              <a href="index.php?page=orders&action=edit-order&id=<?php echo $ord_id;?>"><i class='fa fa-edit'  style="color:#3C5B99;margin-left:30%;"></i></a> 

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
</div>

</span>