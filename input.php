<?php
require_once("./constants.php");
require_once("./twitteroauth/autoload.php");
require_once("./twitteroauth/src/TwitterOAuth.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_SECRET);

$dbh = new PDO(MYSQL_CONNECTSTRING, MYSQL_USER, MYSQL_PASSWORD);
$dbh->query('SET NAMES utf8');

$temp_sql='select * from common_words';
$common_words=$dbh->query($temp_sql);

var_dump($common_words);
$mached_word_index = NULL;
foreach($common_words as $common_word){
  $time=date("Y-m-d H:i:s", time());
  $common_words_id = $common_word["id"];
  $temp_sql2="SELECT * from user_comments where common_words_id = $common_words_id AND create_time BETWEEN cast('$time' as datetime)-cast('0000-00-00 00:05:00' as datetime) AND cast('$time' as datetime)";

  $user_comments=$dbh->query($temp_sql2);
  $users=[];
  foreach($user_comments as $comment){
    $users[]=$comment["name"];
  }
  var_dump($users);
  $users=array_unique($users);

  if (count($users)>0){
    $post_message="@".implode(" @",$users)." ".count($users)."人が".$common_word["common_words"]."と言っています";

    $temp_sql3='UPDATE team_sisyo SET bool=1 WHERE name=$user_comments';
    $common_words = $dbh->query($temp_sql3);

    $response = $connection->post("statuses/update",["status"=>$post_message]);
    var_dump($response);
  }
}

?>