<?php //this is the file for all basic function


function confirm_query($set){
	global $conn;
	if(!$set){
		die("Database query Failed: ".mysql_error());
	}
}

function get_all_subjects(){
	global $conn;
	$query="SELECT *FROM subjects
			ORDER BY
			position ASC";

	$subject_set= mysql_query($query);
	confirm_query($subject_set);
	return $subject_set;
}


function get_all_pages($subject_id){
	global $conn;
	$query= "SELECT *FROM pages
		where subject_id=
		{$subject_id} ORDER BY
		position ASC";

	$page_set= mysql_query($query);
	confirm_query($page_set);
	return $page_set;
}




function return_all_pages(){
	global $conn;
	$query= "SELECT *FROM pages
		ORDER BY
		position ASC";

	$page_set= mysql_query($query);
	confirm_query($page_set);
	return $page_set;
}



function get_subject_by_id($id){
	global $conn;
	$query= "SELECT *FROM subjects
		where id=
		{$id} LIMIT 1";
	$subject_set= mysql_query($query);
	confirm_query($subject_set);
		$sel_sb= mysql_fetch_array($subject_set);
	return $sel_sb;

}

function get_page_by_id($id){
	global $conn;
	$query= "SELECT *FROM pages
		where id=
		{$id} LIMIT 1";
	$page_set= mysql_query($query);
	confirm_query($page_set);
	$sel_pg= mysql_fetch_array($page_set);
return $sel_pg;

}

function find_selected_content(){
	global $sel_sb;
	global $sel_pg;
	global $sel_subj;
	global $sel_page;
	if(isset($_GET['subj'])){
		$sel_subj=$_GET['subj'];
		$sel_page="";
		$sel_sb = get_subject_by_id($sel_subj);
	}else if(isset($_GET['page'])){
		$sel_page= $_GET['page'];
			$sel_pg = get_page_by_id($sel_page);
		$sel_subj="";
	}else{
		$sel_subj="";
		$sel_page="";
	}
}

function navigation($sel_subj,$sel_page)
{
	 $output= "<ul class=\"subjects\">";
		 //get subject from database

			$subject_set = get_all_subjects();
			while($subject=mysql_fetch_array($subject_set)){
				$output .= "<li";// gets the selected subject for css effect

				if($subject["id"]==$sel_subj){$output .=  " class=\"selected\"";}
					$output .= "><a href=\"edit_subject.php?subj=".urlencode($subject["id"]). "\">{$subject['menu']} </a></li>";

			//get pages from database

				$pages_set = get_all_pages($subject['id']);
			$output .= "<ul class=\"pages\">";
				while($page=mysql_fetch_array($pages_set)){
														//gets the page subject for css effect
					$output .=  "<li";
					// if($page["id"]==$sel_page){
						$output .=  " class=\"selected\"";
					// }
					$output .=  "><a href=\"content.php?page=".urlencode($page["id"])."\">{$page['menu_name']}</a></li>";
				}
				$output .=  "</ul>";

			}
		$output .=  "</ul>	";
		return $output;

}

function prepare_sql($value='')
{
	$magic_quotes_gpc_active= get_magic_quotes_gpc();
	$newer_version_php = function_exists("mysql_real_escape_string");  // check the version of php and escape characters for mysql
	if($newer_version_php)
	{
		if($magic_quotes_gpc_active){$value = stripslashes($value);}
		$value = mysql_real_escape_string($value);
	}else {
		if(!$magic_quotes_gpc_active){
		$value = addcslashes($value);
	}
}
return $value;
}

 function redirect_to($location)
{
	header("location: {$location}");
	exit;
}

function delete_subject($id, $table_name){
	    $query = "DELETE FROM {$table_name} WHERE id ={$id} LIMIT 1";
	    $result = mysql_query($query);
	    confirm_query($result);
	    if(mysql_affected_rows()==1){
	      // Deletion successfully carried out
	      redirect_to("content.php");
	    }else{
	      // there were some error
	    }

}

function display_page($query)
{
	$page_set= mysql_query($query);
	confirm_query($page_set);
	$get_pag = mysql_fetch_array($page_set);
		$page = $get_pag['menu_name']. "<br />";
		$page .= $get_pag['content'];
		echo "<h2>{$page}</h2>";
}

?>
