document.addEventListener("DOMContentLoaded", function(event) {
	$('.show_popup').click(function() {
		var popup_id = $('#' + $(this).attr("rel"));
		$(popup_id).show();
		$('.overlay_popup').show();
	})

	$('.overlay_popup').click(function() {
		$('.overlay_popup, .popup').hide();
	})

	$('.closePP').click(function() {
		$('.overlay_popup, .popup').hide();
	})


	$('#okPP1').click(function(){
		$('.overlay_popup, .popup').hide();
		$('.messageRow').fadeOut(500, function() {
    		$(this).html('<p class="text-center bg-primary">Запрос на новый UID отправлен<p>').fadeIn(500);
		});
		 setTimeout(function() {
		 	$('.messageRow').fadeOut(500, function() {
		 		$(this).fadeOut(400).hide;
		 	});
     	}, 3000);
	})

	$('#okPP2').click(function(){
		$('.overlay_popup, .popup').hide();
		$('.messageRow').fadeOut(500, function() {
    		$(this).html('<p class="text-center bg-danger">UID заблокирован<p>').fadeIn(500);
		});
		 setTimeout(function() {
		 	$('.messageRow').fadeOut(500, function() {
		 		$(this).fadeOut(400).hide;
		 	});
     	}, 3000);
	})

	$('#okPP3').click(function(){
		$('.overlay_popup, .popup').hide();
		$('.messageRow').fadeOut(500, function() {
    		$(this).html('<p class="text-center bg-success">UID разблокирован<p>').fadeIn(500);
		});
		 setTimeout(function() {
		 	$('.messageRow').fadeOut(500, function() {
		 		$(this).fadeOut(400).hide;
		 	});
     	}, 3000);
	})

});