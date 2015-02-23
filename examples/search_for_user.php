<?php

require_once '../src/Instagram.php';
require_once('client_id_definition.php');

/*
	set content-type
*/
header('Content-type: plain-text; charset=utf-8');

/*
	define Instagram class instance and pass client_id
*/
$instagram = new Instagram(Client_ID);

/*
	search for a user
*/
if (isset($_GET['user'])) {

	// check if there is a result or not
	if ($instagram->search_user($_GET['user']) != false) {

		print_r($instagram->search_user($_GET['user']));

	} else {
		echo 'No result is available.';
	}
	
} else {
	echo 'write your search on \'user\' argument of url';
}


?>