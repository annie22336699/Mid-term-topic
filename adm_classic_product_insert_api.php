<?php 
require __DIR__.'./parts/__connect_db.php';

$output=[
    'success' => false,
    'code' => 0,
    'error' => '',
];

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
    $extcpPdImg=$exts[$cpPdImg['type']];  // 附檔名
    if(! empty($extcpPdImg)){
        $filenamePdImg=sha1($cpPdImg['name']. rand());
        
        $targetcpPdImg=$upload_folderImg.$filenamePdImg.$extcpPdImg;
           if(move_uploaded_file($cpPdImg['tmp_name'],$targetcpPdImg)){
            $output['success']=true;
        }else{
            $output['error']='無法移動產品圖檔';
        }};

// 營養成分六角分析圖上傳
    $extcpNuImg=$exts[$cpNuImg['type']];  // 附檔名
    if(! empty($extcpNuImg)){
        $filenamecpNuImg=sha1($cpNuImg['name']. rand());
        
        $targetcpNuImg=$upload_folderNuImg.$filenamecpNuImg.$extcpNuImg;
           if(move_uploaded_file($cpNuImg['tmp_name'],$targetcpNuImg)){
            $output['success']=true;
        }else{
            $output['error']='無法移動營養成分六角分析圖';
        }};

// 營養成分表圖上傳
    $extcpNuTaImg=$exts[$cpNuTaImg['type']];  // 附檔名
    if(! empty($extcpNuTaImg)){
        $filenamecpNuTaImg=sha1($cpNuTaImg['name']. rand());
        
        $targetcpNuTaImg=$upload_folderNuTa.$filenamecpNuTaImg.$extcpNuTaImg;
           if(move_uploaded_file($cpNuTaImg['tmp_name'],$targetcpNuTaImg)){
            $output['success']=true;
        }else{
            $output['error']='無法移動營養成分表圖';
        }};


// 判斷有無折扣自動輸入值
    if( $c_product_discount == 100){
        $c_product_is_special_sale=0;
    }else{
        $c_product_is_special_sale=1;
    };


$sql="INSERT INTO `classic_product`(`c_product_img_path`, `c_product_name`, `c_product_category`, `c_product_description`, `c_product_value`, `c_product_discount`, `c_product_print_time`, `c_product_weight`, `c_product_calories`, `c_product_materials_id`, `c_product_recommend_pids`, `c_product_nutrition_img_path`, `c_product_nutrition_table_path`,`c_product_is_special_sale`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


$stmt=$pdo->prepare($sql);
$stmt->execute([
    $filenamePdImg.$extcpPdImg ??'',
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
    $filenamecpNuImg.$extcpNuImg ??'',
    $filenamecpNuTaImg.$extcpNuTaImg ??'',
    $c_product_is_special_sale,
]);   // 發送


$output['success'] = $stmt->rowCount()==1;
$output['rowCount']=$stmt->rowCount();

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>