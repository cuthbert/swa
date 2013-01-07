<?php

class SWADatabase
{
	public $db = null;

	public function __construct() {
	try {
		$this->db = new PDO("mysql:host=localhost;dbname=swa2", "swa2", "lee7Eipo");
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			print_r($e->getMessage());
		}
	}
}

