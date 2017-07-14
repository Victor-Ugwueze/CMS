<?php
		require_once("./includes/session.php");
	require_once("./includes/db_connection.php");
	require_once("./includes/functions.php");


	confirm_logged_in();


?>

<?php
  $errors  = array();

  if(isset($_POST['add'])){
    $fields = array('content','menu_name','position','visible');
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
            $menu_name = prepare_sql($_POST['menu_name']);
            $position = prepare_sql($_POST['position']);
            $visible = prepare_sql($_POST['visible']);
            $content = prepare_sql($_POST['content']);
            $subject_id = prepare_sql($_POST['subject_id']);


            $query= "INSERT INTO pages
                       (menu_name, position,visible,content,subject_id) VALUE('{$menu_name}',{$position},{$visible},'{$content}' ,$subject_id)";
          $result =  mysql_query($query);
          confirm_query($result);
          if(mysql_affected_rows()==1){
            $message= "you have successfully updated your subject";
						redirect_to("content.php");
          }else {
            $message= "Subject update Failed";
						redirect_to("content.php");
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
				<h2 style="padding-left: 10px;">Add Page: <?php echo $sel_pg['menu_name']; ?></h2><br /><br />

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

         <?php
         $pages= return_all_pages();

         while($pag_id=mysql_fetch_array($pages)) {
                  $position_id = $pag_id['position'];
             if($pag_id['position'] > $position_id){
                $position_id=$pag_id['position'];
                echo $position_id;
             }

           }

            ?>
        <form method="post" action="add_new_page.php">

          page name:
          <input type="text"  name="menu_name" value=""><br /><br />

        position:
        <select style="color: black;" name="position">
        <?php
            for($count=1;$count<$pag_id['position']+2;$count++){
              echo "<option value={$count}>{$count}</option>";
            }
          ?>
        </select><br /><br />
          <?php
           ?>
        subject_id:
        <select style="color: black;" name="subject_id">
        <?php
          $subjects= get_all_subjects();
            while($sub_id=mysql_fetch_array($subjects)) {

                echo "<option value={$sub_id['id']}>{$sub_id['id']}</option>";
            }

          ?>
        </select><br /><br />


        Visible:
        <input type="radio" value="1" name="visible">Yes
        <input type="radio" value="0" name="visible">No <br /><br />

        <textarea  name="content"></textarea>

        <input type="submit" value="Add_new" name="add">


        </form>




		<?php require('includes/footer.php')?>
