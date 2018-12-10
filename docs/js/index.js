
$( document ).ready(function() {
    console.log( "ready!" );
    $('#in').on("click", function() {
    	$('#in').addClass('active');
        $('#up').removeClass('active');
    });
    $('#up').on("click", function() {
    	$('#up').addClass('active');
        $('#in').removeClass('active');
    });
});
	
