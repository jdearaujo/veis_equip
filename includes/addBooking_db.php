<?php
require('db.config.php');

if(!isset($_POST['dateFrom']) || !isset($_POST['dateTo']) || !isset($_POST['reason']) || !isset($_POST['checkedEquipment']) || !isset($_POST['who'])){
	die('0');
}

if($_POST['dateTo'] == ''){
	$_POST['dateTo'] = $_POST['dateFrom'];
}

foreach ($_POST['checkedEquipment'] as $value) {
	echo $value.' -- <br>';
	$mysqli->query("INSERT INTO `bookings` (`hardwareId`, `start`,`end`,`who`,`where`) VALUES ('".$value."', '".$_POST['dateFrom']."', '".$_POST['dateTo']."', '".addslashes($_POST['who'])."', '".addslashes($_POST['reason'])."')");
}




$res = $mysqli->insert_id;
echo $mysqli->error;

if ($res>0) {

	echo '1';



}else{
	die('There has been a database error');
}