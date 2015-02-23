<?php
require_once '../src/Instagram.php';
require_once('client_id_definition.php');

$instagram = new Instagram(Client_ID);
$username = $_GET['username'];
?>

<html>
<head>
	<title>Get last posts of Instagram user</title>

	<style type="text/css">
		h2 {
			color: #780D19;
		}

		ul li {
			overflow: hidden;
			margin-bottom: 10px;
			padding-bottom: 10px;
			list-style: none;
			border-bottom: 1px dotted #8E959F;
		}

		.picture {
			float: left;
			width: 30%;
		}

		.info {
			float: right;
			width: 70%;
		}
	</style>
</head>

<body>

	<div id="wrap">

		<?php if (isset($username)) {

		// get users media
		$instagram->get_user_media($username);

		// get last posts from user media
		$user_media_last_posts = $instagram->get_last_posts();

		// check if there is any post
		if ($user_media_last_posts != false) { ?>

			<h1>Last posts of '@<?php echo $username ?>' on Instagram</h1>
			<br>
			<ul>
			<?php
			// output last posts
			for ($i=0; $i<count($user_media_last_posts); $i++) {
				if ($user_media_last_posts[$i]->type == 'image') {

			?>
				<li>
					<div class="picture">
						<img src="<?php echo $user_media_last_posts[$i]->images->low_resolution->url ?>" alt="" />
					</div>

					<div class="info">
						<h2>Date: <?php echo gmdate("Y-m-d / H:i:s", $user_media_last_posts[$i]->created_time); ?></h2>
						<p><?php echo $user_media_last_posts[$i]->text; ?></p>
					</div>
				</li>
				
			<?php }
			}
		} else { ?>
			<h1>There is no user available</h1>
		<?php } ?>
		</ul>

		<? } else { ?>
		<h1>Please provide a username for getting last posts!</h1>
		<p>Example: http://url/get_user_media_html.php?username=someone</p>
		<?php } ?>
	</div>
</body>
</html>