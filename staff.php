<?php
	require_once("./includes/session.php");
	require_once("includes/functions.php");

	confirm_logged_in();
	include("includes/header.php");
?>
			<div id="navigation">
			</div>
			<div id="staff-page">
				<h2 style="text-align:center;">Staff Menu</h2>
				<P>Welcome to staff area, <?php echo $_SESSION['username']; ?></P>
				<ul>
					<li><a href=content.php>Manage Website Content</a></li>
					<li><a href=new_user.php>Add new user</a></li>
					<li><a href="logout.php" >logout</a></li>
				</ul>


		<?php include('includes/footer.php')?>
