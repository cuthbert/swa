<?php

/**
 * @abstract A shopping card
 * @author swa2
 */
class ShoppingCartMySQL
{
	protected $items = array();
	protected $db = null;
	protected $orderid = null;

	public function __construct($database, $user, $password) {
		try {
		$this->db = new PDO("mysql:host=https://wba-edu.cs.hs-rm.de/;dbname=".$database, $user, $password);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			print_r($e->getMessage());
		}
	}
	
	/**
	 * Adds element to cart
	 */
	public function add($name, $price, $quantity) {
		if ($quantity<=0) 
			return;
			
		if($this->orderid == null) {
			$stmt = $this->db->prepare("INSERT INTO shoppingcart (name, quantity, price) VALUES (:name, :quantity, :price)");
			
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':quantity', $quantity);
			$stmt->execute();
			$this->orderid = $stmt->lastInsertId();
		} else {
			$stmt = $this->db->prepare("INSERT INTO shoppingcart (orderid, name, quantity, price) VALUES (:orderid, :name, :quantity, :price)");
			$stmt->bindParam(':orderid', $this->orderid);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':quantity', $quantity);
			$stmt->execute();
		}
		
		if(!isset($this->items[$name])) {
			$this->items[$name] = array('price' => $price, 'quantity' => $quantity);	
		} else {
			$this->items[$name]['quantity']+=$quantity;
		}
	}
	
	/**
	 * removes quantity number ofd elements from cart
	 */
	public function delete($name, $quantity) {
		if(isset($this->items[$name])) {
			if($this->items[$name]['quantity']>$quantity) {
				$this->items[$name]['quantity']-=$quantity;
			} else {
				unset($this->items[$name]);
			}
		}
	}
	
	/**
	 * @return Total price
	 */
	public function subtotal() {
		$sum = 0;
		foreach($this->items as $item) {
			$sum += $item['quantity']*$item['price'];
		}
		return $sum;
	}
	
	/**
	 * Returns overview as HTML table 
	 */
	public function display() {
		$sum = $this->subtotal();
		echo "<table><tr><th>Name</th><th>Anzahl</th><th>Einzelpreis</th><th>Preis</th></tr>";
		foreach($this->items as $name => $item) {
			printf("<tr><td>%s</td><td>%d</td><td>%f</td><td>%f</td>", $name, $item['quantity'], $item['price'],$item['quantity']*$item['price']);
		}
		printf("<tr><th>Gesamtpreis:</th><td colspan='3'>%f</td></tr></table>", $sum);
	}
}

$sc = new ShoppingCartMySQL("swa2", "swa2", "lee7Eipo");
//print_r($sc);
$sc->add('Apfel', 0.95, 5);
//print_r($sc);
$sc->add('Birne', 0.8, 5);
/*print_r($sc);
$sc->delete('Apfel', 2);
print_r($sc);
$sc->delete('Birne', 7);
print_r($sc);
echo $sc->display();*/
