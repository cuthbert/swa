<?php
session_start();
$errorMessage = '';
if (!empty($_POST['submit']) && $_POST['submit'] == 'Einloggen') {
	include "SWADatabase.php";
	$db = new SWADatabase();
	$email = $_POST['email'];
	$password = crypt($_POST['password'], '$1$APfelbaum');

	$stmt =	$db->db->prepare('SELECT name FROM user WHERE email=:email AND password=:password');
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', $password);
	$stmt->execute();
	$result = $stmt->fetchAll();
	if (count($result)==1) {
		$_SESSION['username'] = $result[0]['name'];
		$_SESSION['email'] = $email;
	} else {
		$errorMessage = 'invalidLogin';
	}

	$time = md5(time());
	setcookie('sessionValue', $time);
	$_SESSION['sessionValue'] = $time;

	unlink($_POST['email']);
	unlink($_POST['password']);
} else if(!empty($_GET['action']) && $_GET['action']=='logout') {
	session_destroy();
}

$params = '';
if(!empty($errorMessage)) {
	$params = "?error=".$errorMessage;
}

header("location:index.php".$params);
