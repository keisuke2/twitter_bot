<?php



require_once("./autoload.php");
require_once("./src/TwitterOAuth.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$pro_code=rand(1,33);

try
{




$dsn='mysql:dbname=mother_teresa;host=localhost';
$user='root';
$password='root';
$dbh= new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');



$sql='SELECT meigen FROM meigen WHERE id=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);
//取り出す
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
$meigen=$rec['meigen'];
print $meigen;


//var_dump($rec);

$dbh=null;

$consumer_key = "dFVBrBWug293MWqUGA2YMnVOI";
$consumer_secret = "J3iqlSPLFV6qifQCxPHiggEx3WMCJN8dCVPSaxG8PT6vpse0cQ";
$access_token = "3500472432-6t6NXhT7oSoXBv87FicR2jtd5ptmB7Cqp5wBXJk";
$access_secret = "ZUcomWX2QEIoFpEuVl44w2kxHEoVurXtGJnzvahm0bvlq";

//タイムラインの情報をゲット
$tw = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_secret);
$res = $tw->post("statuses/update", array("status" => $meigen));



}

catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をおかけしております';
	print'<br/>';
}

?>












