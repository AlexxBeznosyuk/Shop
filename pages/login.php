<?php
if(!isset($_POST['sublog'])){
	?>
	<form action="index.php?log=2" method="post">
		<label for="nm">Login:</label><input id="nm" type="text" name="login" required autofocus >
		<label for="ps">Password:</label><input id="ps" type="password" name="password" >
		<input type="submit" name="sublog" value="Login">
	</form>
	<?php
 }
else{
	session_unset();
	$user = User::login($_POST['login'], $_POST['password']);
	header ("Location: index.php?menu=1");
}
?>
