<?php
	ob_start();
	session_start();
	function __autoload($className){
		include_once '../classes/'.$className.'.class.php';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css"  media="screen" href="../css/style.css">
	<link rel="stylesheet" href="../css/jquery-ui.css">
	<script src="../js/jquery-3.1.0.min.js"></script>
	<title>Document</title>
</head>
<body>
	<div class="container">
		<div class="header">
		
		</div>
	<div class="main iteminfo">
	<?php
		$item = $_GET['item'];
		$row = Item::fromDb($item);
		echo "<div class='infotop'>";
		echo "<img class='pull-left' src='../".$row['imagepath']." ' alt='info' title=".$row['itemname'].">";
		echo "<div class='rate'>".$row['rate']."</div>";
		echo "<div class='price'>".$row['pricesale']."$</div>";
		echo "<p class='pull-right'>".$row['info']."</p>";
		echo "</div>";
	?>
	</div>
</div>
</body>
</html>