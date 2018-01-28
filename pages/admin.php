<div class="container adm">
<div class="row">
	<script>$(function(){
				$('#tabs').tabs()});</script>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Категории товаров</a></li>
			<li><a href="#tabs-2">Товары</a></li>
			<li><a href="#tabs-3">Картинки</a></li>
		</ul>
		<div id="tabs-1">
			<form action='' method='post'>
			  			<label for="category">Введите категорию</label><br>
			    		<input type="text" name="category"><br><br>
			    		<input type='submit' name='addcat' value='Добавить категорию'>
						<input type='submit' name='delcat' value='Удалить'>
						<?php 
							$db = ManagerDb::getInstance();
							if (isset($_POST['addcat'])) {
								$category=$_POST['category'];
								$ps=ManagerDb::query('insert into categories (category) value(?)', array($category));
							}
						?>
						<br><br>
					</form>
		</div>
		<div id="tabs-2">
			<form action="" method='post' enctype="multipart/form-data">
				<?php include_once('lists.html');?>
				<br><br>
				<label for="itemname">Введите название товара</label><br>
			   	<input type="text" name="itemname" id="itemname"><br><br>
			   	<label for="count">Введите количество товара</label><br>
			   	<input type="nunber" name="count" id="count"><br><br>
			   	<label for="pricein">Цена закупки</label><br>
			   	<input type="number" name="pricein" id="pricein"><br><br>
			   	<label for="pricesale">Цена продажи</label><br>
			   	<input type="number" name="pricesale" id="pricesale"><br><br>
			   	<label for="info">Информация о товаре</label><br>
			   	<textarea name="info" id="info" cols="30" rows="10"></textarea>
			   	<br><br>
				<input type="file" name="file" multiple accept="image/*"><br> <!-- картинки любых форматов -->
			   	<input type='submit' name='additem' value='Добавить товар'>
				<input type='submit' name='delitem' value='Удалить'>
			</form>
			<?php 
		  	if (isset($_POST['additem'])) {
		  		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
		  			$path='images/'.$_FILES['file']['name'];
		  			move_uploaded_file($_FILES['file']['tmp_name'], $path);
		  		}
		  		$catid=$_POST['catid'];
		  		$pricein=$_POST['pricein'];
		  		$pricesale=$_POST['pricesale'];
		  		$info=trim($_POST['info']);
		  		$count= $_POST['count'];
		  		$itemname=trim($_POST['itemname']);
		  		$item=new Item($itemname, $catid, $pricein, $pricesale, $info, $path, $count);
		  		$item->intoDb();
		  	}
		  	?>
		</div>
		<div id="tabs-3">
			<?php 
				$db = ManagerDb::getInstance();
				$items =Item::GetItems();
				foreach( $items as $item){
					$item->DrawImage();
				}
			?>
		</div>
	</div>
</div>
</div>