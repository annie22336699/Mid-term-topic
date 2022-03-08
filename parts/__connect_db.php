<?php
$db_host = 'localhost';
$db_name = 'print_3d';
$db_user = 'root';
$db_pw = '';
// 設定需要跟phpMyAdmin內的config.inc.php一樣

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";
// $pdo=new PDO($dsn,$db_user,$db_pw);

// 以下除錯用

$db_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pw, $db_options);
} catch (PDOException $lalala) {
    echo '******* *******' . $lalala->getMessage();
}


// 在開頭先設定頁籤名稱為空
$title = '';
$pageName = '';


// 在內部先設定如果$_SESSION沒有開，則叫他開
if (!isset($_SESSION)) {
    session_start();
}
