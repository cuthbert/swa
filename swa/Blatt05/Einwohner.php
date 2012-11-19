<?php
abstract class Einwohner {
	protected $einkommen;
	
	abstract public function zuVersteuerndesEinkommen();
	
	public function steuer() {
		$steuer = (int)($this->zuVersteuerndesEinkommen()*0.1);
		if ($steuer <= 0) {
			$steuer = 1;
		}
		return $steuer;
	}
	
	public function setEinkommen($pEinkommen) {
		$this->einkommen = $pEinkommen;
	}
	
	public function getEinkommen() {
		return $this->einkommen;
	}
}


class Koenig extends Einwohner {
	public function zuVersteuerndesEinkommen() {
		return 0;
	}
	
	public function steuer() {
		return 0;
	}
}

class Adel extends Einwohner {
	public function zuVersteuerndesEinkommen() {
		return $this->einkommen;
	}
	
	public function steuer() {
		$steuer = Einwohner::steuer();
		if ($steuer>20) {
			return $steuer; 
		}
		return 20;
	}
}

class Bauer extends Einwohner {
	public function zuVersteuerndesEinkommen() {
		return $this->einkommen;
	}
}

class Leibeigener extends Bauer {
	public function zuVersteuerndesEinkommen() {
		return $this->einkommen-10;
	}
}