<?php
require('config.php');
$delid = intval($_POST['del_id']);

$done = 1;
$sql = "UPDATE request SET status = :done WHERE id =  :delid";
$stmt = $con->prepare($sql);
$stmt->bindParam(':delid', $delid, PDO::PARAM_INT);
$stmt->bindParam(':done', $done, PDO::PARAM_INT);   

if($stmt->execute()){
	echo "YES";
}
else{
	echo "NO";
}

?>