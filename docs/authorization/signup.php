<?php
require "db.php";

$data = $_POST;
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
        echo '<div style="color: green;">Sign up complete successfully</div><hr>';

    } else {
        echo '<div style="color: red;">' . array_shift($errors) . '</div>';
    }


}
?>

<form action="/signup.php" method="POST">
    <p>
    <p><strong>Your login</strong>:</p>
    <input type="text" name="login">
    </p>

    <p>
    <p><strong>Your password</strong>:</p>
    <input type="password" name="password">
    </p>

    <p>
    <p><strong>Enter password again</strong>:</p>
    <input type="password" name="password_2">
    </p>

    <p>
        <button type="submit">Sign up</button>
    </p>
</form>
