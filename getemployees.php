<?php
include 'config.php';

$sql = "select e.id, e.pName, e.lastName, e.title, e.picture, count(r.id) reportCount " . 
		"from property e left join property r on r.pId = e.id " .
		"group by e.id order by e.lastName, e.pName";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->query($sql);  
	$propertys = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;
	echo '{"items":'. json_encode($propertys) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>