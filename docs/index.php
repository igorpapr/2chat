<?php 
require "authorization/db.php";

$data = $_POST;
  if(isset($data['do_login']))
  {
    $user = R::findOne('users','login = ?', array($data['login']));
    if($user)
    {
      //login exists
      if(password_verify($data['password'], $user-> password)){
        //vse horosho, loginim polzovatelya
        $_SESSION['logged_user'] = $user;
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
      echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
    }
  }


  if (isset($data['do_signup'])) {
    //

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
        $user->login = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);

    } else {
        echo '<div style="color: red;">' . array_shift($errors) . '</div>';
    }
}

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

    <div class="main-content">

        <header>
          <p>2chat</p>
        </header>

        <div class="history-wrap">
         <div class=""></div>
        </div>
    </div>

    <?php if(!isset($_SESSION['logged_user']) ) : ?>
    <div class="back-dialog">
        <div class="dialog-wrapper">
          <div class="dialog-content">

            <div>
                <h3 class="sign-up-in active" id="in">Sign in</h3>
                <h3 class="sign-up-in" id="up">Sign up</h3>
            </div>
            <p class="description">Please write down your nickname and password</p>
            
            <div id="signin">
            <form action = "index.php" method ="POST">
                <p>Nickname</p>
                <input type="text" name="login" value="<?php echo@$data['login']; ?>">
                <p>Password</p>
                <input type="password" name="password" value="<?php echo@$data['password']; ?>">
                <p></p>
                <button class="my-button" type="submit" name="do_login"> Sign in </button>
            </form> 
          </div>

          <div class="dnone" id="signup">
            <form action = "index.php" method ="POST">
                <p>Nickname</p>
                <input type="text" name="login">
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