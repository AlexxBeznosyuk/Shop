<?php 
	$p_id = $_SESSION['id'];
	$p_user = User::fromDb($p_id);
	echo '<form class="personal" action="index.php?menu=10" method = "post"  enctype="multipart/form-data"> ';
	echo '<img class="photo" src="'.$p_user["imagepath"].' "><br>';
	echo '<h3>'.$p_user["login"] .'</h3><br>  ';
	echo '<label>My e-mail: </label><input type="text" name = "p_email" value=" '.$p_user["email"].' " ><br>';
	echo '<label>My discount: </label><input type="text" readonly value=" '.$p_user["discount"].'% "><br>  ';
	echo '<label>My total: </label><input type="text" readonly value=" '.$p_user["total"].'$ "><br>  ';
	echo '<label>Change avatar: </label><input type = "file" name="p_file"><br>';
	echo '<label for="ps">Password:</label><input id="ps" type="password" name="password" required ><br>';
	echo '<input type="submit" name="p_sub" value="Change">';
	echo '<input type="reset" value="Reset"> ';
	echo '</form>';
	if(isset($_POST['p_sub'])){
		$p_email = $_POST['p_email'];
	if ( is_uploaded_file($_FILES['p_file']['tmp_name']))
		$logimg = $_SESSION['login'].".";
		$p_avatar = "images/avatar/".$logimg.$_FILES['p_file']['name'];
		$p_del = $_SESSION["imagepath"];
		unlink($p_del);
		move_uploaded_file($_FILES['p_file']['tmp_name'], 
			$p_avatar);
		$user = new User($_SESSION["login"], $_SESSION["pass"], $p_email, $p_avatar);
		$user ->updateDb($p_id);
		$user = User::login($_SESSION['login'], $_POST['password']);
		header("Location: index.php?menu=10");
	}
?>