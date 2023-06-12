<!-- header.phpで記載したユーザー画像を表示するため(セッションで渡したものを受け取るために以下を宣言) include()でheader.phpを読み込み-->
<?php
session_start();

$user_id = $_SESSION["user_id"]; //SESSIONでだれがログインしているか識別するためにuser_idをセッションする。
echo $user_id; //確認用
// セッション変数が正しく設定されているか確認する
// if (isset($_SESSION['user_id'])) {
//   $user_id = $_SESSION['user_id'];
//   echo "セッション変数 user_id は正しく設定されています。値: " . $user_id;
// } else {
//   echo "セッション変数 user_id は設定されていません。";
// }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>画像投稿アプリ</title>
</head>
<body>
  <?php include('./header.php') ?>
  <!-- <div class="submitImage"> -->
    <form action="./postImageForm_insert.php" method="post" >
      <!-- inputでセッションで識別している、今ログインしている人user_idを送る phpなので以下のような記述になる。 -->
      <input type="text" name="user_id" value="<?=$user_id?>" style= "display:none;">
      <img id="preview">
      <input type="file" name="file_name" onchange="previewFile(this);">
      <button type="submit" name="submit">送信</button>
    </form>
    <button onclick="location.href='./insta_top.php';" class="backButton">戻る</button>
    <!-- < ?php if(isset($_GET['user_id'])) { ?>
      <form action="./updateImage.php?id=< ?php echo($_GET['user_id']); ?>" method="post" enctype="multipart/form-data">
    < ?php } else { ?>
      <form action="./postImage.php" method="post" enctype="multipart/form-data">
    < ?php } ?>
        <img id="preview">
        <input type="file" name="file" onchange="previewFile(this);">
        <button type="submit" name="submit">送信</button>
    </form>
    <button onclick="location.href='./insta_top.php';" class="backButton">戻る</button>
  </div> -->
</body>
</html>

<script>
  function previewFile(event){
    var fileData = new FileReader();
    fileData.onload = (function() {
      document.getElementById('preview').src = fileData.result;
    });
    fileData.readAsDataURL(event.files[0]);
  }
  </script>
