<?php
require('db.config.php');

if(!isset($_POST['dateToCheck'])){
	die('System error');
}

$mysqli->real_query("SELECT * FROM `bookings` WHERE (`start` = '".$_POST['dateToCheck']."' OR `end` = '".$_POST['dateToCheck']."') OR (`start` < '".$_POST['dateToCheck']."' AND `end` > '".$_POST['dateToCheck']."')");
$res = $mysqli->use_result();


if ($res) {
	while ($row = $res->fetch_assoc()) {
    	echo $row['hardwareId'].'//**//';
	}



}else{
	die('There has been a database error');
}





