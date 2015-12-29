<?php

/*
実行結果 
作成時刻　2015-09-10 17:15:04から5分以内の'2015-09-10 17:17:04'の出力ができた。

5分以内かどうか確かめるために'2015-09-10 17:24:25'　にも’楽しい’とコメントしした情報を載せたが
表示されたのは'2015-09-10 17:17:04'　のだけ

SELECT u.id, u.name, u.create_time, c.common_words FROM user_comments AS u INNER 
JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = '楽しい' AND 
create_time BETWEEN cast( '2015-09-10 17:15:03' as datetime) AND c
ast( '2015-09-10 17:15:03' as datetime)+cast( '0000-00-00 00:05:00' as datetime)

*/






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
	echo '5分後の処理';
}
