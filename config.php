<?php
/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';

$db = 'denggi';

$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'denggi',
	'host' => 'localhost'
);

try {
    $con = new PDO("mysql:host=$hostname;dbname=".$db, $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

$id = 0;
$stmt = $con->prepare("SELECT count(*) AS jumlah FROM request WHERE status = :status");
$stmt->bindParam(':status', $id, PDO::PARAM_INT);
$stmt->execute();
$obj = $stmt->fetch(PDO::FETCH_OBJ);
if($obj){
    $jumlah = $obj->jumlah;
}
    
?>