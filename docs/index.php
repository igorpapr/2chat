<?php
require_once "recaptchalib.php";
 
?>

<!DOCTYPE html>
<html>
  <head>
  	<link rel="stylesheet" href="./css/stylesheet.css">
  	<link rel="shortcut icon" href="./img/favico.ico" type="image/png">
  	<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Ubuntu" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?render=6Lew6H8UAAAAAFnHtTpnkdPNJOp6PX8Fiyh8IASH'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>2chat</title>
  </head>

  <body>
  	<?php
$secret = "6Lew6H8UAAAAAIwZg8ucqjjvhMOKVcWgRbViQGod";
$response = null;
$reCaptcha = new ReCaptcha($secret);
if (!empty($_POST)) {
 
    //Валидация $_POST['name'] и $_POST['email']
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }
 
    if ($response != null && $response->success) {
        echo "Все хорошо.";
    } else {
        echo "Вы точно человек?";
    }
 
}


?>


  	<div class="main-content">

  	    <header>
  		    <p>2chat</p>
  	    </header>

  	    <div class="history-wrap">
  		   <div class=""></div>
  	    </div>
  	</div>

  	<div class="back-dialog">
        <div class="dialog-wrapper">
          <div class="dialog-content">

          	<form>
          		<h3>Sign in</h3>
          		<p class="description">Please write down your nickname and password</p>
                <p>Nickname</p>
                <input type="text" id="nickname">
                <p>Password</p>
                <input type="password" id="password">
                <p></p>
                <div class="g-recaptcha" data-sitekey="6Lew6H8UAAAAAFnHtTpnkdPNJOp6PX8Fiyh8IASH"></div>
                <button class="my-button"> Sign in </button>
            </form> 

          </div>
        </div>
    </div>
  </body>
</html>