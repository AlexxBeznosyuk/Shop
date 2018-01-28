<?php 
echo '<form action="index.php?menu=2" method="post">';
	if(!isset($_SESSION['id'])){
		$_SESSION['id'] = 1;
	}
	if(isset($_SESSION['orderid'])){
		echo "Номер вашего заказа: ". $_SESSION['orderid'];
	}
		echo '<label for="cartid">Поиск корзины: </label>';
		echo '<input type="text" pattern="^[ 0-9]+$" name="cartid" id="cartid" placeholder="Номер заказа...">';
		echo '<input type="submit" name="searchCart" value="OK">';
	if(isset($_POST['searchCart'])){
		$carts = Cart::getCarts($_POST['cartid'], $_SESSION['id']);
		if($carts == 2){
			echo 'Tакой корзины не существует!!!';
		}
		else if($carts == 1){
			echo "Для просмотра этой корзины войдите под своим именем!!!";
		}
		else{
			$_SESSION['orderid'] = $_POST['cartid'];
			header ("Location: index.php?menu=2");
		}
	}
	else{
		$carts = Cart::getCarts($_SESSION['orderid'], $_SESSION['id']);
		$total = 0;
		if(is_array($carts)){
			echo '<table>';
			foreach($carts as $cart){
				$total +=$cart->price;
				$cart->drawCart();
			}
			echo '</table>';
		}
		echo '<br>'.$total.'<br>';
		echo $_SESSION['discount'];
		echo '<button type="submit" name="buy">Оформить заказ</button>';
	}
	if(isset($_POST['buy'])){
		$carts = Cart::getCarts($_SESSION['orderid'], $_SESSION['id']);
		$total = 0;
		foreach($carts as $cart){
			$itemid = $cart->getCartProp(itemid);
			$item = Item::fromDb($itemid);
			$itemname = $item['itemname'];
			$pricein = $item['pricein'];
			$pricesale = $item['pricesale'] - $item['pricesale'] * $item['action'] / 100; 
			$pricesale = $pricesale - $item['pricesale'] * $_SESSION['discount'] / 100;
			$total +=$pricesale;
			$date= @date('Y-m-d H:i:s');
			(isset($_SESSION['login'])) ? $customername = $_SESSION['login'] : $customername = "User";
			$arh = new Arhive($customername, $itemname, $pricein, $pricesale, $date);
			$res = $arh->intoDb();
			if($res){
				$user  = User::fromDb($_SESSION['id']);
				$updUser = new User($customername, 0, $user['email'], $user['imagepath'], $user['id'],
														$user['discount'], $user['roleid'], ($user['total'] + $total));
				$updUser->updateDb($_SESSION['id']);

				$updItem = new Item($itemname, $item['catid'], $pricein, $item['pricesale'], $item['info'],
											$item['imagepath'], $item['count'] - 1, $item['rate'], $item['action'], $itemid);
				$updItem->updateDb($itemid);

				$idCart = $cart->getCartProp(id);
				Cart::deleteDb($idCart);
				unset($_SESSION['orderid']);
			}
		}
		echo '<div>Заказ сформирован успешно!!</div>';
		header ("Refresh: 3; url = index.php?menu=1");
	}
	foreach($_REQUEST as $k=>$v){
		if(substr($k, 0, 6) == 'delItm'){
			$id = substr($k, 6);
			$res = Cart::deleteDb($id);
			header ("Location: index.php?menu=2");
		}
	}
	// print_r($_SESSION);
echo '</form>';
 ?>