<?php
 $order = new Orders();
 $data = $order->getOrder( $_GET['id']);

 $ord_customer    = $data['ord_customer'   ] ?? '';
 $ord_phone_num   = $data['ord_phone_num'  ] ?? '';
 $ord_pickup_date = $data['ord_pickup_date'] ?? '';
 $ord_pickup_time = $data['ord_pickup_time'] ?? '';
  
 if(isset($_GET['id']))
 {
   $action = 'action="processes/process.orders.php?action=insert"';
 }
 else
 {
  $action = 'action="processes/process.orders.php?action=editRecord"';
 }
?>
<div class="header">
  <h3>Food Order Reservation</h3>
</div>
<div id="form-block" >
    <form method="POST" <?php echo $action;  ?> >
        <div id="form-block-center">
          <ul>
            <?php
            
             if(isset($_GET['id']))
             {
                $buttonName = 'Update';
            ?>
              <label for="sname">ID</label><br>
              <input disabled type="text" id="sname" class="input" name="id" value="<?php echo $_GET['id'];?>">
              <br><br>
             
             <?php
               }
               else
               {
                $buttonName = 'Create';
               }
             ?>
            <label for="sname">Customer's Name</label><br>
            <input type="text" id="sname" class="input" name="sname" placeholder="Customer's name.." value=" <?php echo $ord_customer;?>">
             <br><br>
            <label for="phone">Phone Number</label><br>
            <input type="tel" id="phone" class="input" name="phone" placeholder="Number.." value="<?php echo $ord_phone_num;?>" >
            <br><br>
            <label for="rdate">Pick-up Date</label><br>
            <input type="date" id="rdate" class="input" name="rdate" placeholder="Date.."  value="<?php echo $ord_pickup_date;?>">
            <br><br>
            <label for="rdate">Pick-up Time</label><br>
            <input type="time" id="rtime" class="input" name="rtime" placeholder="Time.." value="<?php echo $ord_pickup_time;?>">
</ul>
              </div>
        <div id="button-block">
        <input type="submit" value="<?php echo $buttonName;  ?>">
        </div>
  </form>
</div>