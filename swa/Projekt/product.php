<?php 
if (!empty($_GET['action']) && !empty($_GET['id']) && $_GET['action'] == 'product') {
	include "SWADatabase.php";
	$db = new SWADatabase();
	$productId = $_GET['id'];	

	$stmt =	$db->db->prepare('SELECT name, price FROM products WHERE productid=:productid');
	$stmt->bindParam(':productid', $productId);
	$stmt->execute();
	$result = $stmt->fetchAll();
	if (count($result)==1) {
?>
	<div>
		<a href="index.php?action=product&id=<?php echo $productId; ?>" class="product"><?php echo $result[0]['name']; ?></a><br />
		<img src="http://placekitten.com/150/150" /><br />
		Preis: <span class="price"><?php echo $result[0]['price']; ?>€</span>
	</div>
<?php
	}
}
?>
	

