<?php
require('db.config.php');

if(!isset($_POST['dateFrom']) || !isset($_POST['dateTo'])){
	die('System error');
}


if($_POST['dateFrom'] == ''){
	$_POST['dateFrom'] = $_POST['dateTo'];
}

if($_POST['dateTo'] == ''){
	$_POST['dateTo'] = $_POST['dateFrom'];
}


$mysqli->real_query("SELECT * FROM `bookings` WHERE (`start` = '".$_POST['dateFrom']."' OR `end` = '".$_POST['dateTo']."') OR (`start` >= '".$_POST['dateFrom']."' AND `end` <= '".$_POST['dateTo']."')");
$res = $mysqli->use_result();


if ($res) {
	while ($row = $res->fetch_assoc()) {
    	echo $row['hardwareId'].'//**//';
	}



}else{
	die('There has been a database error');
}





