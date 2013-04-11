<?php
require('db.config.php');
sleep(1);

if(!isset($_POST) || !isset($_POST['eventid'])){
	die('Cannot find the event id');
}

if ($result = $mysqli->query("SELECT * FROM `bookings` WHERE `id`='".$_POST['eventid']."'")) {
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
	    	echo 'Event details in here';
		}
	}else{
		echo '<div class="alert alert-error"><strong>Oops!</strong> There has been a system error.</div>';
	}

}