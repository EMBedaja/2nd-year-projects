<div class="header">
   <h3>Product Details</h3>
</div>
<?php
include_once '../classes/class.product.php';

//include '../config/config.php';
$product = new Product();


// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint=' <h5 style="margin-left:950px;margin-top:-30px"> Search Result(s)</h5><table id="data-list">
<tr>
<th>#</th>
<th>Name</th>
<th>Description</th>
<th>Price</th>
<th>Type</th>
</tr>';
$data = $product->list_product_search($q);
if($data != false){
    //$hint = '<ul>';
    foreach($data as $value){
        extract($value);

        //$hint .= '<li>'.$prod_name. '</li>';
        $hint .= '
       <tr>
        <td>'.$count.'</td>
        <td><a href="index.php?page=settings&subpage=products&action=profile&id='.$prod_id.'" style="color:#4D3E01">'.$prod_name.'</a></td>
        <td>'.$prod_description.'</td>
        <td>'.$prod_price.'</td>
        <td>'.$product->get_prod_type_name($product->get_prod_type($prod_id)).'</td>
        </tr>';
        $count++;
    }
}
$hint .= '</table>';

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No result(s)" : $hint;
?>
