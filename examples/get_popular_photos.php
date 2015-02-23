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
	get popular photos
*/
print_r($instagram->get_popular_posts());

/*
	get single popular photo - the first one
*/
//print_r($instagram->get_popular_posts(0));

/*
	output text, author and link of first popular photo from caption
*/
//echo $instagram->get_popular_posts(0)->caption->text . "\n\n == \n" . $instagram->get_popular_posts(0)->caption->from->username;


?>