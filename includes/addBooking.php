<?php
require('db.config.php');

$mysqli->real_query("SELECT * FROM hardware ORDER BY name ASC");
$res = $mysqli->use_result();

$hardwareArray = array();

if ($res) {
	while ($row = $res->fetch_assoc()) {
    	$hardwareArray[$row['id']] = $row['name'];
	}
}else{
	die('There has been a database error');
}
?>


<form id="equipment-booking-form">
  <fieldset>

    <label>From:</label>
    <input type="date" name="from" id="from" placeholder="">
    <label>To:</label>
    <input type="date" name="to" id="to" placeholder="">

	<label>Reason:</label>
    <input class="input-xlarge" type="text" name="reason" id="reason" placeholder="Reason for booking">
    <span class="help-block">Select the equipment you require.</span>
    <?php

    $rowCounter = 0;
    foreach ($hardwareArray as $key => $value) {

    	echo '<label class="checkbox">';
    	echo '<input type="checkbox" name="hardware" id="hardware-'.$key.'" value="'.$key.'"> '.$value;
    	echo '</label>';

    }

    ?>
    <ul id="error-list"></ul>
    <button type="submit" id="submit-button" class="btn btn-primary">Confirm booking</button>
  </fieldset>
</form>


<script type="text/javascript">

$("input[type='date']").change(function() {

	$("label").removeClass("already-booked");
	$("input[type='checkbox']").attr("disabled", false);

	$(".booked").remove();


	var dateToCheck = $(this).val();


	$.post("includes/dateCheck.php", { dateToCheck: dateToCheck }).done(function(data) {

		if(data.length>0){

			data = data.split("//**//");

			for (var i = 0; i < data.length; i++) {

			    $("#hardware-" + data[i]).attr("checked", false).attr("disabled", true).parent('label').addClass("already-booked").append('<span class="booked"> - Already Booked</span>');
			}

		}




	});
});


$('#equipment-booking-form').submit(function(e) {
  e.preventDefault();

  $("#error-list").html('');

  var dateFrom = $("#from").val();
  var dateTo = $("#to").val();
  var reason = $("#reason").val();

  var checkedEquipment = new Array();

  	$("input:checkbox[name=hardware]:checked").each(function()
	{
    	checkedEquipment[$(this).val()] = $(this).val();
	});

  	var errorCount = 0;

  	if(dateFrom.length<1){
  		$("#error-list").append('<li style="color:red;">Please select a "from" date.</li>');

  		errorCount = errorCount+1;
  	}

  	if(reason.length<1){
  		$("#error-list").append('<li style="color:red;">Please enter a "reason" for your booking.</li>');
  		errorCount = errorCount+1;
  	}

  	if(checkedEquipment.length<1){
  		$("#error-list").append('<li style="color:red;">Please select an item of equipment for your booking.</li>');
  		errorCount = errorCount+1;
  	}

if(errorCount > 0){
	return false;
}

$.post("includes/addBooking_db.php", {dateFrom: dateFrom, dateTo: dateTo, reason: reason, checkedEquipment: checkedEquipment}).done(function(data) {

			$.post("includes/calendar.php").done(function(data) {
				$('#render-calendar').html(data);
				initSystemFunctions();
				$('#event-modal').modal('hide');
			});


});






});

</script>





<?php
$mysqli->close();