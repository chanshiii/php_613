<?php

session_start();
$post_id = $_GET['id'];
var_dump($post_id);
include("funcs.php");

//3．データ登録SQL作成
$pdo = db_conn();
$sql ="SELECT * FROM Artista_table WHERE id=id AND user_id=user_id AND file_name=file_name" ;
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//4 データ表示
$value = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$img = $stmt ->fetchAll(); //一人分の取り出し
// var_dump($id);
// var_dump($data)
// echo $data['image']['file_name'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <script src="https://kit.fontawesome.com/746d05bb69.js" crossorigin="anonymous"></script>
  <title>画像投稿アプリ</title>
</head>
<body>
  <?php include('./getDatas.php') ?>
  <?php include('./header.php') ?>
  <div class="detailImageBox">
    <div class="detailImage">
      <img src="../images/<?php echo $post_id; ?>" alt="投稿画像">
      <div class="detailImagButton">
        <button class="updateButton" onclick="location.href='./updateImage.php?id=<?php echo $_GET['id']; ?>';">更新</button>
        <button class="deleteButton" onclick="location.href='./deleteImage.php?id=<?php echo $_GET['id']; ?>';">削除</button>
      </div>
      <button onclick="location.href='./insta_top.php';">戻る</button>
    </div>
    <div class="comment">
      <p class="commentTitle">コメント</p>
      <ul>
        <?php for($i=0; $i < $countComment; $i++) { ?>
          <li><?php echo $data['comments'][$i]['comment']; ?></li>
        <?php } ?>
      </ul>
      <div class="submitComment">
        <form action="./postComment.php?image_id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
          <textarea name="comment" id="comment" cols="40" rows="10"></textarea>
          <button type="submit" name="submit">送信</button>
        </form>
      </div>
  </div>
</div>

<!-- いいね❤️機能 -->
<!-- <i class="fa-solid fa-heart"></i> -->
<div class="btn-good"><i class="fa-solid fa-heart fa-spin"></i></div>

<script>
    $(function(){
    var $good = $('.btn-good'), //いいねボタンセレクタ
                goodPostId; //投稿ID
    $good.on('click',function(e){
        e.stopPropagation();
        var $this = $(this);
        //カスタム属性（postid）に格納された投稿ID取得
        goodPostId = $this.parents('.post').data('postid'); 
        $.ajax({
            type: 'POST',
            url: 'ajaxGood.php', //post送信を受けとるphpファイル
            data: { postId: goodPostId} //{キー:投稿ID}
        }).done(function(data){
            console.log('Ajax Success');

            // いいねの総数を表示
            $this.children('span').html(data);
            // いいね取り消しのスタイル
            $this.children('i').toggleClass('far'); //空洞ハート
            // いいね押した時のスタイル
            $this.children('i').toggleClass('fas'); //塗りつぶしハート
            $this.children('i').toggleClass('active');
            $this.toggleClass('active');
        }).fail(function(msg) {
            console.log('Ajax Error');
        });
    });
});

  </script>
</body>
</html>