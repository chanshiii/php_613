<?php

session_start();
$user_id= $_SESSION['user_id'];

include('./dbConfig.php');

$targetDirectory = '../images/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDirectory . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $arrImageTypes)) {
        $postImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

        if ($postImageForServer) {
            $insert = $pdo->query("INSERT INTO Artista_table(user_id,file_name,create_date) VALUES ('user_id','file_name',sysdate() )");
        }
    }
}

header('Location: ' . 'insta_top.php', true, 303);
exit();

?>