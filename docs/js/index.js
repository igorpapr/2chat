
var signswitch = {};

$( document ).ready(function() {


    if(localStorage.getItem('signswitch')!=null){
        signswitch=JSON.parse(localStorage.getItem('signswitch'));
        console.log(signswitch);
        signFunc(signswitch[0]);
    }
    else{
        signFunc(true);
    }


    console.log( "ready!" );
    $('#in').on("click", function() {
        signFunc(true);
        signswitch[0]=true;
        localStorage.setItem('signswitch',JSON.stringify(signswitch));
    });

    $('#up').on("click", function() {
        signFunc(false);
        signswitch[0]=false;
        localStorage.setItem('signswitch',JSON.stringify(signswitch));
    });

    $('#sendm').on("click", function() {
        sendAjaxForm("../chat/chat.php");
    });
});

function signFunc(b){
    if(b){
        $('#in').addClass('active');
        $('#up').removeClass('active');
        $('#signup').addClass('dnone');
        $('#signin').removeClass('dnone');
    }else{
        $('#up').addClass('active');
        $('#in').removeClass('active');
        $('#signin').addClass('dnone');
        $('#signup').removeClass('dnone');
    }
    
}

function submitForm(form){
    var url = form.attr("action");
    var formData = $(form).serializeArray();
    
    $.post(url, formData).done(function (data) {
        $('#txtar').val('');
    });
}


$("#ajax-form").submit(function() {
   submitForm($(this));
   return false;
});
	
