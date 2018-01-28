<?php 
	ob_start();
	session_start();
	function __autoload($className){
		include_once 'classes/'.$className.'.class.php';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css"  media="screen" href="css/style.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-3.1.0.min.js"></script>
	<title>Document</title>
</head>
<body>
	<div class="container">
		<div class="header">
		<?php
		if(!isset($_SESSION['login'])){
			echo '<a href="index.php?log=1">Регистрация</a>';
			echo '<a href="index.php?log=2">Логин</a>';	
		}
		else {
			echo "Privet ". $_SESSION['login'];
			echo '<a href="index.php?log=3">Выйти</a>';
			echo '<a href="index.php?menu=10">Личный кабинет</a>';
		}	
		if(isset($_GET['log'])) {
			switch ($_GET['log']){
				case 1: include_once("pages/register.php");  break;
				case 2: include_once("pages/login.php");  break;	
				case 3: { 
					session_unset();
					header ('Location: index.php'); break;
				}
			}
		}
		?>
		</div>
		<div class="main">
			<?php 
				include_once("pages/menu.php");
				// if(isset($_GET['menu'])) {
					switch ($_GET['menu']) {
						case 1: include_once("pages/catalog.php");  break;
						case 2: include_once("pages/cart.php");  break;	
						case 3: include_once("pages/comments.php");  break;	
						case 4: include_once("pages/categories.php"); break;
						case 5: include_once("pages/items.php"); break;
						case 6: include_once("pages/reports.php"); break;
						case 7: include_once("pages/users.php"); break;
						case 8: include_once("pages/admin.php"); break;
						case 10: include_once("pages/personal.php"); break;
						default: include_once("pages/catalog.php");
					}
			?>
		</div>
	</div>
<script src="js/jquery-ui.js"></script>
</body>
</html>