<?php
	require "db.php";

	$data = $_POST;
	if(isset($data['do_login']))
	{
		$user = R::findOne('users','_login = ?', array($data['login']));
		if($user)
		{
			//login exists
			if(password_verify($data['password'],$user->password)){
				//vse horosho, loginim polzovatelya
				$_SESSION['logged_user'] = $user;
				echo 'div style = "color: green;">Logged in!<br/>You can go to <a href ="/">main</a> page</div><hr>';
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
?>

<form action = "login.php" method ="POST">

	<p>
		<p><strong>Login</strong>:</p>
		<input type="text" name="login" value="<?php echo@$data['login']; ?>">
	</p>

	<p>
		<p><strong>Password</strong>:</p>
		<input type="password" name="password" value="<?php echo@$data['password']; ?>">
	</p>

	<p>
		<button type="submit" name="do_login">
			Log in
		</button>
	</p>

</form>