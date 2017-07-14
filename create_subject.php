<?php
	require_once("./includes/db_connection.php");
	require_once("./includes/functions.php");
 ?>
<?php 
	session_start();
?>

<?php
  if(isset($_POST['submit'])){
    $fields = array('menu_name','position','visible');
        foreach ($fields as $field) {
          if (!isset($_POST[$field])||empty($_POST[$field]))
          {
            $errors[] = "{$field} must be selected";
          }
        }


        $field_length = array('menu_name' => 30);
            foreach($field_length as $field_name => $maxlenth) {
              if(strlen(trim(prepare_sql($_POST[$field_name])))>$maxlenth){
                $errors[]= "{$field_name} Not more than 30 characters";
              }
			  $_SESSION['errors']= $errors;
            }

      if(!empty($errors)){
        redirect_to("add_subject.php");
      }

    $menu_name=prepare_sql($_POST['menu_name']);
    $position=prepare_sql($_POST['position']);
    $visible=prepare_sql($_POST['visible']);

      $output= $menu_name. " ". $position. " " .$visible;

      $query= "INSERT INTO subjects
                (
                  menu,position,visible
                )
                VALUE(
                  '$menu_name',$position,$visible
                )";

        $result =  mysql_query($query);
        confirm_query($result);
        if($result){
          header("location: content.php");
          exit;
        }else {
          echo "problem adding subject";
        }
  }

 ?>
