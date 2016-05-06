<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'POD_database_helper.php';
 function query($parent_id) { //function to run a query  

     

	$query = pdo_db()->query  ( "SELECT * FROM navigation WHERE parent_id=$parent_id");

	return $query;

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

		echo "<li  class='nav-item'><a style='cursor:pointer;' href='{$menu_link}'>{$menu_name}</a>";

		if (has_child ( query ( $menu_id))) {

			echo "<ul class='nav-submenu'>";

			fetch_menu ( query ( $menu_id) );

			echo "</ul>";

		}

		echo "</li>";

	}

}

//call this function with 0 parent id



