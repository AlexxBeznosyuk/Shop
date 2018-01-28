<?php 
class User{
	private $id, $login, $pass, $roleid, $discount, $total, $imagepath, $email;

	function __construct($login, $pass=0, $email, $imagepath, $id=0, $discount=0, $roleid=1, $total=0){
		$this->login=$login;
		$this->pass=md5($pass);
		$this->imagepath=$imagepath;
		$this->id=$id;
		$this->discount=$discount;
		$this->total=$total;
		$this->roleid=$roleid;
		$this->email = $email;
	}
	function intoDb(){
		try{
			$db = ManagerDb::getInstance();
			$ins='insert into Users(login,pass,imagepath,id,discount,total,roleid, email) 
				values(?,?,?,?,?,?,?,?)';
			$arr = array($this->login, $this->pass, $this->imagepath, $this->id, 
							   $this->discount, $this->total,$this->roleid, $this->email);
			$ps=ManagerDb::query($ins, $arr);
			return true;
		}
		catch(Exception $e) {
			if ($e->errorInfo[1] == 1062 ){
				echo "Это имя уже занято!<br>";
				echo "Спробуй ще!!";
			}
			return false;
		}
	}
	static function fromDb($id){
		try{
			$db = ManagerDb::getInstance();
			$sel = 'select * from Users where id= ?';
			$ps=ManagerDb::query($sel, array($id));
			$row = $ps->fetch(PDO::FETCH_LAZY);
			return $row;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	function updateDb($id){
		try{
			$db = ManagerDb::getInstance();
			$ins='UPDATE users 
						SET email="'.$this->email.'",
								imagepath = "'.$this->imagepath.'",
								roleid="'.$this->roleid.'",
								total="'.$this->total.'", 
								discount="'.$this->discount.'"
						WHERE id ='.$id; 
			$ps=ManagerDb::query($ins);
		}
		catch(PDOException $e) {
				echo $e->getMessage();
				return false;
		}
	}
	static function login($name, $pass){
		$db = ManagerDb::getInstance();
		$sel = 'select * from Users where login= ?';
		$ps=ManagerDb::query($sel, array($name));
		$row = $ps->fetch(PDO::FETCH_LAZY);
		if( $row['pass'] == md5($pass)){
			foreach ($row as $key => $value){
				$_SESSION[$key] = $value;
			}
			return $row;
		}
		else{
			echo "Wrong login or password";
			echo "Please enter valid data or push register";
			header ("Refresh: 3; url = index.php?log=1");
			exit;
		}
	}
}
?>