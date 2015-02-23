# Instagram-Basic-API
PHP class that provide basic using and dealing with Instagram APT (without authentication)

# How to use it
Current directory structre of Instagram-Basic-API is contains to directory:

- <strong>/src:</strong> contains Instagram class
- <strong>/examples</strong> contains examples of how to use Instagram class

To use Instagram class for get popular photos/videos on instagram, you need to create php file or modify existing one to add popular photos/vidoes.

For instance, I create <strong>/popular_posts.php</strong>, and require Instagram class and call <i>get_popular_posts</i> on it:

```php
// require Instagram class
require_once 'src/Instagram.php';

// define Instagram class instance with passing client id
$instagram = new Instagram('Your Client ID');

// output last popular posts as readable array
print_r($instagram->get_popular_posts()); 
```

You can also access to local objects in popular posts like 'link', 'username', 'images':

```php
// require Instagram class
require_once 'src/Instagram.php';

// define Instagram class instance with passing client id
$instagram = new Instagram('Your Client ID');

// store data of first post in variable
$first_post = $instagram->get_popular_posts()[0];

// output link, username, and thumbnail image of first post
echo 'Link => ' . $first_post->link . '<br>';
echo 'From => @ ' . $first_post->user->username . '<br>';
echo 'Thumbnail: <br>';
echo '<img src="' . $first_post->images->thumbnail->url ." width="' . $first_post->images->thumbnail->width . '" height="' . $first_post->images->thumbnail->height . '" alt="" />';

```

# Available methods
these are current methods available for several purposes:

### Instagram('Your_Client_ID')

to make class instance and passing your app client id for getting different data from class public methods.

```php
$instagram = new Instagram('Your_Client_ID');
```

### get_popular_posts()

return last popular posts (photos and videos)

```php
$instagram->get_popular_posts()
```

### search_user($user)

return the result of your Instagram user searching

```php
$instagram->search_user($user)
```

### get_user_id_from_username($username)

return user id of Instagram username 

```php
$instagram->get_user_id_from_username($username)
```

### get_user_media($username)

return user media (last posts of selected user) 

```php
$instagram->get_user_media($username)

```

### get_last_posts()

return last posts (this will include only images, text, username, and id of last posts)

<strong>Notice:</strong> You need to call 'get_user_media' firstly.

```php
$instagram->get_last_posts()

```

### get_last_comments()

return last comments of posts of user

<strong>Notice:</strong> You need to call 'get_user_media' firstly.

```php
$instagram->get_last_comments()

```

### get_last_comments_from_post($post_id)

return last comments of selected post

<strong>Notice:</strong> You need to call 'get_user_media' firstly.

```php
$instagram->get_last_comments_from_post($post_id)

```

# How to create client_id?

Just create new app/client on Instagram developer web app and it will provide client_id after client creation immediately:

[Instagram Developer Documentation](https://instagram.com/developer/)

# Recommentations

Look to examples available on this repository and test them on your local server.
