<?php

include('./dbConfig.php');

$targetDirectory = '../images/';
$imageId = $_GET['id'];

if(!empty($imageId)) {
    $sql = "SELECT file_name FROM Artista_table WHERE id = " . $imageId;

    $sth = $pdo->prepare($sql);
    $sth->execute();
    $getImageName = $sth->fetch();

    $deleteImage = unlink($targetDirectory . $getImageName['file_name']);

    if($deleteImage) {
        $deleteRecord = $pdo->query("DELETE FROM Artista_table WHERE id = " . $imageId);

        if($deleteRecord) {
            header('Location:' . 'insta_top.php', true, 303);
            exit();
        }
    }
}
?>