<?php
require('db.config.php');
sleep(1);

if(!isset($_POST) || !isset($_POST['eventid'])){
	die('Cannot find the event id');
}

if ($result = $mysqli->query("SELECT b.*, h.name FROM `bookings` b INNER JOIN `hardware` h ON b.hardwareid = h.id WHERE b.id ='".$_POST['eventid']."'")) {
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {


	    	echo '<h4>'.$row['name'].'</h4>';

	    	echo '<p>Booked by: <strong>'.$row['who'].'</strong></p>';

	    	echo '<p>'.$row['where'].'</p>';





		}
	}else{
		echo '<div class="alert alert-error"><strong>Oops!</strong> There has been a system error.</div>';
	}

}else{
	echo '<div class="alert alert-error"><strong>Oops!</strong> There has been a system error.</div>';
}