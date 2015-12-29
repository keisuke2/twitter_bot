<?php





$dsn='mysql:dbname=team_sisyo;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

//既読かどうかを表示させるための

// $sql_2='SELECT id FROM company_member_record WHERE company_id=?,member_id=?';
$sql_2='SELECT id FROM  WHERE name=?';
$stmt_2=$dbh->prepare($sql_2);
$data_2[]=$name;
$stmt_2->execute($data_2);
//取り出す
$rec_2=$stmt_2->fetch(PDO::FETCH_ASSOC);
//取り出したデータを変数に格納する



//$sql='SELECT id,message,member_name,created,code FROM posts, mst_company  WHERE posts.company_id=mst_company.code ORDER BY id DESC LIMIT '.$start.',10';

$stmt= $dbh->prepare($sql);
$stmt->execute();

$dbh = null;


if($rec_2['id']==''){//まだ５分経過してない



}
else
{//5分経過






?>