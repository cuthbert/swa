<?php
include "Einwohner.php";

$personen = array();

$koenig = new Koenig();
$koenig->setEinkommen(20000000);
$personen['koenig'] = $koenig;

$adeliger = new Adel();
$adeliger->setEinkommen(13005);
$personen['adeliger'] = $adeliger;

$armerAdeliger = new Adel();
$armerAdeliger->setEinkommen(15);
$personen['armer Adeliger'] = $armerAdeliger;

$bauer = new Bauer();
$bauer->setEinkommen(500);
$personen['bauer'] = $bauer;

$leibeigener = new Leibeigener();
$leibeigener->setEinkommen(5);
$personen['leibeigener'] = $leibeigener;

$reicherLeibeigener = new Leibeigener();
$reicherLeibeigener->setEinkommen(25);
$personen['reicher Leibeigener'] = $reicherLeibeigener;

foreach($personen as $key => $value) {
	echo $key." verdient ".$value->getEinkommen()." zahlt ".$value->steuer()."<br>";	
	//echo "$key zahlt $value->steuer()<br>";
}

