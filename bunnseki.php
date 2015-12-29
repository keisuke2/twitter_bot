<?php


require_once("./autoload.php");
require_once("./src/TwitterOAuth.php");
use Abraham\TwitterOAuth\TwitterOAuth;



$consumer_key = "dFVBrBWug293MWqUGA2YMnVOI";
$consumer_secret = "J3iqlSPLFV6qifQCxPHiggEx3WMCJN8dCVPSaxG8PT6vpse0cQ";
$access_token = "3500472432-6t6NXhT7oSoXBv87FicR2jtd5ptmB7Cqp5wBXJk";
$access_secret = "ZUcomWX2QEIoFpEuVl44w2kxHEoVurXtGJnzvahm0bvlq";

$tw = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_secret);

$res = $tw->get("statuses/home_timeline",["since_id"=>'21838483724232']);

/*

$dsn='mysql:dbname=team_sisyo;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$temp_sql='select * from common_words';
$common_words=$dbh->query($temp_sql);
 */


$dsn='mysql:dbname=team_sisyo;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql="SELECT * FROM common_words";

//$sql="SELECT u.id, u.name, u.create_time,c.common_words FROM user_comments AS u INNER JOIN common_words c ON u.common_words_id = c.id WHERE u.comments = ? AND create_time BETWEEN cast(? as datetime) AND cast( ? as datetime)+cast( '0000-00-00 00:05:00' as datetime)/*AND u.bool=0*/";
$stmt= $dbh->prepare($sql);
$stmt->execute();


$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$common_words=$rec['common_words'];




$dbh = null;


foreach ($res as $sisyo) {
 $name=$sisyo->user->screen_name;
 $comments=$sisyo->text;

  #$common_wordは"楽しい","嬉しい"とかの言葉が入ってくるので、$commentsの文字列内にその言葉が含まれているかどうかを判定
  #見つかったとき、$common_word["id"]でidが取得できるので、それを何かの変数に保存してほしいhosii
 foreach($common_words as $common_word)
 {
 

 
 /*
 $name1="おなかいたい あたまいたい";
 $name2="おなかいたい";

    $common_words_ids=[];
    
    $ps=strpos($comments,$common_word["common_words"]);
    var_dump($pos);
 */
    
  
  //$common_words_ids - > ["1","3"];
    if(strpos($comments,$common_word["common_words"])){
    
    /*
    echo"trueのとき、$common_words_idsに $common_word["id"]
    を追加する";
    */
    echo '大丈夫です';


  
   
 }
}
}
 /*

 if($name!='Hide09087021659' && $comments!=NULL){
 $words_id=10;
 $create_time=date("Y-m-d H:i:s");
 $sql_2="INSERT INTO user_comments(name,comments,common_words_id,create_time) VALUES('$name','$comments','$words_id',cast('$create_time' as datetime))";
 $dbh->query($sql_2);
 }
 $dbh = null;
}
*/
?>