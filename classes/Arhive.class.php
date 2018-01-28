<?php  
class Arhive{
	private $id, $customername, $itemname, $pricein, $pricesale, $datesale;

	function __construct( $customername, $itemname, $pricein, $pricesale, $datesale, $id=0){
		$this->customername = $customername;
		$this->itemname = $itemname;
		$this->pricein = $pricein;
		$this->pricesale = $pricesale;
		$this->datesale = $datesale;
		$this->id = $id;
	}
	function getArhProp($data){
			return $this->$data;
		}
	function intoDb(){
		try{
				$db = ManagerDb::getInstance();
				$ins = 'insert into Arhives( id, customername, itemname, pricein, pricesale, datesale) 
						values(?,?,?,?,?,?)';
				$arr = array($this->id, $this->customername, $this->itemname,$this ->pricein,
									    $this->pricesale, $this->datesale);
				$ps=ManagerDb::query($ins, $arr);
				return true;
			}
			catch(PDOException $e) {
				return $e->getMessage();
			}
	}




}
?>