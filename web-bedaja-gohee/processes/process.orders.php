<?php
include '../classes/class.orders.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'insert':
        create_new_transaction();
	break;
    case 'additem':
        new_orders_item();
	break;
    case 'saveitem':
        save_orders_items();
	break;
    case 'edititem':
        edit_orders_items();
	break;
    
    case 'editRecord':
        editRecord();
	break;
    
}
function create_new_transaction(){
	$orders = new orders();
   $name= ucwords($_POST['sname']);
    $phone= ucwords($_POST['phone']); 
    $rdate= $_POST['rdate']; 
    $rtime= $_POST['rtime']; 
    $rid = $orders->insert_record($name, $phone, $rdate,$rtime);
    if(is_numeric($rid)){
    header('location: ../index.php?page=orders&action=orders&id='.$rid);
    }
}

function new_orders_item(){
	$orders = new orders();
    $ordid= $_POST['ordid'];
    $prodid= $_POST['prodid']; 
    $qty= $_POST['qty']; 
    $rid = $orders->new_orders_item($ordid, $prodid, $qty);
    if($rid){
        header('location: ../index.php?page=orders&action=orders&id='.$ordid);
    }
}
function editRecord(){
	$orders = new orders();
    $data['id'   ] = $_POST['id'];
    $data['sname'] = $_POST['sname'];
    $data['phone'] = $_POST['phone'];
    $data['rdate'] = $_POST['rdate'];
    $data['rtime'] = $_POST['rtime'];
    $rid = $orders->updateRecord($data);
    if($rid){
        header('location: ../index.php?page=orders&action=orders&id='.$ordid);
    }
}

function save_orders_items(){
	$orders = new orders();
    $id = $_POST['ordid'];
    $rid = $orders->save_orders_items($id);
    if($rid){
        header('location: ../index.php?page=orders&action=orders&id='.$id);
    }
}
function edit_orders_transaction(){
	$orders = new orders();
   $name= ucwords($_POST['sname']);
    $phone= ucwords($_POST['phone']); 
    $rdate= $_POST['rdate']; 
    $rtime= $_POST['rtime']; 
    $rid = $orders->insert_record($name, $phone, $rdate,$rtime);
    if(is_numeric($rid)){
    header('location: ../index.php?page=orders&action=orders&id='.$rid);
    }
}
?>