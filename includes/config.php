<?php
	try{
		$db=new PDO("mysql:host=localhost;dbname=agenda;charset=utf8","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		date_default_timezone_set('Europe/Madrid');
	}catch(PDOException $e){
		print "Error: ".$e->getMessage()."<br>";
	}
?>
