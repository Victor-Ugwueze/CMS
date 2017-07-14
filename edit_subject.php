<?php
		require_once("./includes/session.php");
	require_once("./includes/db_connection.php");
	require_once("./includes/functions.php");


	confirm_logged_in();


  if(intval($_GET['subj']==0)){
    redirect_to("content.php");
  }
?>

<?php
  $errors  = array();

  if(isset($_POST['Edit_submit'])){

    $fields = array('menu_name','position','visible');
        foreach ($fields as $field) {
          if (!isset($_POST[$field])||empty($_POST[$field]))
          {
            $errors[] = $field;
          }
        }


        $field_length = array('menu_name' => 30);
            foreach($field_length as $field_name => $maxlenth) {
              if(strlen(trim(prepare_sql($_POST[$field_name])))>$maxlenth){
                $errors[]= "Subject Not more than 30 characters";
              }
            }

          if(empty($errors)){
            $id= prepare_sql($_GET['subj']);
            $menu_name = prepare_sql($_POST['menu_name']);
            $position = prepare_sql($_POST['position']);
            $visible = prepare_sql($_POST['visible']);

            $query= "UPDATE subjects
                      SET menu= '{$menu_name}',
                      position = {$position},
                      visible = {$position}
                      WHERE id= {$id}";
          $result =  mysql_query($query);
          confirm_query($result);
          if(mysql_affected_rows()==1){
            $message= "you have successfully updated your subject";
          }else {
            $message= "Subject update Failed";
          }
    }else {
    $message=  "there were ". count($errors). "errors";
    }

  }



  find_selected_content();

 ?>


<?php include("./includes/header.php"); ?>
			<div id="navigation">
					<?php echo navigation($sel_subj,$sel_page); ?>
				<br />


			</div>
			<div id="staff-page">
				<h2 style="padding-left: 10px;">Edit Subject: <?php echo $sel_sb['menu']; ?></h2><br /><br />

        <?php if(!empty($message)){
                  echo "<p class=\"message\">{$message}</p>";
              }

        ?>

        <?php
              if(!empty($errors)){
                  echo "pleasee review the following field <br />";
            foreach ($errors as $error) {
              echo $error. " <br />";
            }
          }

         ?>
        <form method="post" action="edit_subject.php?subj= <?php echo urlencode($sel_sb['id']);  ?>">
          subject name:
          <input type="text"  name="menu_name" value="<?php echo $sel_sb['menu']; ?>"><br /><br />
         position:
        <select style="color: black;" name="position">
					<?php
            if($sel_sb['visible']==1){
              $checked=1;
            }else {
              $checked=0;
            }
						$get_subj= get_all_subjects();
							$subj_count= mysql_num_rows($get_subj);

							for($count=1;$count<=$subj_count+1;$count++){
                  if($count==$sel_sb['position']){
                    $selected= "selected";
                  }else {
                    $selected="";
                  }
								echo "<option value={$count} echo $selected>{$count}</option>";
							}
					 ?>
        </select><br /><br />
        Visible:
        <input type="radio" value="1" name="visible" <?php if($checked==1){
          echo "checked";
        } ?> >Yes
        <input type="radio" value="0" name="visible" <?php if($checked==0){
          echo "checked";
        } ?> >No <br /><br />
        <input type="submit" value="submit" name="Edit_submit">


        &nbsp;
        &nbsp;

        <a href="delete_subject.php?subj= <?php echo urlencode($sel_pg['id']); ?>" onclick="return confirm('Are you sure you want to delete this');" >delete_subject</a>

        </form>




		<?php require('includes/footer.php')?>
