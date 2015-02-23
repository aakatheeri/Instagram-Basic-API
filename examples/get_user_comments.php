<?php

require_once '../src/Instagram.php';
require_once('client_id_definition.php');
// set content-type
header('Content-type: application/json; charset=utf-8');

// define Instagram class instance and pass client_id
$instagram = new Instagram(Client_ID);

if (isset($_GET['username'])) {

	// get user media and check if there is result or not
	if ($instagram->get_user_media($_GET['username']) != false) {

		/*
			get last comments
		*/
		print_r($instagram->get_last_comments());

	} else {
		echo 'No comments are available.';
	}

} else {
	echo 'write username on \'username\' argument of url';
}

?>