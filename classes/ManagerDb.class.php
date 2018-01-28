<?php
class ManagerDB {
	private static $_instance = null;
	
	const DB_HOST = 'localhost';
	const DB_NAME = 'alexxShop';
	const DB_USER = 'root';
	const DB_PASS = '';

	private function __construct () {
		try{
			self::$_instance = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME,
	  	  	self::DB_USER,
	  	  	self::DB_PASS,
	  	  	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	 							PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
		}catch(PDOExeption $e){
			echo 'Выброшено исключение: '.$e->getMessage(). "\n";
		}
	}

	private function __clone () {}
	private function __wakeup () {}

	public static function getInstance(){
		if (self::$_instance != null) {
			return self::$_instance;
		}
		return new self;
	}
	public static function query($query, array $args = null){
    	if($args === null){
      	return self::$_instance->query($query);
      }
      $stmt = self::$_instance->prepare($query);
      $stmt->execute($args);
      return $stmt;
   }
}
// ManagerDb::getInstance();
// $rty = ManagerDb::query('select * from Items where catid=?', array(1));
// var_dump($rty);
// while($row=$rty->fetch()){
// 				echo $row['itemname'];
// 				echo '<br>';
// 			}





	/*class ManagerDb{
	private $host;
	private $user;
	private $pass;
	private $dbname;
	function __construct($host = 'localhost', $user = 'root', $pass = '',$dbname = 'alexxshop'){
		$this ->host=$host;
		$this ->user=$user;
		$this ->pass=$pass;
		$this ->dbname=$dbname;
	}
	function connect(){
		$dns = 'mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8';
		$options=array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
		return $pdo = new PDO($dns, $this->user, $this->pass, $options);
	}
	function Show(){
		echo "host: ".$this->host."; user: ".$this->user.
		"; pass: ".$this->pass."; dbname: ".$this->dbname."<br>";
	}
}
*/
?>