<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DBConnection
function db_conn(){
    try {
        $db_name = '2ch';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = '';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト

        //localhostでなかればさくらに接続する
        if($_SERVER["HTTP_HOST"] != 'localhost'){
            $db_name = '';    //データベース名
            $db_id   = '';      //アカウント名
            $db_pw   = '';      //パスワード：XAMPPはパスワード無しに修正してください。
            $db_host = ''; //DBホスト
            }

        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
    
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($page){
    header("Location: " .$page);
    exit();
}

//SessionCheck(スケルトン)
function sschk(){
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
      exit("Login Error");
   }else{
      session_regenerate_id(true);
      $_SESSION["chk_ssid"] = session_id();
   }
  }


  //fileUpload("送信名","アップロード先フォルダ");
// function fileUpload($fname,$path){
//     if (isset($_FILES[$fname] ) && $_FILES[$fname]["error"] ==0 ) {
//         //ファイル名取得
//         $file_name = $_FILES[$fname]["name"];
//         //一時保存場所取得 /home/tmt/1.jpg
//         $tmp_path  = $_FILES[$fname]["tmp_name"];
//         //拡張子取得 "jpeg" "png"
//         $extension = pathinfo($file_name, PATHINFO_EXTENSION);
//         //ユニークファイル名作成 md5(idのハッシュ化,一時的に暗号化するのに適した固定のハッシュ値)
//         $file_name = date("YmdHis").md5(session_id()) . "." . $extension;
//         // FileUpload [--Start--]
//         $file_dir_path = $path.$file_name;  //"upload/....jpeg"
//         // 以下から移動させる処理
//         if ( is_uploaded_file( $tmp_path ) ) {  //tmp_pathにあれば
//             if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) { //一時保存先の$tmp_pathから$file_dir_pathに移動
//                 chmod( $file_dir_path, 0644 ); //0644は読み込み宣言
//                 return $file_name; //成功時：ファイル名を返す 新しいファイル名で返す
//             } else {
//                 return 1; //失敗時：ファイル移動に失敗
//             }
//         }
//      }else{
//          return 2; //失敗時：ファイル取得エラー
//      }
// }
  

?>