$(document).ready(function(){
	var lastRowTable1 = $('#turnTable1 tr:last');
	var lastRowTable2 = $('#turnTable2 tr:last');
	lastRowTable1.addClass('marked');
	lastRowTable2.addClass('marked');

	$('#turnTable1 tr').on('click', function(e) {
		$('#turnTable1 tr').removeClass('marked');
		$(this).addClass('marked');
	});

	$('#turnTable2 tr').on('click', function(e) {
		$('#turnTable2 tr').removeClass('marked');
		$(this).addClass('marked');
	});

	$('#turniket1').on('change', function(){
		if(this.checked) {
			if(!$('#turniket2').is(':checked')){
				$('#turn1').removeClass('col-md-6');
			} else {
				$('#turn1').addClass('col-md-6');
				$('#turn2').addClass('col-md-6');
			}
			$('#turn1').show();
		} else {
			$('#turn2').removeClass('col-md-6');
			$('#turn1').hide();
		}
	})

	$('#turniket2').on('change', function(){
		if(this.checked) {
			if(!$('#turniket1').is(':checked')){
				$('#turn2').removeClass('col-md-6');
			} else {
				$('#turn1').addClass('col-md-6');
				$('#turn2').addClass('col-md-6');
			}
			$('#turn2').show();
		} else {
			$('#turn1').removeClass('col-md-6');
			$('#turn2').hide();
		}
	})

});