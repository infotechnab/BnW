<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'POD_database_helper.php';
        
if(isset($_POST['menu_id_next']))
    $a=($_POST['menu_id_next']);
else {
$a='0';
}
$GLOBALS['a']=$a;
//return $a;
//var_dump($a);

 function query($parent_id) { //function to run a query
    $b=$GLOBALS['a'];
   // var_dump($b);
    if(isset($b)) {
             $query = pdo_db()->query  ( "SELECT * FROM navigation WHERE parent_id=$parent_id && menu_id=$b"   );         

     return $query;
    }
     else {
       $query = 'please select menu';  
       return $query;
     }
     
}
function has_child($query) { //This function checks if the menus has childs or not
	$result=pdo_db()->query($query->queryString);
	$rows =count($result->fetchObject());
	if ($rows > 0) {
		return true;
	} else {
		return false;
	}
}

function fetch_menu($query) {
	while ( $result = $query->fetch(PDO::FETCH_ASSOC) ) {
		$menu_id = $result ['id'];
		$menu_name = $result ['navigation_name'];
		$menu_link = $result ['navigation_link'];
		echo "<li  class='list-group-item text-left' style='font-size:16px'><div id='fullNav'>".
                "{$menu_name}</div><div style='float:right;margin-left:5%;color:#555;'>".
                        "<a href='#' style='font-size:16px;text-decoration:none;'><span id='$menu_id' class='deleteNav glyphicon glyphicon-trash'></span> |</a> ".
                        "<a  href='#' style='font-size:16px;text-decoration:none;' <span id='$menu_id' class='editNavs  	glyphicon glyphicon-edit'></span> |</a> ".
                        "<a  href='#'style='font-size:16px;text-decoration:none;'><span id='$menu_id' class='upNav glyphicon glyphicon-arrow-up'></span> | </a>".
                        "<a href='#' style='font-size:16px;text-decoration:none;'><span id='$menu_id' class='downNav glyphicon glyphicon-arrow-down'></span> </a>".
                        "</div><div style='clear:both'></div></div>";
		if (has_child ( query ( $menu_id, 0))) {
			echo "<ul class='list-group'>";
			fetch_menu ( query ( $menu_id, 0 ) );
			echo "</ul>";
		}
		echo "</li>";
	}
}
//call this function with 0 parent id
?>
