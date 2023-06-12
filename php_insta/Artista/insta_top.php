<?php

session_start();

include("funcs.php");
// $user_id = $_POST["user_id"];
// $file_name = $_POST["file_name"] ;
// echo $user_id;
// echo $file_name;

//3．データ登録SQL作成
$pdo = db_conn();
$sql ="SELECT * FROM Artista_table WHERE user_id=user_id AND file_name=file_name" ;
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//4 データ表示
$value = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$img = $stmt ->fetchAll(); //一人分の取り出し
// var_dump($img);
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
  <?php include('./getDatas.php') ?>
  <?php include('./header.php') ?>
  <div class="imageList">
    <!-- $dataはgetdatas.phpを参照 -->
    <?php foreach($data as $image) { ?>
        <a href="./imageDetail.php?id=<?php echo $image['file_name']; ?>"><img src="../images/<?php echo $image['file_name']; ?>" alt="投稿画像"></a>
<?php } ?>
</div>
</body>
</html>