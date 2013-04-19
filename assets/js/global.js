 $(document).ready(function() {

$.post("includes/calendar.php").done(function(data) {
	$('#render-calendar').html(data);
	initSystemFunctions();
});



$('.input-datepicker').datepicker({
	'format': 'yyyy-mm-dd'
});




$(".input-datepicker").on('changeDate', function() {

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





});


function initSystemFunctions() {


	$(document).off("click");


    // $('.modal').on('show', function () {
    //   $('body').css({overflow:'hidden'});
    // });

    // $('.modal').on('hide', function () {
    //   $('body').css({overflow:'auto'});

    // });


		// $(document).on("click", "#make-booking", function(){

		// 	$('.modal-header h3').html('Book equipment')
		// 	$('.modal-body').html('<p style="text-align:center;"><img src="assets/img/loading.gif"></p>');
		// 	$('#event-modal').modal();

		// 	$.post("includes/addBooking.php").done(function(data) {
		// 	  $('.modal-body').html(data);
		// 	});

		// });


		$(document).on("click", "#previous-month", function(){

			var date = $(this).data('date');


			$.post("includes/calendar.php", { date: date, which: 'prev' }).done(function(data) {
			  $('#render-calendar').html(data);
			  initSystemFunctions();
			});

		});


		$(document).on("click", "#next-month", function(){

			var date = $(this).data('date');

			$.post("includes/calendar.php", { date: date, which: 'next' }).done(function(data) {
			  $('#render-calendar').html(data);
			  initSystemFunctions();
			});

		});

    	$(".event").hover(
		  function () {
		    $(this).removeClass('label-info').addClass('label-warning');
		  },
		  function () {
		    $(this).removeClass('label-warning').addClass('label-info');
		  }
		);

		$(document).on("click", ".event", function(){

			var eventid = $(this).data('eventid');

			$('.modal-header h3').html('Booking details')
			$('.modal-body').html('<p style="text-align:center;"><img src="assets/img/loading.gif"></p>');
			$('#event-modal').modal();


			$.post("includes/event_info.php", { eventid: eventid }).done(function(data) {
			  $('.modal-body').html(data);
			});

		});
}