<?php
require_once '../src/Instagram.php';
require_once('client_id_definition.php');

$instagram = new Instagram(Client_ID);
$user = $_GET['user'];
?>

<html>
<head>
	<title>Searching for user</title>

	<style type="text/css">
		h2 {
			color: #780D19;
		}

		ul li {
			overflow: hidden;
			margin-bottom: 10px;
			list-style: none;
		}

		.picture {
			float: left;
			width: 20%;
		}

		.info {
			float: right;
			width: 80%;
		}
	</style>
</head>

<body>

	<div id="wrap">

		<?php if (isset($user)) {

			// get users data
			$users = $instagram->search_user($user);

			// check if there is any user available
			if ($users != false) { ?>
				<h1>Searching for '<?php echo $user ?>' on Instagram users</h1>
				<br>
				<ul>
				<?php

				// output 10 results of search
				$number_of_result = count($users)<=10?count($users):10;
				for ($i=0; $i<$number_of_result; $i++) { ?>

					<li>
						<div class="picture">
							<img src="<?php echo $users[$i]->profile_picture ?>" alt="" />
						</div>

						<div class="info">
							<h2><?php echo $users[$i]->full_name; ?> (<a href="http://instagram.com/<?php echo $users[$i]->username; ?>">@<?php echo $users[$i]->username; ?></a>)</h2>
							<p>Bio: <?php echo $users[$i]->bio; ?></p>
						</div>
					</li>
					
				<?php 
				} ?>
				</ul>
		<?  } else { ?>
			<h1>No result is found</h1>
		<?php }
		} else { ?>
		<h1>Please provide a user for beginning a search on Instagram!</h1>
		<p>Example: http://url/search_for_user_html.php?user=someone</p>
		<?php } ?>
	</div>
</body>
</html>