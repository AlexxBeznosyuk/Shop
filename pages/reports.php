<div class="row">
<form action="index.php?menu=6" method="post">
	<div>
		<label>Начало выборки: <input type="date" name="begin"></label>
		<label>Конец выборки:  <input type="date" name="end"></label>
		<input type="submit" name="selBuy" value="OK">
	</div>
<?php
	if(isset($_POST['selBuy'])){
		$begin = $_POST['begin'];
		$end = $_POST['end'];
		$db = ManagerDb::getInstance();
		$sql = 'SELECT * FROM Arhives 
						WHERE datesale > ? AND datesale < ?';
		$arr = array($begin, $end);
		$res=ManagerDb::query($sql, $arr);
		$num = 0;
		$pricein = 0;
		$pricesale = 0;
		echo '<table>';
		while($row = $res->fetch()){
			$num++;
			echo '<tr>';
			echo '<td>'.$num.'</td>';
			echo '<td>'.$row['customername'].'</td>';
			echo '<td>'.$row['itemname'].'</td>';
			echo '<td>'.$row['pricein'].'</td>';
			echo '<td>'.$row['pricesale'].'</td>';
			echo '<td>'.$row['datesale'].'</td>';
			echo '</tr>';
			$pricein += $row['pricein'];
			$pricesale += $row['pricesale'];
		}
		echo '<tr>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td>'.$pricein.'</td>';
			echo '<td>'.$pricesale.'</td>';
			$result = $pricesale - $pricein;
			echo '<td>Доход: '.$result.'</td>';
		echo '</tr>';
		echo '</table>';
	}
?>
	</form>
</div>