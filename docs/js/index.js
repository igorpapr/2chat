
var signswitch = {};
var msgswitch = {};


$( document ).ready(function() {


    if(localStorage.getItem('signswitch')!=null){
        signswitch=JSON.parse(localStorage.getItem('signswitch'));
        console.log(signswitch);
        signFunc(signswitch[0]);
    }
    else{
        signFunc(true);
    }

    if(localStorage.getItem('msgswitch')!=null){
        msgswitch=JSON.parse(localStorage.getItem('msgswitch'));
        console.log(msgswitch[0]);
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
        $("#m1").scrollTop($("#m1").scrollHeight);
    });

    $('#gomsg').on("click", function() {
        msgswitch[0]=true;
        localStorage.setItem('msgswitch',JSON.stringify(msgswitch));
    });

    $('#logout').on("click", function() {
        msgswitch[0]=false;
        localStorage.setItem('msgswitch',JSON.stringify(msgswitch));
    });



    $.ajaxSetup({cache:false});
    setInterval(function(){
        if(msgswitch[0]){
            $('.mssgs').load('../chat/refresh_messages.php');
        }
    },1000);

    $(document).on('click', '.delete', function() {
        $.ajax({
            type: 'POST',
            url : '../chat/delete_message.php',
            data : {id:$(this).attr('msg_id')},
            success : function(){
                //$('.mssgs').load('../chat/refresh_messages.php');
            }
    });
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