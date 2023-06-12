<?php

$uri = $_SERVER['REQUEST_URI']; //現在のURlを取得することができる

if (strpos($uri, 'imageDetail.php') !== false) {
    $imageId = $_SESSION['user_id'];
    $sql = "SELECT * FROM Artista_table WHERE user_id = " . $imageId;

    $sth = $pdo->prepare($sql);
    $sth->execute();
    $data['image'] = $sth->fetch();
    
    $sql2 = "SELECT * FROM comments WHERE image_id = " . $imageId . " ORDER BY create_date DESC";

    $sth = $pdo->prepare($sql2);
    $sth->execute();
    $data['comments'] = $sth->fetchAll();
    $countComment = count($data['comments']);   
} else {
    // insta_top.phpでログインしている方の投稿のみを表示するために、WHEREでuser_idを選択し、SESSIONでuser_id情報を受け取る。
    $sql = "SELECT * FROM Artista_table WHERE user_id = " . $_SESSION['user_id'] . " ORDER BY create_date DESC";

    $sth = $pdo->prepare($sql);
    $sth->execute();
    $data = $sth->fetchAll();

    return $data;
}

?>