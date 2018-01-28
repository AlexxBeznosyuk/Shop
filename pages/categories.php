<div class="row">
<form action="index.php?menu=4" method="post">
	<?php 
	  if($_SERVER['REQUEST_METHOD'] == "POST"){
			foreach($_REQUEST as $k=>$v){
				if(substr($k, 0, 3) == 'upd'){
					$id = substr($k, 3);
					$db = ManagerDb::getInstance();
					$cat = ManagerDb::query('select category from Categories where id=?', array($id));
					$cat = $cat->fetch(PDO::FETCH_NUM);
					echo '<input type="text" name="catUpd" value="'.$cat[0].'">';
					echo '<input type="submit" name="updCateg" value = "OK">';
					echo '<input type="hidden" name = "idcat" value="'.$id.'">';
					if(isset($_POST['updCateg'])){
						$idcat = $_POST['idcat'];
						$newname = $_POST['catUpd'];
						if(!$newname){
							echo "ВВЕДИ НОВОЕ НАЗВАНИЕ КАТЕГОРИИ!!!";
							header ("Refresh: 3; url = index.php?menu=4");
							exit;
						}
						$res = ManagerDb::query('UPDATE Categories SET category= ? 
																		WHERE id= ?', array($newname, $idcat));
						header ("Location: index.php?menu=4");
					}
				}
				else if(substr($k, 0, 3) == 'del'){
					$id = substr($k, 3);
					echo '<div><h3>ВНИМАНИЕ!! Категория будет удалена вместе с товарами!!!</h3>';
					echo '<input type="submit" name = "delCat" value = "OK">';
					echo '<input type="submit" name = "resCat" value = "ОТМЕНА"></div>';
					echo '<input type="hidden" name = "idcat" value="'.$id.'">';
					if(isset($_POST['delCat'])){
						$db = ManagerDb::getInstance();
						$res = ManagerDb::query('delete from Items where catid='.$_POST['idcat']);
						$res = ManagerDb::query('delete from Categories where id='.$_POST['idcat']);
						header ("Location: index.php?menu=4");
					}
					if(isset($_POST['resCat'])){
						header ("Refresh: 3; url = index.php?menu=4");
					}
				}
			}
		}
		$db = ManagerDb::getInstance();
		$res=ManagerDb::query('select * from Categories');
		$num = 1;
		echo "<table>";
		echo '<tr>';
		echo '<th></th>';
		echo '<th>Категория</th>';
		echo '<th>Количество наименований товара</th>';
		echo '<th>Общее кол-во товара </th>';
		echo '</tr>';
		while($row = $res->fetch()){
			$count =ManagerDb::query('select count(id), sum(count) from Items where catid=?', array($row['id']));
			$count =$count->fetch(PDO::FETCH_NUM);
			echo '<tr>';
			echo '<td> '.$num.' </td>';
			echo '<td> '.$row['category'].' </td>';
			echo '<td> '.$count[0].' </td>';
			echo '<td> '.$count[1].' </td>';
			echo '<td><button name="upd'.$row['id'].'" type="submit">Изменить</button></td>';
			echo '<td><button name="del'.$row['id'].'" type="submit">Удалить</button></td>';
			echo '</tr>';
			$num++;
		}
		echo "</table>";
	?>
</form>
</div>