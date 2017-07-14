<?php
	require_once("./includes/session.php");
	require_once("./includes/db_connection.php");
	require_once("includes/functions.php");
	confirm_logged_in();
?>



<?php

if(isset($_POST['new_user'])){
		$username= trim(prepare_sql($_POST['username']));
		$password= trim(prepare_sql($_POST['pass']));
		$harshed_password = sha1($password);

		$query = 		"INSERT INTO users (
			username, harshed_password
			) VALUES(
				'$username', '$harshed_password'
			)";

			$result = mysql_query($query);
			confirm_query($query);
			if($result){
				$message = "user added successfully";
			}else {
				$message = "Failed to add user";
			}

}else{
	$username = "";
	$password =	"";
	$message = "";
}

 ?>













<div class="login">
			<p><?php ?></p>
			<h2>LOG IN</h2>
			<?php echo $message; ?>
        	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username</label><br>
            <input type="text" name="username" placeholder="username" id="username" value="<?php echo htmlentities($username); ?>"><br />
            <label for="pass">password:</label><br>
            <input type="password" name="pass" placeholder="password" id="pass"  value="<?php echo htmlentities($password); ?> "><br />
            <input type="submit" name="new_user">
			<p>Not Registered?  <a href="Registration.php">Register</a></p>
        	</form>
		</div>
