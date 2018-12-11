
$( document ).ready(function() {
    console.log( "ready!" );
    $('#in').on("click", function() {
        $('#in').addClass('active');
        $('#up').removeClass('active');
        $('#signup').addClass('dnone');
        $('#signin').removeClass('dnone');
    });

    $('#up').on("click", function() {
        $('#up').addClass('active');
        $('#in').removeClass('active');
        $('#signin').addClass('dnone');
        $('#signup').removeClass('dnone');
    });
});
	
