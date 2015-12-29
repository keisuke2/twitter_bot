<?php


require_once("./autoload.php");
require_once("./src/TwitterOAuth.php");
use Abraham\TwitterOAuth\TwitterOAuth;



$consumer_key = "dFVBrBWug293MWqUGA2YMnVOI";
$consumer_secret = "J3iqlSPLFV6qifQCxPHiggEx3WMCJN8dCVPSaxG8PT6vpse0cQ";
$access_token = "3500472432-6t6NXhT7oSoXBv87FicR2jtd5ptmB7Cqp5wBXJk";
$access_secret = "ZUcomWX2QEIoFpEuVl44w2kxHEoVurXtGJnzvahm0bvlq";


$tw = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_secret);
$res = $tw->get("statuses/user_timeline",["since_id"=>"21838483724232"]);

foreach ($res as $sisyo) {



	echo $sisyo->user->name;
	echo $sisyo->text; #ツイート内容
	echo $sisyo->created_at; #時間

$common_words_id=1;
$dsn='mysql:dbname=team_sisyo;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql_2='INSERT INTO user_comments (name,comments,common_words_id,create_time) VALUES(?,?,?,NOW())';
$stmt_2=$dbh->prepare($sql_2);

$data_2 =[];//初期化しないとだめ
$data_2[]=$sisyo->user->name;
$data_2[]=$sisyo->text;
$data_2[]=$common_words_id;
//$data_2[]=$sisyo->created_at;

$stmt_2->execute($data_2);

$rec_2=$stmt_2->fetch(PDO::FETCH_ASSOC);

$dbh = null;

	


}








?>