<div id="user_navigation">
<?php
if(!empty($_SESSION['email'])) {
	echo "Hallo ".$_SESSION['username'];
	?>
	<a href="loginlogout.php?action=logout">Logout</a>
	<?php
	
} else {
?>
<form action="loginlogout.php" method="POST">
	<input type="email" name="email" placeholder="yourname@mail.com" /> <input type="password" name="password" placeholder="12345" /> <input type="submit" name="submit" value="Einloggen" />
</form> <a href="index.php?action=registry">Registrieren</a>
<?php
}

if (!empty($_GET['error']) && $_GET['error']=='invalidLogin') {
	echo "Fehlerhafter Benutzername und/oder Passwort";
}
?>


<!--<h1>Usernavigation und Login</h1>-->

</div>
