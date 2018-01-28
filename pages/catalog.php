<div class="row">
<form action="index.php?menu=1" method="post">
	<?php
		$db = ManagerDb::getInstance();
		$res=ManagerDb::query('select * from Categories');
		echo'<select name="catid">';
		while ($row = $res->fetch()){
			echo '<option value="'.$row["id"].'">';
			echo $row['category'];
			echo '</option>';
		}
		echo'</select>';
		echo '<input type="submit" name="btcatid" value="OK">';
		echo '<a href=index.php?menu=1&unset=1>Все категории</a>';

		if(isset($_POST['btcatid'])){
			$_SESSION['catid']=$_POST['catid'];
		}
		if(isset($_GET['unset'])){
			if($_GET['unset']==1 ) unset($_SESSION['catid']);	
		}
		foreach($_REQUEST as $k=>$v){
			if(substr($k, 0, 4) == 'cart'){
				$iid = substr($k, 4);
				if(isset($_SESSION['login'])){
					$uid = $_SESSION['id'];
				}
				else {
					$uid=1;
				}
				$item = Item::fromDb($iid);
				$price = $item['pricesale'];
				$date= @date('Y-m-d H:i:s');
				if(!isset($_SESSION['orderid'])){
					$order = ++Cart::selMaxOrderid()[0];
					$_SESSION['orderid'] = $order;
				}
				else {
					$order = $_SESSION['orderid'];	
				}
				$x = new Cart($uid, $iid, $price, $order, $date);
				$x->intoDb();
			}
		}
	?>
</form>
</div>
<div class="row">
	<form action="index.php?menu=1" method="post">
	<?php 
		$items = array();
		if(isset($_SESSION['catid'])){
			$items =Item::GetItems($_SESSION['catid']);
		}
		else{
		$items =Item::GetItems();
		}
		foreach($items as $i){
			$i->Draw();
		}
	?>
	</form>
</div>