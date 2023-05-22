<div class="header">
  <h3>Food Order Transaction</h3>
</div>

<div id="orders-details">
 
  <table>
    <tr>
      <td><label for="ordrdate">Pick-up Date:</label></td>
      <td class="info-text"><?php echo $orders->get_pickup_date($id);?></td>
      <td><label for="purfrom">Orders of:</label></td>
      <td class="info-text"><?php echo $orders->get_orders_customer($id);?></td>
    </tr>
    <tr>
    <td><label for="ordrtime">Pick-up Time:</label></td>
      <td class="info-text"><?php echo $orders->get_pickup_time($id);?></td>
      <td><label for="ordstatus">Status:</label></td>
      <td class="info-text">
        <?php if($orders->get_orders_save($id) == 0){
            echo "In Progress";
          }else{
            echo "Saved Transaction";
          }
          ?>
      
      </td>
    </tr>
  </table>
</div>
<div class="btn-box" style="margin-top:-30px;margin-right:30px;float:right;">
  <?php
    if($orders->get_orders_save($id) == 0){
  ?>
<a class="btn-jsactive" onclick="document.getElementById('id01').style.display='block'">Add Product</a>
<a class="btn-jsactive" onclick="document.getElementById('id02').style.display='block'">Save</a>
      <?php
    }
    ?>
</div>

<div id="subcontent">
    <table id="data-list">
      <tr>
        <th>#</th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th> 
      </tr>
<?php
$count = 1;
$count = 1;
$total = 0;
if($orders->list_orders_items($id) != false)
{
  foreach($orders->list_orders_items($id) as $value)
  {
    extract($value);
    $prod_price    =  $product->get_prod_price($prod_id); 
    $product_total =  $prod_price * $ord_qty ; 
    $total         = $total + $product_total;
  ?>
        <tr>
          <td><?php echo $count;?></td>
          <td><?php echo $product->get_prod_name($prod_id);?></td>
          <td><?php echo $prod_price;?></td>
          <td><?php echo $ord_qty;?></td>
          <td><?php echo $product_total;?></td>
        </tr>      
  <?php
  $count++;
  }
}
else
{
  echo "No ordord Found.";
}
?>
   <tr style=" background-color:#E1BB44;font-size:17px;">
   <td style=" background-color:white;border: white"></td>
   <td style=" background-color:white;border: white"></td></td>
   <td style=" background-color:white;border: white"></td>
   <td style="width:150px;text-align:center;"><b> TOTAL AMOUNT </b> </td>
  <td><b> <?php echo $total;?><b> </td>

      </tr>  
  </table>
    

</div>
<div id="id01" class="modal">
  <div #id="form-update" class="modal-content">
    <div class="container">
   <ul>
      <h2>Select Product</h2>

      <form method="POST" id="itemForm" action="processes/process.orders.php?action=additem">
      <input type="hidden" id="ordid" name="ordid" value="<?php echo $id;?>"/>
        <label for="prodid">Product</label>
            <select name="prodid" id="prodid"> </ul>
            <?php
            $count = 1;
            $count = 1;
            var_dump($product->list_product() );
            if($product->list_product() != false)
            {
              foreach($product->list_product() as $value)
              {
                  extract($value);
                  ?>
                  <option value="<?php echo $prod_id;?>"><?php echo $prod_name;?></option>
                  <?php
                  //var_dump($value);
              }
            }
            ?>
            </select>
            <label for="qty">Received Quantity</label>
            <input type="number" id="qty" class="input" name="qty" placeholder="Quantity..">
       </form> 
      <div class="clearfix">
      <button class="submitbtn" onclick="itemSubmit()">Add</button>
        <button class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
        
      </div>
      </div>
    </div>
  </div>
</div>
<div id="id02" class="modal">
<form method="POST" id="itemSave" action="processes/process.orders.php?action=saveitem">
      <input type="hidden" id="ordid" name="ordid" value="<?php echo $id;?>"/>
      </form>
      <div #id="form-update" class="modal-content">
    <div class="container">
      <ul>
      <h2>Save Transaction</h2>
      <p>Are you sure you want to save this transaction?</p>
      <div class="clearfix">
        <button class="confirmbtn" onclick="saveSubmit()">Confirm</button>
        <button class="cancelbtn" onclick="document.getElementById('id02').style.display='none'">Cancel</button></ul>
      </div>
    </div>
    </div>
       
</div>
<script>
// Get the modal
var modal = document.getElementById('id01');
var modal_save = document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }else if(event.target == modal_save){
    modal_save.style.display = "none";
  }
}
function saveSubmit() {
    //;window.location.href = "processes/process.orders.php?action=save&id=<?php echo $id;?>";
    document.getElementById("itemSave").submit();
  }

function itemSubmit() {
  document.getElementById("itemForm").submit();
}
</script>