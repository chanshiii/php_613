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
  <div class="header">
    <!-- <button  class="postImage" onclick="location.href='./insta_top.php';">insta</button> -->
    <!-- hrefの前onclickが必要 -->
    <img src="./user_img/<?php echo $_SESSION['img']; ?>" alt="投稿画像" style="border-radius: 50%;">
    <button  class="postImage" onclick="location.href='user.php';">Sign Up</button>
    <button  class="postImage" onclick="location.href='logout.php';">Logout</button>
    <button  class="postImage" onclick="location.href='index.php';">HOME</button>
    <button class="postImage" onclick="location.href='./postImageForm.php';">投稿</button>
  </div>
</body>
</html>
