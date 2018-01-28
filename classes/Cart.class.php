<?php 
	class Cart {
		private $id, $userid, $itemid, $datain, $orderid;
		public $price;

		function __construct( $userid, $itemid, $price, $orderid, $datain = 0, $id=0){
			$this ->userid = $userid;
			$this ->itemid = $itemid;
			$this ->price = $price;
			$this ->id = $id;
			$this ->orderid = $orderid;
			$this ->datain = $datain;
		}
		function getCartProp($data){
			return $this->$data;
		}
		function intoDb(){
			try{
				$db = ManagerDb::getInstance();
				$ins = 'insert into Carts(id, userid, itemid, datain, price, orderid) 
						values(?,?,?,?,?,?)';
				$arr = array($this->id, $this->userid, $this->itemid,$this ->datain,
									    $this->price, $this->orderid);
				$ps=ManagerDb::query($ins, $arr);
			}
			catch(PDOException $e) {
				return $e->getMessage();
			}
		}
		
		static function getCarts($orderid, $userid = 1){
			try{
				$db = ManagerDb::getInstance();
				$sql = 'select * from Carts where orderid= ?';
				$ps=ManagerDb::query($sql, array ($orderid));
				$cart = array();
				$error = 0;
				while($row = $ps->fetch(PDO::FETCH_LAZY)){
					if($row['userid'] == $userid){
						$cart[] = new Cart($row['userid'], $row['itemid'], $row['price'],$row['orderid'],
						 										$row['datain'],$row['id']);
					}
					else{
						return 1;	
					}
				}
				if(empty($cart)){
					return 2;
				}
				return $cart;
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		static function selMaxOrderid() {
				$db = ManagerDb::getInstance();
				$sel = 'select max(orderid) from Carts';
				$ps=ManagerDb::query($sel);
				$row = $ps->fetch(PDO::FETCH_LAZY);
				return $row;
		}

		function drawCart(){
			$item = Item::fromDb($this->itemid);
			echo '<tr>';
			echo '<td><img style="width:100px;max-height:100px;" src="'.$item["imagepath"].'"></td>';
			echo '<td>'.$item["itemname"].'</td>';
			echo '<td>'.$this->price.'</td>';
			echo '<td>'.$sum.'</td>';
			echo '<td><input type="submit" name = "delItm'.$this->id.'" value = "Удалить"></td>';
			echo '</tr>';
		}

	  static function deleteDb($id){
			$db = ManagerDb::getInstance();
			$sql = 'DELETE FROM Carts WHERE id=?';
			ManagerDb::query($sql, array($id));
		}
	}
?>