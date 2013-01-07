<?php

$validateError = !empty($_GET['error'])?$_GET['error']:'';
$name = !empty($_GET['name'])?$_GET['name']:'';
$email = !empty($_GET['mail'])?$_GET['mail']:'';

if (!empty($_POST['submit']) && $_POST['submit'] == 'Anmelden') {
	session_start();
	include "SWADatabase.php";

	if(!empty($_SESSION['email'])) {
		echo "Depp.";
		exit;
	}

	$db = new SWADatabase();

	$email = $_POST['email'];
	$name = $_POST['name'];

	if (!preg_match('/^[A-Za-z][A-Za-z0-9\.-_]*@[A-Za-z0-9\.-_]*\.[A-Za-z]*$/', $email)) {
		$validateError='mail';
	}
	if (empty($name)) {
		$validateError='name';
	}
	if (!preg_match('/\d/', $_POST['password']) && !preg_match('/[A-Z]/', $_POST['password']) && !preg_match('/[%&$\/\\#+*-_()="!§.,:;]/', $_POST['password'])) {
		$validateError='passwordCharacters';
	}
	if (strlen($_POST['password'])<6) {
		$validateError='passwordLength';
	}

	if (empty($validateError)) {
		$password = crypt($_POST['password'], '$1$APfelbaum');

		$stmt =	$db->db->prepare('INSERT INTO user (email, name, password) VALUES (:email, :username, :password)');
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':username', $name);	
		$stmt->execute();
		if ($stmt->rowCount()==1) {
			$_SESSION['username'] = $name;
			$_SESSION['email'] = $email;
		}

		header("location:index.php");
		exit;
	} else {
		header("location:index.php?action=registry&error=".$validateError."&name=".$name."&mail=".$email);
		exit;
	}
} 
?>
<form action="registry.php" method="POST">
	eMail: <input type="email" name="email" value="<?php echo !empty($email)?$email:'' ?>" /><?php echo ($validateError=='mail'?'*':'') ?><br />
	Name: <input type="text" name="name" value="<?php echo !empty($name)?$name:'' ?>"/><?php echo ($validateError=='name'?'*':'') ?><br />
	Password: <input type="password" name="password" /> <?php echo ($validateError=='passwordCharacters' || $validateError=='passwordLength'?'*':'') ?><br />
	<input type="submit" name="submit" value="Anmelden" /> <br />
</form>


