


<?php 

  
   /*
   
 
 $menuSelected = $_POST['selectMenu'];
$categoryList = array();

    foreach($listOfCategory as $data)
    {
        $str = preg_replace('/\s+/', '', $data->category_name);
        if(isset($_POST[$str]))
        {
            array_push($categoryList, $data->category_name);
        }
}
print_r($categoryList);




 echo $menuSelected."<br/>";
    * */


?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body>

<div id='cssmenu'>
		<ul>
<?php
function query($parent_id) { //function to run a query
$query = mysql_query ( "SELECT * FROM navigation WHERE parent_id=$parent_id" );	
   // $query = $this->dbmodel->get_list_by_parent_id($parent_id);   
	return $query;
}
function has_child($query) { //This function checks if the menus has childs or not
	$rows = mysql_num_rows ( $query );
	if ($rows > 0) {
		return true;
	} else {
		return false;
	}
}
function fetch_menu($query) {
	while ( $result = mysql_fetch_array ( $query ) ) {
		$menu_id = $result ['id'];
		$menu_name = $result ['navigation_name'];
		$menu_link = $result ['navigation_link'];
		echo "<li  class='has-sub '><a href='{$menu_link}'><span>{$menu_name}</span></a>";
		if (has_child ( query ( $menu_id ) )) {
			echo "<ul>";
			fetch_menu ( query ( $menu_id ) );
			echo "</ul>";
		}
		echo "</li>";
	}
}
fetch_menu (query(0)); //call this function with 0 parent id
 
?>
		</ul>
	</div>
    
   

</body>
</html>