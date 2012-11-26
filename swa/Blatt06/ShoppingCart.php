<?php

/**
 * @abstract A shopping card
 * @author swa2
 */
class ShoppingCard
{
	protected $items = array();
	
	/**
	 * Adds element to cart
	 */
	public function add($name, $price, $quantity) {
		if ($quantity<=0) 
			return;
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

$sc = new ShoppingCard();
print_r($sc);
$sc->add('Apfel', 0.95, 5);
print_r($sc);
$sc->add('Birne', 0.8, 5);
print_r($sc);
$sc->delete('Apfel', 2);
print_r($sc);
$sc->delete('Birne', 7);
print_r($sc);
echo $sc->display();
