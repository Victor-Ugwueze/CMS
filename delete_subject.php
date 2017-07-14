
<?php
  require_once("./includes/db_connection.php");
  require_once("./includes/functions.php");


  if(isset($_GET)){
    $id= $_GET['subj'];
    delete_subject($id,'subjects');
 }

?>
