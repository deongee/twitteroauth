<?php
session_start();
require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library


/* 
change # (hastag) to html encoding $search = "%23jogja";
you can use OR / @ -> ex. news OR gadget
*/
$search = "%23jogja"; 
$twitteruser = "widiyastanto"; //change to someone twitter name
$notweets = 30;
//////////////manual input///////////////
/* 
Login to https://dev.twitter.com/apps/
open your aplication , select OAuth tool
copy here
*/
$consumerkey = "";
$consumersecret = "";
$accesstoken = "";
$accesstokensecret = "";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
  
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
$search = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".$search."&lang=en&count=10&include_entities=true&with_twitter_user_id=true");
$cred = $connection->get('account/verify_credentials');

echo json_encode($tweets);
//echo json_encode($search);
//echo json_encode($cred);
?>