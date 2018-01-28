<div class="row">
<form action="index.php?menu=5" method="post" enctype="multipart/form-data">
	<?php 
			echo "<table>";
			echo '<tr>';
			echo '<th> № </th>';
			echo '<th> ФОТО </th>';
			echo '<th> Название товара </th>';
			echo '<th> Категория </th>';
			echo '<th> Количество </th>';
			echo '<th> Акционная скидка </th>';
			echo '<th>Закупочная цена</th>';
			echo '<th> Цена продажи </th>';
			echo '<th> Информация о товаре</th>';
			echo '</tr>';
	  if($_SERVER['REQUEST_METHOD'] == "POST"){
			foreach($_REQUEST as $k=>$v){
				if(substr($k, 0, 3) == 'upd'){
					$id = substr($k, 3);
					$item = Item::fromDb($id);
					echo '<img style="width:200px;" src="'.$item['imagepath'].'">';
					echo '<input type="file" name="file" accept="image/*">';
					echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td><input type="text" name="itemname" value="'.$item['itemname'].'"></td>';
					echo '<td><select name="catid" id="catid" onchange=GetSub(this.value)>';
						$db = ManagerDb::getInstance();
		        $ps=$db->query('select * from Categories');
		        while ($row=$ps->fetch()) {
		        	$sel = "";
		        	if($row['id'] == $item['catid']){
		        		$sel = "selected";
		        	}
		          	echo "<option ".$sel." value='".$row['id']."'>".$row['category']."</option>";
		        }	
					echo '</select></td>';
					echo '<td><input type="number" name="count" value="'.$item['count'].'"></td>';
					echo '<td><input type="number" name="action" value="'.$item['action'].'"></td>';
					echo '<td><input type="text" name="pricein" value="'.$item['pricein'].'"></td>';
					echo '<td><input type="text" name="pricesale" value="'.$item['pricesale'].'"></td>';
					echo '<td><textarea name="info">'.$item['info'].'</textarea></td>';
					echo '<td><input type="submit" name="updItem" value = "OK"></td>';
					echo '<td><input type="submit" name = "resCat" value = "ОТМЕНА"></td>';
					echo '<input type="hidden" name = "iditem" value="'.$id.'">';
					echo '<input type="hidden" name = "impath" value="'.$item['imagepath'].'">';
					if(isset($_POST['updItem'])){
						if (is_uploaded_file($_FILES['file']['tmp_name'])) {
		  				$path='images/'.$_FILES['file']['name'];
		  				move_uploaded_file($_FILES['file']['tmp_name'], $path);
		  			}
		  			if (!$path){
		  				$path = $_POST['impath'];
		  			}
						$newUpdItem = new Item($_POST['itemname'],
										$_POST['catid'],
										$_POST['pricein'],
										$_POST['pricesale'],
										$_POST['info'],
										$path,
										$_POST['count'],
										0,
										$_POST['action'],
										$_POST['iditem']);
				  	$newUpdItem->updateDb();
						header ("Location: index.php?menu=5");
					}
				}
				else if(substr($k, 0, 3) == 'del'){
					$id = substr($k, 3);
					echo '<div><h3>ВНИМАНИЕ!! Товар будет удален!!!</h3>';
					echo '<input type="submit" name = "delCat" value = "OK">';
					echo '<input type="submit" name = "resCat" value = "ОТМЕНА"></div>';
					echo '<input type="hidden" name = "iditm" value="'.$id.'">';
					if(isset($_POST['delCat'])){
						$db = ManagerDb::getInstance();
						$res = ManagerDb::query('delete from Items where id='.$_POST['iditm']);
						header ("Location: index.php?menu=5");
					}
					if(isset($_POST['resCat'])){
						header ("Refresh: 3; url = index.php?menu=5");
					}
				}
			}
		}
		$db = ManagerDb::getInstance();
		$res=ManagerDb::query('select it.*, ca.category from Items it, Categories ca 
													 where it.catid = ca.id');
		$num = 1;

		while($row = $res->fetch()){
			echo '<tr>';
			echo '<td> '.$num.' </td>';
			echo '<td><img style="width:70px;" src="'.$row['imagepath'].'"></td>';
			echo '<td> '.$row['itemname'].' </td>';
			echo '<td> '.$row['category'].' </td>';
			echo '<td> '.$row['count'].' </td>';
			echo '<td> '.$row['action'].' </td>';
			echo '<td> '.$row['pricein'].' </td>';
			echo '<td> '.$row['pricesale'].' </td>';
			echo '<td style="display:block;width:300px;height:60px;overflow:auto;"> '.$row['info'].'</td>';
			echo '<td><button name="upd'.$row['id'].'" type="submit">Изменить</button></td>';
			echo '<td><button name="del'.$row['id'].'" type="submit">Удалить</button></td>';
			echo '</tr>';
			$num++;
		}
		echo "</table>";
	?>
</form>
</div>