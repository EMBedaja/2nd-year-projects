<?php
class Orders{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='db_wbapp';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function insert_record($sname,$phone,$rdate,$rtime){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d h:i:s');
	
		$data = [
			[$sname,$phone,$rdate,$rtime,$NOW,$NOW,'1'],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_orders(ord_customer, ord_phone_num,ord_pickup_date,ord_pickup_time, ord_date_added, ord_time_added, ord_status) VALUES (?,?,?,?,?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$id= $this->conn->lastInsertId();
			$this->conn->commit();
			
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
	
		return $id;
	
		}

	public function list_product_type(){
		$sql="SELECT * FROM tbl_orders_type";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}
	public function list_orders(){
		$sql="SELECT * FROM tbl_orders";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}

	function get_orders_customer($id){
		$sql="SELECT ord_customer FROM tbl_orders WHERE ord_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$ord_customer = $q->fetchColumn();
		return $ord_customer;
	}
	function getOrder($id){
		$sql="SELECT * FROM tbl_orders WHERE ord_id = ".$id." LIMIT 1";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}
	
	function updateRecord($data){
		$sql="UPDATE tbl_orders 
		      SET
			  ord_customer=\"".$data['sname']."\",
			  ord_phone_num=\"".$data['phone']."\" ,
			  ord_pickup_date=\"".$data['rdate']."\" ,
			  ord_pickup_time=\"".$data['rtime']."\" ,
			  WHERE ord_id = ".$data['id'];	

		//var_dump($sql);
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$ord_date_added = $q->fetchColumn();
		return $ord_date_added;
	}
	function get_orders_date($id){
		$sql="SELECT ord_date_added FROM tbl_orders WHERE ord_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$ord_date_added = $q->fetchColumn();
		return $ord_date_added;
	}
	function get_pickup_date($id){
		$sql="SELECT ord_pickup_date FROM tbl_orders WHERE ord_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$ord_pickup_date = $q->fetchColumn();
		return $ord_pickup_date;
	}
	function get_pickup_time($id){
		$sql="SELECT ord_pickup_time FROM tbl_orders WHERE ord_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$ord_pickup_time = $q->fetchColumn();
		return $ord_pickup_time;
	}
	function get_orders_save($id){
		$sql="SELECT ord_saved FROM tbl_orders WHERE ord_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$ord_saved = $q->fetchColumn();
		return $ord_saved;
	}

	public function list_orders_items($id){
		$sql="SELECT * FROM tbl_orders_items WHERE ord_id=$id";
		//var_dump($sql);
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}

	public function new_orders_item($ordid,$prodid,$qty){
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
		$data = [
			[$ordid,$prodid,$qty],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_orders_items(ord_id, prod_id, ord_qty) VALUES (?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			//$id= $this->conn->lastInsertId();
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
		return true;
	}

	public function save_orders_items($id){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
		$status = 1;
		$sql = "UPDATE tbl_orders SET ord_saved=:ord_saved WHERE ord_id=$id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':ord_saved'=>$status));
		return true;
	}


	public function save_to_inventory($id){
		$sql="SELECT * FROM tbl_orders_items WHERE ord_id=$id";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		$stmt = $this->conn->prepare("INSERT INTO tbl_product_inv(ord_id, prod_id, prod_qty) VALUES (?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row){
				extract($row);
				$stmt->execute(array($ord_id,$prod_id,$ord_qty));
			}
			//$id= $this->conn->lastInsertId();
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
		return true;
	}
	public function list_order_search($keyword){
		
		//$keyword = "%".$keyword."%";

		$q = $this->conn->prepare('SELECT * FROM `tbl_orders` WHERE `ord_customer` LIKE ?');
		$q->bindValue(1, "%$keyword%", PDO::PARAM_STR);
		$q->execute();

		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]= $r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}
}