<?php
	session_start();
	require_once("./includes/db_connection.php");
	require_once("./includes/functions.php");

	find_selected_content();
	

if(isset($_SESSION['errors'])){
		$errors= $_SESSION['errors'];
		echo count($errors). " errors <br />";
	foreach ($errors as $error) {
		echo $error. "<br />";
	}

}

$_SESSION[]= array(); //set session to empty array to unset all the variables

  if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time()-42000, '/');
  }

    session_destroy();


?>
<?php include("./includes/header.php"); ?>
			<div id="navigation">
					<?php echo navigation($sel_subj,$sel_page); ?>
				<br />


			</div>
			<div id="staff-page">
				<h2 style="padding-left: 10px;">Add Subject</h2><br /><br />
        <form method="post" action="create_subject.php">
          subject name:
         <input type="text"  name="menu_name"><br /><br />
         position:
        <select style="color: black;" name="position">
					<?php
						$get_subj= get_all_subjects();
							$subj_count= mysql_num_rows($get_subj);

							for($count=1;$count<=$subj_count+1;$count++){
								echo "<option value={$count} >{$count}</option>";
							}
					 ?>
        </select><br /><br />
        Visible:
        <input type="radio" value="1" name="visible">Yes
        <input type="radio" value="0" name="visible">No <br /><br />
        <input type="submit" value="Submit" name="submit">
        </form>



		<?php require('includes/footer.php')?>
