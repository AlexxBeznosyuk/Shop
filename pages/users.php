<div class="row">
<form action="index.php?menu=7" method="post">
<?php 
	$num = 1;
	echo "<table>";
	echo '<tr>';
	echo '<th></th>';
	echo '<th></th>';
	echo '<th>Имя пользователя</th>';
	echo '<th>Эл. почта</th>';
	echo '<th>Сумма товаров</th>';
	echo '<th>Дисконт</th>';
	echo '<th>Роль</th>';
	echo '</tr>';
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		foreach($_REQUEST as $k=>$v){
			if(substr($k, 0, 3) == 'upd'){
				$id = substr($k, 3);
				$user = User::fromDb($id);
				echo '<img style="width:200px;" src="'.$user['imagepath'].'"><br>';
				echo '<label><input type="checkbox" name="resetImg">Сбросить изображение</label>';
				echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td><input readonly type="text" name="login" value="'.$user['login'].'"></td>';
				echo '<td><input readonly type="text" name="email" value="'.$user['email'].'"></td>';
				echo '<td><input readonly type="text" name="total" value="'.$user['total'].'"></td>';
				echo '<td><input type="number" name="discount" value="'.$user['discount'].'"></td>';
				echo '<td><select name="roleid">';
					$db = ManagerDb::getInstance();
		       $ps=$db->query('select * from Roles');
		       while ($role=$ps->fetch()) {
		       	$sel = "";
		       	if($role['id'] == $user['roleid']){
		       		$sel = "selected";
		       	}
		         	echo "<option ".$sel." value='".$role['id']."'>".$role['role']."</option>";
		       }	
				echo '</select></td>';
				echo '<td><input type="submit" name="updUser" value = "OK"></td>';
				echo '<td><input type="submit" name = "reset" value = "ОТМЕНА"></td>';
				echo '<input type="hidden" name = "id" value="'.$user['id'].'">';
				echo '<input type="hidden" name = "imagepath" value="'.$user['imagepath'].'">';
				if(isset($_POST['updUser'])){
					$image = $_POST['imagepath'];
					if(isset($_POST['resetImg'])){
						if(copy('images/anonym.jpg', 'images/avatar/'.$_POST['login'].'.anonym.jpg')){
							$image = 'images/avatar/'.$_POST['login'].'.anonym.jpg';
						}
					}
					$updUser = new User($_POST['login'], 0 , $_POST['email'], $image, $_POST['id'],
															$_POST['discount'], $_POST['roleid']);
					$updUser->updateDb($_POST['id']);
					header ("Location: index.php?menu=7");
				}		
			}
			else if(substr($k, 0, 3) == 'del'){
				$id = substr($k, 3);
				echo '<div><h3>ВНИМАНИЕ!! Пользователь будет удален!!!</h3>';
				echo '<input type="submit" name = "delUser" value = "OK">';
				echo '<input type="submit" name = "reset" value = "ОТМЕНА"></div>';
				echo '<input type="hidden" name = "iduser" value="'.$id.'">';
				if(isset($_POST['delUser'])){
					$db = ManagerDb::getInstance();
					$res = ManagerDb::query('delete from Users where id='.$_POST['iduser']);
					header ("Location: index.php?menu=7");
				}
				if(isset($_POST['resCat'])){
					header ("Refresh: 3; url = index.php?menu=7");
				}
			}
		}
	}
	$db = ManagerDb::getInstance();
	$res=ManagerDb::query('select * from Users');
	while($row = $res->fetch()){
		echo '<tr>';
		echo '<td> '.$num.' </td>';
		echo '<td><img style="width:80px;" src="'.$row['imagepath'].'"></td>';
		echo '<td> '.$row['login'].'</td>';
		echo '<td> '.$row['email'].' </td>';
		echo '<td> '.$row['total'].' </td>';
		echo '<td> '.$row['discount'].'</td>';
		$role = "";
		switch($row['roleid']){
			case 1: $role="User";break;
			case 2: $role="Admin";break;
			case 3: $role="Boss";break;
		}
		echo '<td> '.$role.'</td>';
		echo '<td><button name="upd'.$row['id'].'" type="submit">Изменить</button></td>';
		echo '<td><button name="del'.$row['id'].'" type="submit">Удалить</button></td>';
		echo '</tr>';
		$num++;
	}
	echo "</table>";
?>
</form>
</div>