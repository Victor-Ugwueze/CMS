<?php
	require_once("./includes/db_connection.php");
	require_once("./includes/functions.php");

			find_selected_content();

			$page = "Welcome";

?>
<?php include("./includes/header.php"); ?>
			<div id="navigation">
			<?php  echo "<ul class=\"subjects\">";
				 //get subject from database
				 	$select = "";
					$subject_set = get_all_subjects();
					while($subject=mysql_fetch_array($subject_set)){
						echo "<li";// gets the selected subject for css effect

						if($subject["id"]==$sel_subj){
							echo  " class=\"selected\"";
						}
							echo "><a href=\"index.php?subj=".urlencode($subject['id']). "\">{$subject['menu']} </a></li>";

					//get pages from database

							if(isset($_GET['subj'])){
								$sub=$_GET['subj'];
								$pages_set = get_all_pages($subject['id']);
					echo "<ul class=\"pages\">";
						while($page=mysql_fetch_array($pages_set)){
																//gets the page subject for css effect
							if($subject['id']!=$_GET['subj']){
								continue;
							}
							  if($page['visible']==0){
									continue;
								}
								?>

							<?php
							$a=2;

							if(isset($_GET['subj'])&&isset($_GET['page'])&&$page['id']==$_GET['page']){
								echo "<li class=\"selected\"";
							}




							else {
								echo "<li";
							}

							 ?>

										<?php

							echo  "><a href=\"index.php?subj=".urlencode($subject['id'])."&page=".urlencode($page['id'])."\">{$page['menu_name']}</a></li>";
						}


						echo  "</ul>";
						}

					}
				echo  "</ul>	";    ?>
				<br />

			</div>
			<div id="staff-page">
				<h2 style="padding-left: 10px;"><?php echo $page; ?></h2>
					<br /> <br />
				<?php

				if(isset($_GET['subj'])&& !isset($_GET['page'])){
					global $conn;
					$select = "select_class";
					$subject_id= $_GET['subj'];
					$query= "SELECT *FROM pages
						where subject_id=
						{$subject_id}
						ORDER BY
						position ASC LIMIT 1";
						display_page($query);
					}


					if(isset($_GET['subj'])&&isset($_GET['page'])){
							global $conn;
							$select = "select_class";
							$subject_id= $_GET['subj'];
							$page_id= $_GET['page'];
							$query= "SELECT *FROM pages
								where subject_id=
								{$subject_id} AND id=
								{$page_id} ORDER BY
								position ASC";
								display_page($query);
						}


				?>

		<?php require('includes/footer.php')?>
