<?php
session_start();
include ("funcs.php");
// sschk();

//2. DB接続します
$pdo = db_conn();

//3．データ登録SQL作成
$sql ="SELECT * FROM Artista_user_table ";
$stmt = $pdo->prepare($sql);
// $stmt ->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
// $values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);
$img = $stmt ->fetch(); //一人分の取り出し

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="../style.css"> -->
  <link href="../user.css" rel="stylesheet">
  <link href="../form.css" rel="stylesheet"></link>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"><!-- 目隠し用のアイコンCDN -->
  <title>Login</title>
</head>
<body>

<!-- Head[Start] -->
<header>
  <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->



  <!-- login画面 -->
  <div style="display: flex; justify-content: center;">
<form name="form1" action="login_act.php" method="post" class="form" style="width:640px">
<div class="jumbotron">
<p id="heading">Login</p>
<!-- <legend>Login</legend> -->
      <div class="field">
     <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
      </svg>
      ID:<input type="text" name="lid" />
    </div>
    <div class="field">
     <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
      </svg>
      PW:<input type="password" name="lpw" id="textPassword">
      <span id="buttonEye" class="fa fa-eye" style="color: white" onclick="pushHideButton()"></span>
    </div>
      <div class="btn">
      <button class="button2">Sign Up</button>
    </div>
</div>
      <!-- <input type="submit" value="LOGIN" /> -->
    </form>
</div>
    <!-- Main[End] -->

    <script>
        //パスワード入力時の目の隠し
      function pushHideButton() {
        var txtPass = document.getElementById("textPassword");
        var btnEye = document.getElementById("buttonEye");
        if (txtPass.type === "text") {
          txtPass.type = "password";
          btnEye.className = "fa fa-eye";
        } else {
          txtPass.type = "text";
          btnEye.className = "fa fa-eye-slash";
        }
      }
    </script>
</body>
</html>