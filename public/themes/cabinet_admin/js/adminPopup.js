document.addEventListener("DOMContentLoaded", function(event) {
	$('.show_popup').click(function() {
		var popup_id = $('#' + $(this).attr("rel"));
		$(popup_id).show();
		$('.overlay_popup').show();
	})

	$('tr').click(function(){
		var fio =  $(this).find(".fio").html();
		$('#fioPlaceDelPar').text(fio);

		// $('#fioPlaceEditPar').val(fio);
		$('#fioPlaceShowChildPar').text(fio);
		$('#fioPlaceEditPar').attr("placeholder", fio);
	})

	$('.overlay_popup').click(function() {
		$('.overlay_popup, .popup').hide();
	})

	$('.closePP').click(function() {
		$('.overlay_popup, .popup').hide();
	})


	$('#displayParent').click(function(){
		$('.content').hide();
		$('.content-parent').show();
	})

	$('#displayChild').click(function(){
		$('.content').hide();
		$('.content-child').show();
	})
});