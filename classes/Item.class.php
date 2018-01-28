<?php 
	class Item	{
		private $id, $itemname, $catid, $pricein, $pricesale, $info, 
				$rate, $imagepath, $action, $count;

		function __construct( $itemname, $catid, $pricein, $pricesale, $info,
								$imagepath, $count = 1, $rate=0, $action=0, $id=0){
			$this->id = $id;
			$this->itemname = $itemname;
			$this->catid=$catid;
			$this->pricein = $pricein;
			$this->pricesale = $pricesale;
			$this->info = $info;
			$this->rate = $rate;
			$this->imagepath = $imagepath;
			$this->action = $action;
			$this->count = $count;
		}
		function getItemProp($data){
			return $this->$data;
		}
		function intoDb(){
			try{
				$db = ManagerDb::getInstance();
				$ins = 'insert into Items(id, itemname, catid, pricein, pricesale, info, count, 
										    imagepath, rate, action) 
						values(?,?,?,?,?,?,?,?,?,?)';
				$arr = array($this->id, $this->itemname, $this->catid, $this->pricein, $this->pricesale, $this->info,  $this->count, $this->imagepath, $this->rate, $this->action);
				$ps=ManagerDb::query($ins, $arr);
			}
			catch(PDOException $e) {
				return $e->getMessage();
			}
		}
		function updateDb(){
			try{
				$db = ManagerDb::getInstance();
				$ins = 'UPDATE Items SET  itemname=?, catid=?, pricein=?, pricesale=?, info=?, count=?, 
										    imagepath=?, rate=?, action=? WHERE id=?';
				$arr = array($this->itemname, $this->catid, $this->pricein, $this->pricesale, $this->info,  $this->count, $this->imagepath, $this->rate, $this->action, $this->id);
				$ps=ManagerDb::query($ins, $arr);
			}
			catch(PDOException $e) {
				return $e->getMessage();
			}
		}
		static function fromDb($id){
			try{
				$db = ManagerDb::getInstance();
				$sel = 'select * from Items where id= ?';
				$ps=ManagerDb::query($sel, array($id));
				$row = $ps->fetch(PDO::FETCH_LAZY);
				return $row;
			}
			catch(PDOException $e){
				 echo $e->getMessage();
				 return false;
			}
		}
		function Draw(){
			($this->count > 0) ? $count = $this->count : $count = "<span style='color:red'>Нет в наличии</span>";
				echo "<div class='col-sm-3' style='height:300px'>";
				echo "<h4 style='overflow:hidden;height:45px;font-size:14pt;'>".$this->itemname."</h4>";
				echo "<div style='overflow:hidden;height:45px'>Amount:".$count."</div>";
				echo "<div><img src='".$this->imagepath."' height='100px' style='max-width:150px'>".
				"<span class='pull-right iprice'>".$this->pricesale."</span></div>";
				echo "<div style='overflow:hidden;height:40px'>".$this->info."</div>";
				echo "<div><button name='cart".$this->id."' type='submit' >В корзину</button>".
				"<a class='btn btn-xs btn-success pull-right' href='pages/iteminfo.php?item=".$this->id."' 	target='_blank'>Подробней</a></div>";
				echo "</div>";
		}
		function DrawImage(){
			echo "<div class='col-sm-3' style='height:220px;border:1px solid black;'>";
			echo "<div><img src='".$this->imagepath."' height='200px' style='max-width:250px'>";
			echo "<a class='btn btn-xs btn-success pull-right' href='pages/iteminfo.php?item=".$this->id."' target='_blank'>Подробней</a></div>";
			echo "</div>";
		}

		static function GetItems($id=0){
			$db = ManagerDb::getInstance();
			if($id == 0){
				$ps = ManagerDb::query('select * from Items');
			}
			else{
				$sql = 'select * from Items where catid=?';
				$ps = ManagerDb::query($sql, array($id));
			}
			$items=array();
			while($row=$ps->fetch()){
				$items[]=new Item($row['itemname'], $row['catid'], $row['pricein'], $row['pricesale'],
								$row['info'], $row['imagepath'], $row['count'],
								$row['rate'], $row['action'], $row['id']);
			}
			return $items;
		}
	}
?>