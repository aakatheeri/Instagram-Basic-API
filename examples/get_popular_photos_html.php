<?php
require_once '../src/Instagram.php';
require_once('client_id_definition.php');
$instagram = new Instagram(Client_ID);

?>

<html>
<head>
	<title>Popular photos on Instagram</title>

	<style type="text/css">
		h2 {
			color: #780D19;
		}
	</style>
</head>

<body>

	<div id="wrap">
	<h1>Popular Photos from Instagram</h1>
	<br>
	<ul>
	<?php
	$posts = $instagram->get_popular_posts();
	for ($i=0; $i<count($posts); $i++) {

		if ($posts[$i]->type == 'image') {
			echo '<li>';
			echo '<h2>From ' . $posts[$i]->caption->from->full_name . ' (@' . $posts[$i]->caption->from->username . ')</h2>';
			echo '<img src="' . $posts[$i]->images->low_resolution->url . '" alt="" /><br>';
			echo '<p>' . $posts[$i]->caption->text .'</p>';
			echo '<em><strong>' . $posts[$i]->likes->count . '</strong> likes | ' . $posts[$i]->link;
			echo '</li>';
		}
		
	}
	?>
	</ul>
	</div>
</body>
</html>