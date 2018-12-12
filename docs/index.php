<?php 
require "authorization/db.php";

$data = $_POST;
?>




<html>
  <head>
    <link rel="stylesheet" href="./css/stylesheet.css">
    <link rel="shortcut icon" href="./img/favico.ico" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Ubuntu" rel="stylesheet">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?render=6Lew6H8UAAAAAFnHtTpnkdPNJOp6PX8Fiyh8IASH'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>2chat</title>
  </head>

  <body>

    <div class="main-content">

        <header>
          <div class="divp">2chat</div>

          <div class="logout" ><a id="logout" href="/authorization/logout.php">Log out</a>
        </header>

       <div class="history-wrap">

        <div class="mssgs" id="m1">
        </div>

          <form action="../chat/chat.php" method="post" id="ajax-form">
             <textarea id="txtar" name="common_text"></textarea>
             <div style="text-align: left; margin-left: 10%"><input class="my-button" type="submit" name="send" value="send"></div>
          </form>

        </div>
    </div>

    <?php if(!isset($_SESSION['logged_user']) ) : ?>
    <div class="back-dialog">
        <div class="dialog-wrapper">
          <div class="dialog-content">

            <div>
                <h3 class="sign-up-in" id="in">Sign in</h3>
                <h3 class="sign-up-in" id="up">Sign up</h3>
            </div>
            <p class="description">Please write down your nickname and password</p>
            
            <div id="signin">
              <?php


              if(isset($data['do_login']))
             {
               $user = R::findOne('users','login = ?', array(trim($data['login'])));
               if($user)
               {
                 //login exists
                 if(password_verify($data['password'], $user-> password)){
                   //vse horosho, loginim polzovatelya
                   $_SESSION['logged_user'] = $user;
                   echo "<script>window.location.href='index.php'</script>";
                 }else
                 {
                   $errors[] = "Wrong password";
                 }
               }else
               {
                 $errors[] = "Couldn't find user with that login";
               }
            
               if(!empty($errors))
               {
                echo '<div style="color:red;">'.array_shift($errors).'</div>';
               }
             }


              ?>
            <form action = "index.php" method ="POST">
                <p>Nickname</p>
                <input type="text" name="login" value="<?php echo@$data['login']; ?>">
                <p>Password</p>
                <input type="password" name="password"  value="<?php echo@$data['password']; ?>">
                <p></p>
                <button id="gomsg" class="my-button" type="submit" name="do_login"> Sign in </button>
            </form> 
          </div>

          <div class="dnone" id="signup">

            <?php
             if (isset($data['do_signup'])) {
                 $errors = array();
                 if (trim($data['login']) == '') {
                     $errors[] = 'Enter login!';
                 }

                 if ($data['password'] == '') {
                     $errors[] = 'Enter password!';
                 }

                 if ($data['password'] != $data['password_2']) {
                     $errors[] = 'Enter second password correctly!';
                 }
             
                 if (R::count('users','login = ?', array($data['login']))>0) {
                     $errors[] = 'User with that login already exist';
                 }

                 if (empty($errors)) {
                     $user = R::dispense('users');
                     $user->login = trim(htmlspecialchars($data['login']));
                     $user->password = password_hash(htmlspecialchars($data['password']), PASSWORD_DEFAULT);
                     $user->moderator = false;
                     R::store($user);
                     echo '<div style="color: green;">Signed up successfully,</div>';
                     echo '<div style="color: green;">you can now sign in</div>';
                 } else {
                     echo '<div style="color: red;">' . array_shift($errors) . '</div>';
                 }
             }
            ?>




            <form action = "index.php" method ="POST">
                <p>Nickname</p>
                <input type="text" name="login" >
                <p>Password</p>
                <input type="password" name="password">
                <p>Password again</p>
                <input type="password" name="password_2">
                <p></p>
                <button class="my-button" type="submit" name="do_signup"> Sign up </button>
            </form> 
          </div>
        <?php endif; ?>

          <script type="text/javascript" src="./js/index.js"></script>

          </div>
        </div>
    </div>
  </body>
</html>