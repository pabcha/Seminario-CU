$(function() {

	$('#radio-transfer').click(function (){
		$('#transfer').show();	
		$('#credit-card').hide()
	});

	$('#radio-credit-card').click(function (){
		$('#transfer').hide();
		$('#credit-card').show();	
	});
});