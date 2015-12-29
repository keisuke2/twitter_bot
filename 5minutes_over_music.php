<?php

$comments='楽しい';

//$time=date( "Y-m-d H:i:s", time() );　イギリス標準の時間になってしまう

$time='2015-09-10 17:15:04';//時刻現在時刻だとベスト　


echo $time;
echo '<br/>';


$dsn='mysql:dbname=team_sisyo;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql="SELECT u.id, u.name, u.create_time,u.bool, c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND create_time BETWEEN cast( ? as datetime) AND cast( ? as datetime)+cast( '0000-00-00 00:05:00' as datetime) AND u.bool=0";

//$sql="SELECT u.id, u.name, u.create_time,c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND create_time BETWEEN cast(? as datetime) AND cast( ? as datetime)+cast( '0000-00-00 00:05:00' as datetime)/*AND u.bool=0*/";
$data[]=$comments;
$data[]=$time;
$data[]=$time;
$stmt= $dbh->prepare($sql);
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);




$sql2="SELECT m.id, m.title, m.youtube_url ,c.common_words FROM music AS m INNER JOIN common_words c ON m.common_word_id = c.id WHERE c.common_words= ?";
$data2[]=$rec['common_words'];
$stmt2= $dbh->prepare($sql2);
$stmt2->execute($data2);

$rec2=$stmt2->fetch(PDO::FETCH_ASSOC);


$dbh = null;


if($rec['bool']==0)
{
	echo 'あなたと同じ発言';
	echo $rec['common_words'];
	echo 'を投稿した人がいます';
	echo '<br/>';
	echo $rec['name'];
	echo $rec['bool'];
}else{
	echo '音楽を表示する';
	echo $rec2['title'];
	echo '<br/>';
	echo $rec2['youtube_url'];
}
