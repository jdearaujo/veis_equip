 $(document).ready(function() {

    $('.modal').on('show', function () {
      $('body').css({overflow:'hidden'});
    });

    $('.modal').on('hide', function () {
      $('body').css({overflow:'auto'});

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

			$('.modal-body').html('<p style="text-align:center;"><img src="assets/img/loading.gif"></p>');
			$('#event-modal').modal();


			$.post("includes/event_info.php", { eventid: eventid })
			.done(function(data) {
			  $('.modal-body').html(data);
			});

		});




});