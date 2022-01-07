<?php 
require __DIR__.'./parts/__connect_db.php';

$c_product_id=intval($_POST['c_product_id']);
$row=$pdo->query("SELECT * FROM `classic_product` WHERE c_product_id=$c_product_id")->fetch();

$output=[
    'success' => false,
    'code' => 0,
    'error' => '',
];
$c_product_id=isset($_POST['c_product_id'])?intval($_POST['c_product_id']):0;
if(empty($c_product_id)){
    $output['code']= 400;
    $output['error']='沒有該產品';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
};


$c_product_name=$_POST['c_product_name'] ?? '';
$c_product_category=$_POST['c_product_category'] ?? '';
$c_product_is_special_sale=$_POST['c_product_is_special_sale']?? '';
$c_product_discount=$_POST['c_product_discount']??'';

// 檢查欄位資料
    if(empty($c_product_name)){
        $output['code']= 401;
        $output['error']='請輸入正確的產品名稱';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    };

// 判斷可讀取的副檔名
    $exts = [
        'image/jpeg' => '.jpg',
        'image/png' => '.png',
        'image/gif' => '.gif',
    ];

// 上傳檔
    $cpPdImg = $_FILES['cpPdImg'] ?? '';
    $cpNuImg = $_FILES['cpNuImg'] ?? '';
    $cpNuTaImg = $_FILES['cpNuTaImg'] ?? '';

// 上傳至的圖片路徑
    $upload_folderImg = __DIR__ . './uploaded/img_classic_product/c_product_img_path/';
    $upload_folderNuImg = __DIR__ . './uploaded/img_classic_product/c_product_nutrition_img_path/';
    $upload_folderNuTa = __DIR__ . './uploaded/img_classic_product/c_product_nutrition_table_path/';

// 產品圖檔上傳
    $filenamePdImg=sha1($cpPdImg['name']. rand());
    $extcpPdImg=$exts[$cpPdImg['type']]??'';
            if(! empty($extcpPdImg)){        
                $targetcpPdImg=$upload_folderImg.$filenamePdImg.$extcpPdImg;
                if(move_uploaded_file($cpPdImg['tmp_name'],$targetcpPdImg)){
                $output['success']=true;
            }else{
                $output['error']='無法移動產品圖檔';
            }};
    
    // if($cpPdImg['size']!==0){
    //     $extcpPdImg=$exts[$cpPdImg['type']]??'';
    //         if(! empty($extcpPdImg)){        
    //             $targetcpPdImg=$upload_folderImg.$filenamePdImg.$extcpPdImg;
    //             if(move_uploaded_file($cpPdImg['tmp_name'],$targetcpPdImg)){
    //             $output['success']=true;
    //         }else{
    //             $output['error']='無法移動產品圖檔';
    //         }};
    // }else{
	//     $row['c_product_img_path'];
    // };

// 營養成分六角分析圖上傳
    $filenamecpNuImg=sha1($cpNuImg['name']. rand());
    $extcpNuImg=$exts[$cpNuImg['type']]??'';
        if(! empty($extcpNuImg)){
            $targetcpNuImg=$upload_folderNuImg.$filenamecpNuImg.$extcpNuImg;
            if(move_uploaded_file($cpNuImg['tmp_name'],$targetcpNuImg)){
                $output['success']=true;
            }else{
                $output['error']='無法移動營養成分六角分析圖';
            }};
    
    
    // if($cpNuImg['size']!==0){
    //     $extcpNuImg=$exts[$cpNuImg['type']]??'';
    //     if(! empty($extcpNuImg)){
    //         $targetcpNuImg=$upload_folderNuImg.$filenamecpNuImg.$extcpNuImg;
    //         if(move_uploaded_file($cpNuImg['tmp_name'],$targetcpNuImg)){
    //             $output['success']=true;
    //         }else{
    //             $output['error']='無法移動營養成分六角分析圖';
    //         }};
    // }else{
	//     $row['c_product_nutrition_img_path'];
    // };

// 營養成分表圖上傳
    $filenamecpNuTaImg=sha1($cpNuTaImg['name']. rand());
    $extcpNuTaImg=$exts[$cpNuTaImg['type']]??'';
    if(! empty($extcpNuTaImg)){
        $targetcpNuTaImg=$upload_folderNuTa.$filenamecpNuTaImg.$extcpNuTaImg;
       if(move_uploaded_file($cpNuTaImg['tmp_name'],$targetcpNuTaImg)){
            $output['success']=true;
        }else{
            $output['error']='無法移動營養成分表圖';
    }};

    // if($cpNuTaImg['size']!==0){
    //     $extcpNuTaImg=$exts[$cpNuTaImg['type']]??'';
    //     if(! empty($extcpNuTaImg)){
    //         $targetcpNuTaImg=$upload_folderNuTa.$filenamecpNuTaImg.$extcpNuTaImg;
    //        if(move_uploaded_file($cpNuTaImg['tmp_name'],$targetcpNuTaImg)){
    //             $output['success']=true;
    //         }else{
    //             $output['error']='無法移動營養成分表圖';
    //     }};
    // }else{
	//     $row['c_product_nutrition_table_path'];
    // };


// 判斷有無折扣自動輸入值
    if( $c_product_discount == 100){
        $c_product_is_special_sale=0;
    }else{
        $c_product_is_special_sale=1;
    };


$sql="UPDATE `classic_product` SET
    `c_product_img_path`=?,
    `c_product_name`=?,
    `c_product_category`=?, 
    `c_product_description`=?, 
    `c_product_value`=?, 
    `c_product_discount`=?, 
    `c_product_print_time`=?, 
    `c_product_weight`=?, 
    `c_product_calories`=?, 
    `c_product_materials_id`=?, 
    `c_product_recommend_pids`=?, 
    `c_product_nutrition_img_path`=?, 
    `c_product_nutrition_table_path`=?,
    `c_product_is_special_sale`=?
WHERE `c_product_id`=?";


$stmt=$pdo->prepare($sql);
$stmt->execute([
    ($cpNuImg['size']==0) ? $row['c_product_img_path']:$filenamePdImg.$extcpPdImg,
    $c_product_name,
    $c_product_category,
    $_POST['c_product_description']??'',
    $_POST['c_product_value']??'',
    $c_product_discount,
    $_POST['c_product_print_time']??'',
    $_POST['c_product_weight']??'',
    $_POST['c_product_calories']??'',
    $_POST['c_product_materials_id']??'',
    $_POST['c_product_recommend_pids']??'',
    ($cpNuImg['size']==0) ? $row['c_product_nutrition_img_path']:$filenamecpNuImg.$extcpNuImg,
    ($cpNuTaImg['size']==0) ? $row['c_product_nutrition_table_path']:$filenamecpNuTaImg.$extcpNuTaImg,
    $c_product_is_special_sale,
    $c_product_id,
]);   // 發送

if($stmt->rowCount()==0){
    $output['error'] ='您的資料未修改';
    header('Location: adm_classic_product_list.php?page='. $tatlepage);
}else{
    $output['success'] = true;
};

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>