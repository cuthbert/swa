<?php

/**
 * @abstract A shopping card
 * @author swa2
 */
class ShoppingCartMySQL
{
	protected $db = null;
	protected $orderid = null;

	public function __construct($database, $user, $password) {
		try {
		$this->db = new PDO("mysql:host=localhost;dbname=".$database, $user, $password);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			print_r($e->getMessage());
		}
	}

	public function setOrderId($orderid) {
		$this->orderid = $orderid;
	}
	
	/**
	 * Adds element to cart
	 */
	public function add($name, $price, $quantity) {
		if ($quantity<=0) 
			return;
		try {
			if($this->orderid == null) {
				$stmt = $this->db->prepare("INSERT INTO shoppingcart (name, quantity, price) VALUES (:name, :quantity, :price)");
			
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':price', $price);
				$stmt->bindParam(':quantity', $quantity);
				$stmt->execute();
				$this->orderid = $this->db->lastInsertId();
			} else {
				$checkStmt = $this->db->prepare('SELECT * FROM shoppingcart WHERE orderid=:orderid AND name=:name');
				$checkStmt->bindParam(':orderid', $this->orderid);
				$checkStmt->bindParam(':name', $name);
				$checkStmt->execute();
				$result = $checkStmt->fetchAll();
				if(Count($result)==0) {
					$stmt = $this->db->prepare("INSERT INTO shoppingcart (orderid, name, quantity, price) VALUES (:orderid, :name, :quantity, :price)");
					$stmt->bindParam(':orderid', $this->orderid);
					$stmt->bindParam(':name', $name);
					$stmt->bindParam(':price', $price);
					$stmt->bindParam(':quantity', $quantity);
					$stmt->execute();
				} else {
					$stmt = $this->db->prepare("UPDATE shoppingcart SET quantity=:quantity WHERE orderid=:orderid AND name=:name");
					$stmt->bindParam(':orderid', $this->orderid);
					$stmt->bindParam(':name', $name);
					$temp = $quantity+$result[0]['quantity'];
					$stmt->bindParam(':quantity', $temp);
					$stmt->execute();

				}
			}
		} catch(PDOException $e) {
			print_r($e->getMessage());
		}		
	}
	
	/**
	 * removes quantity number ofd elements from cart
	 */
	public function delete($name, $quantity) {
		try {
			if($this->orderid != null) {
				$checkStmt = $this->db->prepare('SELECT * FROM shoppingcart WHERE orderid=:orderid AND name=:name');
				$checkStmt->bindParam(':orderid', $this->orderid);
				$checkStmt->bindParam(':name', $name);
				$checkStmt->execute();
				$result = $checkStmt->fetchAll();
				if(Count($result)!=0) {
					if($quantity>=$result[0]['quantity']) {
						$stmt = $this->db->prepare("DELETE FROM shoppingcart WHERE orderid=:orderid AND name=:name");
						$stmt->bindParam(':orderid', $this->orderid);
						$stmt->bindParam(':name', $name);
						$stmt->execute();
					} else {
						$stmt = $this->db->prepare("UPDATE shoppingcart SET quantity=:quantity WHERE orderid=:orderid AND name=:name");
						$stmt->bindParam(':orderid', $this->orderid);
						$stmt->bindParam(':name', $name);
						$temp = $result[0]['quantity']-$quantity;
						$stmt->bindParam(':quantity', $temp);
						$stmt->execute();

					}
				}
			}
		} catch(PDOException $e) {
			print_r($e->getMessage());
		}
	}
	
	/**
	 * @return Total price
	 */
	public function subtotal() {
		$sum = 0;
		try {
			if($this->orderid != null) {
				$checkStmt = $this->db->prepare('SELECT sum(quantity*price) as sum FROM shoppingcart WHERE orderid=:orderid GROUP BY orderid');
				$checkStmt->bindParam(':orderid', $this->orderid);
				$checkStmt->execute();
				$result = $checkStmt->fetchAll();
				$sum = $result[0]['sum'];
			}
		} catch(PDOException $e) {
			print_r($e->getMessage());
		}
		return round($sum,2);
	}
	
	/**
	 * Returns overview as HTML table 
	 */
	public function display() {
		$sum = $this->subtotal();
		echo "<table><tr><th>Name</th><th>Anzahl</th><th>Einzelpreis</th><th>Preis</th></tr>";
		try {
			if($this->orderid != null) {
				$checkStmt = $this->db->prepare('SELECT name, quantity, price, quantity*price as sum FROM shoppingcart WHERE orderid=:orderid');
				$checkStmt->bindParam(':orderid', $this->orderid);
				$checkStmt->execute();
				$result = $checkStmt->fetchAll();
				foreach($result as $item) {
					printf("<tr><td>%s</td><td>%d</td><td>%f</td><td>%f</td>", $item['name'], $item['quantity'], $item['price'], $item['sum']);
				}

			}
		} catch(PDOException $e) {
			print_r($e->getMessage());
		}
		printf("<tr><th>Gesamtpreis:</th><td colspan='3'>%f</td></tr></table>", $sum);
	}
}

$sc = new ShoppingCartMySQL("swa2", "swa2", "lee7Eipo");
$sc->add('Apfel', 0.95, 5);
$sc->add('Birne', 0.8, 5);
$sc->add('Apfel', 0.95, 1);
//$sc->delete('Apfel', 2);
//$sc->delete('Birne', 7);
echo $sc->display();
