<?php 
require __DIR__.'/parts/__connect_db.php';

if(! isset($_GET['c_product_id'])){
    header('Location: adm_classic_product_list.php');
    exit;
};

if(isset($_GET['c_product_id'])){
    $sid=intval($_GET['c_product_id']);
    $pdo->query("DELETE FROM `classic_product` WHERE c_product_id=$sid");
};

$come_from=$_SERVER['HTTP_REFERER']??'adm_classic_product_list.php';
header("Location: $come_from");
?>