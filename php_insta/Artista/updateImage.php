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

$targetDirectory = '../images/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDirectory . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$imageId = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $arrImageTypes)) {
        $sql = "SELECT file_name FROM Artista_table WHERE id = " . $imageId;

        $sth = $pdo->prepare($sql);
        $sth->execute();
        $getImageName = $sth->fetch();

        $deleteImage = unlink($targetDirectory . $getImageName['file_name']);

        if ($deleteImage) {
            $uploadImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

            if($uploadImageForServer) {
                $update = $pdo->query("UPDATE Artista_table SET file_name = '" . $fileName . "' WHERE id = " . $imageId);

                header('Location: ' . 'insta_top', true, 303);
                exit();
            }
        }
    }
}