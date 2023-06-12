<?php
session_start();

include("funcs.php");
$user_id = $_POST["user_id"];
$file_name = $_POST["file_name"] ;
echo $user_id;
echo $file_name;

//3．データ登録SQL作成
$pdo = db_conn();
$sql ="INSERT INTO Artista_table(user_id,file_name) VALUES (:user_id,:file_name)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id',  $user_id,   PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':file_name',$file_name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//4 データ表示
$value = "";
if($status==false) {
  sql_error($stmt);
} else {
  redirect("insta_top.php");
}


// //全データ取得
// $img = $stmt ->fetchAll(); //一人分の取り出し
// var_dump($img);
// 

?>
