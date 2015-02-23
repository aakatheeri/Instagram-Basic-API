<?php

/*
	Class:	Instagram
	Desc: 	Giving basic developers' needs for instagram platform without authentication
*/

Class Instagram {

	// private attributes and methods
	private $instagram_api_url = 'https://api.instagram.com/v1/';
	private $client_id;
	private $user_media;

	// constructor
	public function Instagram($client_id) {
		$this->client_id = $client_id;
	}

	// get popular photos
	public function get_popular_posts($single_post_id) {

		// set full api url
		$url = $this->instagram_api_url . 'media/popular?client_id=' . $this->client_id;

		// get data from json content
		$request_url = file_get_contents($url);

		// decode json content
		$json_posts_feed = json_decode($request_url);

		// select single post
		// posts available until 19 units (starting from 0 to 18 as index)
		if (is_int($single_post_id)) {
			return $json_posts_feed->data[$single_post_id];
		}

		// return popular posts feed
		return $json_posts_feed->data;
		
	}

	// search for user
	public function search_user($user) {

		// set full api url
		$url = $this->instagram_api_url . 'users/search?q=' . urlencode($user) . '&client_id=' . $this->client_id;

		// get data from json content
		$request_url = file_get_contents($url);

		// decode json content
		$json_users_feed = json_decode($request_url);

		// return users available
		if (count($json_users_feed->data) != 0) {
			return $json_users_feed->data;
		} else {
			return false;
		}

	}

	// set user id by passing username
	public function get_user_id_from_username($username) {

		// initial search user variable
		$search_user = $this->search_user($username);

		// check if there any result
		if ($search_user != false) {
			// get resutl from inside function
			$user_id = $this->search_user($username)[0]->id;

			// return user id
			return $user_id;
		} else {
			return false;
		}

	}

	// get user media by passing username
	public function get_user_media($username) {

		// get user id
		$user_id = $this->get_user_id_from_username($username);

		// set full api url
		$url = $this->instagram_api_url . 'users/' . $user_id . '/media/recent/?client_id=' . $this->client_id;

		// get data from json content
		$request_url = file_get_contents($url);

		// decode json content
		$json_user_media_feed = json_decode($request_url);

		// return and assign user media data to user_media private attribute
		if (count($json_user_media_feed->data) != 0) {
			return $this->user_media = $json_user_media_feed->data;
		} else {
			return false;
		}

	}

	// get last posts from user media
	public function get_last_posts() {

		// check if user_media private attribute is available
		if(isset($this->user_media)) {

			// initial last posts temporary array
			$user_media_last_posts = array();

			// push every post in last post temporary array
			for ($i=0;$i<count($this->user_media); $i++) {
				
				// assign available values in user_media private attribute to last posts temporary array and convert it to object
				$user_media_last_posts[] = (object) array (
					'created_time' => $this->user_media[$i]->caption->created_time,
					'text' => $this->user_media[$i]->caption->text,
					'from' => $this->user_media[$i]->caption->from,
					'id' => $this->user_media[$i]->caption->id, 
					'type' => $this->user_media[$i]->type,
					'images' => $this->user_media[$i]->images,
					'videos' => $this->user_media[$i]->videos
				);
				
			}

			// return last posts
			return $user_media_last_posts;

		}

	}

	// get last comments from user media
	public function get_last_comments() {

		if (isset($this->user_media)) {

			// initial last comments temporary array
			$user_media_last_comments = array();

			// push post's comments to last comment temporary array
			for ($i=0; $i<count($this->user_media); $i++) {

				// check if there are comments for post
				if ($this->user_media[$i]->comments->count != 0) {

					// assign post's comments to last comments temporary array
					$user_media_last_comments[] = $this->user_media[$i]->comments->data;
				}

			}

			// return last comments
			return $user_media_last_comments;

		}

	}

	// get last comments from single post by passing post_id
	public function get_last_comments_from_post($post_id) {

		// check if user_media private attribute is available
		if (isset($this->user_media)){

			// initial last comments of single post temporary array
			$last_comments_from_post = array();

			// push post's comments to last comments of single post temporary array
			for ($i=0; $i<count($this->user_media); $i++) {

				// check if there are comments for post
				if ($this->user_media[$i]->comments->count != 0) {

					// assign post's comments to last comments of single post temporary array
					$last_comments_from_post[] = $this->user_media[$i]->comments->data;

				}

			}

			// return last comments of single post
			return $last_comments_from_post[$post_id];
		}

	}

}

?>