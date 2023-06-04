<div class="header">
    <h3>Product Types</h3>
</div>
                <table id="data-list">
                <tr>
                    <th>#</th>
                    <th>Product Type Code</th>
                    <th>Description</th>
                </tr>
            <?php
            $count = 1;
            $count = 1;
            if($product->list_product_type() != false){
            foreach($product->list_product_type() as $value){
            extract($value);
            
            ?>
                <tr>
                    <td><?php echo $count;?></td>
                    <td>  <?php 
    //var_dump($_SESSION['user_access']);
    if ($_SESSION['user_access'] == 'Staff') {
      echo $type_name;
    } else {
  ?><a href="index.php?page=settings&subpage=products&action=profile&id=<?php echo $type_id;?>"><?php echo $type_id;?></a>
<?php
 }
?>
  </td>
                    <td><?php echo $type_name;?></td>
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
  
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function enableSubmit() {
    document.getElementById("newForm").submit();
}
</script>