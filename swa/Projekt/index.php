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
				include('main.php');
			?>
		</div>
	</body>
</html>