<?php
/*
 * Created on 19.11.2012
 *
*/
$array = Array ("swa" => "Serverseitige Web Anwendungen",
				"DSEA" => "Datenstrukturen und effiziente Algorithem",
				"TGI" => "Theoretische Grundlagen der Informatik",
				"MfI" => "Mathematik für Informatiker");
				
				
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
 <head>
  <meta charset=UTF-8 />
  <title>Übung5 Aufgabe 3 </title>
</style>
 </head>
 <body>
     <?php foreach($array as $key => $value) {
     	echo "Die Vorlesung $value hat die Abkürzung $key<br/>\n";
     } ?>
 </body>
</html>
