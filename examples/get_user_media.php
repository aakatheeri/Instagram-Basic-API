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


if (isset($_GET['username'])) {

	/*
		output user id
	*/
	//echo $instagram->get_user_id_from_username($_GET['username']);

	// get user media and check if there is result or not
	if ($instagram->get_user_media($_GET['username']) != false) {

	/*
		output user media
	*/
	print_r($instagram->get_user_media($_GET['username']));

	/*
		output last posts of user
	*/
	//print_r($instagram->get_last_posts());	

	/*
		output last comments of last posts of user
	*/
	//print_r($instagram->get_last_comments());

	/*
		output last comments of single post of user
	*/
	//print_r($instagram->get_last_comments_from_post(2));

	} else {
		echo 'No result is available.';
	}

} else {
	echo 'write username on \'username\' argument of url';
}


?>