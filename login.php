

<?php
  require_once("./includes/session.php");
  require_once("./includes/db_connection.php");
	require_once("includes/functions.php");
     if(isset($_SESSION['user_id'])){
       redirect_to("staff.php");
     }
?>

<?php

if(isset($_POST['login'])){
  global $conn;
    $username= trim(prepare_sql($_POST['username']));
    $password= trim(prepare_sql($_POST['pass']));
    $harshed_password = sha1($password);

    $query = "SELECT id, username FROM users WHERE username ='{$username}' AND harshed_password ='{$harshed_password}'  ";

      $result = mysql_query($query,$conn);
      confirm_query($result);
      $get=mysql_fetch_array($result);

      if($get){
        $message = "Login successfully";
        $_SESSION['user_id'] = $get['id'];
        $_SESSION['username'] = $get['username'];

        redirect_to("staff.php");
      }else {
        $message = "Failed attempt Failed";
      }

}else{
  if(isset($_GET['logout'])&&$_GET['logout']==1){
    $message = "You are now logged out";
  }
  $username = "";
  $password =	"";
    if(!isset($_GET['logout']) ||!isset($_POST)){$message = ""; }
}

 ?>










<div class="login">

			<h2>LOG IN</h2>
        <p><?php if(isset($_GET)||isset($_POST)){echo $message;} ?></p>
        	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="email">Username</label><br>
            <input type="text" name="username" placeholder="username" id="email"><br>
            <label for="pass">password:</label><br>
            <input type="password" name="pass" placeholder="your password" id="pass"><br>
            <input type="submit" name="login" class="Submit">
			<p>Not Registered?  <a href="Registration.php">Register</a></p>
        	</form>
	</div>
