<?php
session_start();

$action = !empty($_GET['action']) ? $_GET['action'] : '';

if(!empty($_SESSION['email'])) {
	$sessionValue = !empty($_COOKIE['sessionValue'])?$_COOKIE['sessionValue']:'';
	if ($sessionValue != $_SESSION['sessionValue']) {
		session_destroy();
		echo "EPIC FAIL, N00b!";
		exit();
	}
	$_SESSION['sessionValue'] = md5($_SESSION['sessionValue']);
	setcookie('sessionValue', $_SESSION['sessionValue']);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>SuperWarenAusverkauf-Shop</title>
		<link rel="stylesheet" href="swashop.css" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body>
		<div id="container">
			<div id="title_container">
			<?php 
				include('logo.php');
				include('usernavigation.php');
				include('searchbar.php');
				?>
			</div>
			<?php 
				include('info.php');
			?>
			<div id="main_container">
			<?php
				switch($action) {
					case 'registry':
						include('registry.php');
						break;
					case 'product':
						include('product.php');
						break;
					default:
						include('main.php');
				}				
			?>
			</div>
		</div>
	</body>
</html>
