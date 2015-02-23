<?php
require_once '../src/Instagram.php';
require_once('client_id_definition.php');

$instagram = new Instagram(Client_ID);
$username = $_GET['username'];
?>

<html>
<head>
	<title>last comments of user</title>

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
		$user_media_last_comments = $instagram->get_last_comments();

		// check if there is any post
		if ($user_media_last_comments != false) { ?>

			<h1>Last comments available on '@<?php echo $username ?>' of Instagram account</h1>
			<br>
			<ul>
			<?php
			// output last posts
			for ($i=0; $i<count($user_media_last_comments); $i++) {
				for ($j=0; $j<count($user_media_last_comments[$i]); $j++) {
			?>
				<li>
					<div class="picture">
						<img src="<?php echo $user_media_last_comments[$i][$j]->from->profile_picture ?>" alt="" />
					</div>

					<div class="info">
						<h2><?php echo $user_media_last_comments[$i][$j]->from->full_name; ?></h2>
						<em><?php echo gmdate("Y-m-d / H:i:s", $user_media_last_comments[$i][$j]->created_time); ?></em>
						<p><?php echo $user_media_last_comments[$i][$j]->text; ?></p>
					</div>
				</li>
				
			<?php
				}
			}
		} else { ?>
			<h1>There is no comments available</h1>
		<?php } ?>
		</ul>

		<? } else { ?>
		<h1>Please provide a username for getting last posts!</h1>
		<p>Example: http://url/get_user_media_html.php?username=someone</p>
		<?php } ?>
	</div>
</body>
</html>