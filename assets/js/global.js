 $(document).ready(function() {

$.post("includes/calendar.php").done(function(data) {
	$('#render-calendar').html(data);
	initSystemFunctions();
});

});


function initSystemFunctions() {


	$(document).off("click");


    $('.modal').on('show', function () {
      $('body').css({overflow:'hidden'});
    });

    $('.modal').on('hide', function () {
      $('body').css({overflow:'auto'});

    });


		$(document).on("click", "#make-booking", function(){

			$('.modal-header h3').html('Book equipment')
			$('.modal-body').html('<p style="text-align:center;"><img src="assets/img/loading.gif"></p>');
			$('#event-modal').modal();

			$.post("includes/addBooking.php").done(function(data) {
			  $('.modal-body').html(data);
			});

		});


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