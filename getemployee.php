<?php
include 'config.php';

$sql = "select e.id, e.pName, e.lastName, e.pId, e.title, e.department, e.city, e.officePhone, e.cellPhone, " .
		"e.email, e.picture, m.pName managerpName, m.lastName managerLastName, count(r.id) reportCount " . 
		"from property e left join property r on r.pId = e.id left join property m on e.pId = m.id " .
		"where e.id=:id group by e.lastName order by e.lastName, e.pName";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("id", $_GET[id]);
	$stmt->execute();
	$property = $stmt->fetchObject();  
	$dbh = null;
	echo '{"item":'. json_encode($property) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>