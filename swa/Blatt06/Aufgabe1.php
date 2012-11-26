<?php
	
	$pattern = "/\b((wo)|(wann)|(was))\b.*\?$/i";
	$subject = "Hallo wo bist du?";
	 
	if(preg_match($pattern, $subject)) {
		echo "drinne";
	}

?>