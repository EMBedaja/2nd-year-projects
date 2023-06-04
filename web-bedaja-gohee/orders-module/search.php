<?php
include_once '../classes/class.orders.php';

//include '../config/config.php';
$orders = new orders();


// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint=' <h5>Search Result(s)</h5><table id="data-list" style="margin-top:-60px">
<tr>
<th>#</th>
<th>Customer</th>
<th>Phone Number</th>
<th>Pic-up Date</th>
<th>Pic-up Time</th>
</tr>';
$data = $orders->list_order_search($q);
if($data != false){
    //$hint = '<ul>';
    foreach($data as $value){
        extract($value);

        //$hint .= '<li>'.$ord_customer. '</li>';
        $hint .= '
       <tr>
        <td>'.$count.'</td>
        <td><a href="index.php?page=orders&action=orders&id='.$ord_id.'">'.$ord_customer.'</a></td>
        <td>'.$ord_phone_num.'</td>
        <td>'.$ord_pickup_date.'</td>
        <td>'.$ord_pickup_time.'</td>
        </tr>';
        $count++;
    }
}
$hint .= '</table>';

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No result(s)" : $hint;
?>
