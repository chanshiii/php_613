<?php

//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST["lid"]; //ID
$lpw = $_POST["lpw"]; //PW

//1.  DB接続します
include ("funcs_chat.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$sql = "SELECT * FROM 2ch_user_table WHERE lid=:lid AND life_flg=0";
$stmt = $pdo->prepare($sql); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得 一番上の一行を取得するfetch 全てはfetchAll??
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($lpw, $val["lpw"]);  //$lpw:入力したpw $val["lpw"]:ハッシュ化された関数と比較
if($pw){   //($pw==true)と同じ意味
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  $_SESSION["user_id"]   = $val['user_id'];
  //Login成功時（リダイレクト）
  redirect("index_chat.php");
}else{
  //Login失敗時(Logoutを経由：リダイレクト)
  redirect("login.php");
}

exit();


?>
<!-- 上記$_SESSIONで宣言したカラムは他のページでも使用できるため、データベースに接続しなくても呼び出すことが可能になる -->