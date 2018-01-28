<?php
if(!isset($_POST['subreg'])){
	?>
	<form action="index.php?log=1" method="post">
		<label for="nm">Login:</label><input id="nm" type="text" name="login" required autofocus >
		<label for="em">E-mail:</label><input id="em" type="email" name="email" >
		<label for="ps">Password:</label><input id="ps" type="password" name="password" >
		<input type="submit" name="subreg" value="Register">
	</form>
	<?php
 }
else{
	if(copy('images/anonym.jpg', 'images/avatar/'.$_POST['login'].'.anonym.jpg')){
			$image = 'images/avatar/'.$_POST['login'].'.anonym.jpg';
		}
	$user = new User($_POST['login'], $_POST['password'], $_POST['email'], $image);
	if ($user->intoDb()){
		echo "<p class = 'suclog'> The successful registration</p>
		<p class = 'suclog'> Welcome to our website</p>";
		User::login($_POST['login'], $_POST['password']);
		header ("Refresh: 3; url = index.php?menu=1");
		exit;
		}
	 else header ("Refresh: 3; url = index.php?log=1");
	}
?>
