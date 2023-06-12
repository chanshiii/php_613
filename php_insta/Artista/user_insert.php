<?php
//$_SESSION使うよ！
session_start();
include ("funcs.php");
// sschk();

//----------------------------------------------------
//１．入力チェック(受信確認処理追加)
//----------------------------------------------------
//名前 受信チェック:name
if(!isset($_POST["name"]) || $_POST["name"]==""){
  exit("ParameError!item!");
}

//id 受信チェック:lid
if(!isset($_POST["lid"]) || $_POST["lid"]==""){
  exit("ParameError!item!");
}

//pw 受信チェック:lpw
if(!isset($_POST["lpw"]) || $_POST["lpw"]==""){
  exit("ParameError!item!");
}

//管理者 一般 受信チェック:kanri_flg
if(!isset($_POST["kanri_flg"]) || $_POST["kanri_flg"]==""){
  exit("ParameError!item!");
}

//ファイル受信チェック※$_FILES["******"]["name"]の場合
if(!isset($_FILES["img"]["name"]) || $_FILES["img"]["name"]==""){
  exit("ParameError!files!");
}


//2. POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );      //もう一つのPOSTの受け取り方法
$lid       = filter_input( INPUT_POST, "lid" );       //もう一つのPOSTの受け取り方法
$lpw       = filter_input( INPUT_POST, "lpw" );       //もう一つのPOSTの受け取り方法
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" ); //もう一つのPOSTの受け取り方法
$lpw       = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
$img       = $_FILES["img"]["name"]; //もう一つのPOSTの受け取り方法

//3. DB接続します
$pdo = db_conn();

//4. fileupload処理
$upload ="./user_img/"; //画像アップロードのパス
// アップロードしたアップっロードした画像を./img/へ移動
if(move_uploaded_file($_FILES['img']['tmp_name'], $upload.$img)){
//FileUpload OK
}else{
//FileUpload NG
  echo "Upload failed";
  echo $_FILES['img']['error'];
}

//5．データ登録SQL作成
$sql = "INSERT INTO Artista_user_table(name,lid,lpw,kanri_flg,life_flg,img)VALUES(:name,:lid,:lpw,:kanri_flg,0,:img)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',      $name,      PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid',       $lid,       PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw',       $lpw,       PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':img',       $img,       PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_STR)
$status = $stmt->execute();

//6．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("login.php");
}

?>