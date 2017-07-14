<?php
	
	require_once("./includes/session.php");
	require_once("./includes/db_connection.php");
	require_once("./includes/functions.php");

			find_selected_content();



?>
<?php include("./includes/header.php"); ?>
			<div id="navigation">
			<?php echo navigation($sel_subj,$sel_page); ?>
				<br />
				<a id="addsubjects" href="add_subject.php"><h2>+ Add a Subject</h2></a>

			</div>
			<div id="staff-page">
				<h2 style="padding-left: 10px;"><?php
					if($sel_subj!=""){
							echo $sel_sb['menu']. "<br />";
						}

						if($sel_page!=""){
								echo $sel_pg['menu_name']. "<br />";
								echo $sel_pg['content']."<br /> <br />";
								echo "<a href= \"edit_page.php?page={$sel_pg['id']} \">Edit page</a>";
							}
				?></h2>



		<?php require('includes/footer.php')?>
