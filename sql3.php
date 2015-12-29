<?php




$comments='楽しい';

//$time=date( "Y-m-d H:i:s", time() );
//$time=cast('2015-09-10 17:17:03' as datetime);
$time='2015-09-10 17:17:04';
$time2='2015-09-10 17:17:04+000-00-00 00:05:000';

echo $time;
echo $time2;

$dsn='mysql:dbname=team_sisyo;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//$sql='SELECT id,message,member_name FROM posts WHERE 1';
/*
$sql='SELECT u.id, u.name, u.create_time, c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND u.create_time <=?';
*/
/*
$sql='SELECT u.id, u.name, u.create_time, c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND between create_time ? and ?+0000-00-00 00:01:00';
*/

/*完成系
$sql="SELECT u.id, u.name, u.create_time, c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND create_time BETWEEN '2015-09-10 17:17:03' AND '2015-09-10 17:22:03+0000-00-00 00:05:00'";
*/
/*
$sql="SELECT u.id, u.name, u.create_time, c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND create_time BETWEEN ? AND ? +000-00-00 00:05:000 ";
*/
$sql="SELECT u.id, u.name, u.create_time, c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND create_time BETWEEN cast(? as datetime) AND cast( ?  as datetime)";



//$sql="SELECT u.id, u.name, u.create_time, c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND create_time BETWEEN '2015-09-10 11:27:10' AND '2015-09-10 11:27:10 +0000-00-00 00:05:00'";

// between date '2007-12-01' and date '2007-12-31
$data[]=$comments;
$data[]=$time;
$data[]=$time2;
$stmt= $dbh->prepare($sql);
$stmt->execute($data);


$rec=$stmt->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する
//var_dump($rec);

echo 'あなたと同じ発言';
echo $rec['common_words'];
echo 'を投稿した人がいます';
echo '<br/>';
echo $rec['name'];
echo'<br/>';

$dbh = null;





?>