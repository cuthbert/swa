<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Formular</title>
	</head>
	<style type="text/css">
		th {text-align: left}
	</style>
	<body>

<?php
	$gender = $_POST['gender'];
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$street = $_POST['street'];
	$number = $_POST['number'];
	$zipcode = $_POST['zipcode'];
	$town = $_POST['town'];
	$comment = $_POST['comment'];
	$action = $_POST['submit'];
	
	
	if(!empty($action) && $action == "Absenden") {
	?>
	<table>
		<tr>
			<th>Name:</th>
			<td><?php printf("%s %s %s", $gender=="male"?"Herr":"Frau", $firstName, $lastName); ?></td>
		</tr>
		<tr>
			<th>Straße:</th>
			<td><?php printf("%s %s", $street, $number); ?></td>
		</tr>
		<tr>
			<th>Stadt:</th>
			<td><?php printf("%s %s", $zipcode, $town); ?></td>
		</tr>
		<tr>
			<th>Kommentar:</th>
			<td><?php echo $comment; ?></td>
		</tr>
	</table>

	
	<?php	
	} else {
		echo "Fehler!";
	}
?>

	</body>
</html>

