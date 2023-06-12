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
  <title>Sign Up/Login</title>
  <link href="../user.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"><!-- 目隠し用のアイコンCDN -->
  <link href="../form.css" rel="stylesheet"></link>
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body class="full-background">

<!-- Head[Start] -->
<header>
  <?php include("menu_user.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php" enctype="multipart/form-data" class="form">
  <div class="jumbotron">
   <!-- <fieldset> -->
    <!-- <legend>Sign Up</legend> -->
    <p id="heading">Sign Up</p>
      <div class="field">
      <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
      <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
      </svg>
     <label>Name：<input type="text" name="name" class="input-field" placeholder="Username" autocomplete="off"></label>
     </div>
     <div class="field">
     <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
      </svg>
     <label>Login ID：<input type="text" name="lid" class="input-field" placeholder="LoginID"></label>
     </div>
     <div class="field">
      <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
      <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
      </svg>
     <label>Login PW<input type="text" name="lpw" class="input-field" placeholder="LoginPW"></label>
     </div>
     <label>Admin FLG：
      General<input type="radio" name="kanri_flg" value="0">　
      Admin<input type="radio" name="kanri_flg" value="1">
    </label><br>
    <label>profile picture
    <img id="preview" width="200px">
        <input type="file" name="img" accept=".png, .jpg, .jpeg, .pdf, .doc" onchange="previewFile(this);">
      <!-- <input type="file" name="img" accept=".png, .jpg, .jpeg, .pdf, .doc"><p class="img_style"><img src="./user_img/" alt="" width="200px"> -->
    </label><br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <div class="btn">
      <button class="button1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
      <button class="button2">Sign Up</button>
      </div>
     <!-- <input type="submit" value="送信"> -->
    <!-- </fieldset> -->
  </div>
  <button class="button3">Forgot Password</button>
</form>


<style>
      #textPassword {
        border: none; /* デフォルトの枠線を消す */
      }
      #fieldPassword{
        width: 200px;
      }
    </style>

<script>

  //選択画像の表示 変更後も画像の切り替え可能
  function previewFile(event){
    var fileData = new FileReader();
    fileData.onload = (function() {
      document.getElementById('preview').src = fileData.result;
    });
    fileData.readAsDataURL(event.files[0]);
  }
    </script>
</body>
</html>



