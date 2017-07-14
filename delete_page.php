
<?php
  require_once("./includes/db_connection.php");
  require_once("./includes/functions.php");

  if(isset($_GET)){
    $id= $_GET['page'];
    delete_subject($id,'pages');
 }



?>
