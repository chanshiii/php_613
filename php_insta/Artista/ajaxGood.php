<?php
//1. DB接続します
session_start();
include ("funcs.php");
$pdo = db_conn();

//2．データ登録SQL作成

// $stmt = $pdo->prepare($sql);
// $stmt ->bindValue(":id", $id, PDO::PARAM_INT);
// $status = $stmt->execute();

//4．データ表示
// $values = "";
// if($status==false) {
//   sql_error($stmt);
// }

// postがある場合
if(isset($_POST['postId'])){
    $id = $_POST['postId'];

    try{
        // goodテーブルから投稿IDとユーザーIDが一致したレコードを取得するSQL文
        $sql = 'SELECT * FROM good WHERE id = :id AND user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id"      ,$id                ,PDO::PARAM_INT);
        $stmt->bindValue(":user_id",$_SESSION['user_id'],PDO::PARAM_INT);
        $status = $stmt->execute();
        // レコードが1件でもある場合
        if(!empty($resultCount)){
            // レコードを削除する
            $sql = 'DELETE FROM good WHERE id = :id AND user_id = :user_id';
            $$stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id"     ,$id                 ,PDO::PARAM_INT);
            $stmt->bindValue(":user_id",$_SESSION['user_id'],PDO::PARAM_INT);
            $status = $stmt->execute();
        }else{
            // レコードを挿入する
            $sql = 'INSERT INTO good (id, user_id) VALUES (:id, :user_id)';
            $$stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id"     ,$id                 ,PDO::PARAM_INT);
            $stmt->bindValue(":user_id",$_SESSION['user_id'],PDO::PARAM_INT);
            $status = $stmt->execute();
        }
    }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
    }
}
