<?php

/* Start session and load library. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');


//den edit

/* Build TwitterOAuth object with client credentials. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

/* Get temporary credentials. */
$request_token = $connection->getRequestToken('');
//$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
//var_dump($request_token);

//den edit
if (isset ($_REQUEST['oauth_verifier'])){
$access = $_REQUEST['oauth_verifier'];
}
//$access_token = $connection->getAccessToken('1745983');
//var_dump($access_token);
$access=1556356;
//$pin = $connection->getAccessToken2('',$access);
//var_dump($pin);

/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
//var_dump($_SESSION);
/* If last connection failed don't display authorization link. */
switch ($connection->http_code) {
  case 200:
    /* Build authorize URL and redirect user to Twitter. */
   $url = $connection->getAuthorizeURL($token);
  
    //header('Location: ' . $url); 
	echo '<a href="'.$url.'" target="_blank" >get your pin</a><br>';
	?>
	<form action="callback.php" method="get">
	<input type="text" name="oauth_token" value="<?php echo $token; ?>"/>
	<input type="text" name="oauth_verifier" placeholder="enter your pin here"/>
	<input type="submit" value="go" />
	</form>
	
	<?php
    break;
  default:
    /* Show notification if something went wrong. */
    echo 'Could not connect to Twitter. Refresh the page or try again later.';
}
$a = $connection->http_info;
//var_dump($a);
