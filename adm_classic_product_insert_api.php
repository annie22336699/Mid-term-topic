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

// 檢查欄位資料
    if(empty($c_product_name)){
        $output['code']= 401;
        $output['error']='請輸入正確的產品名稱';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    };

// 判斷有無折數??
    if(['c_product_discount']=='100'){
        $_POST['c_product_is_special_sale']=false;
    }else{
        $_POST['c_product_is_special_sale']=true;
    }

// 類別轉換文字??
    switch($_POST['c_product_category']){
        case '壽司':
            echo 'sh';
            break;
        case '甜點':
            echo 'dz';
            break;
        default:
            echo 'bx';
    }

$sql="INSERT INTO `classic_product`(`c_product_img_path`, `c_product_name`, `c_product_category`, `c_product_description`, `c_product_value`, `c_product_discount`, `c_product_print_time`, `c_product_weight`, `c_product_calories`, `c_product_materials_id`, `c_product_recommend_pids`, `c_product_nutrition_img_path`, `c_product_nutrition_table_path`,`c_product_is_special_sale`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


$stmt=$pdo->prepare($sql);
$stmt->execute([
    $_POST['c_product_img_path']??'',
    $c_product_name,
    $c_product_category,
    $_POST['c_product_description']??'',
    $_POST['c_product_value']??'',
    $_POST['c_product_discount']??'',
    $_POST['c_product_print_time']??'',
    $_POST['c_product_weight']??'',
    $_POST['c_product_calories']??'',
    $_POST['c_product_materials_id']??'',
    $_POST['c_product_recommend_pids']??'',
    $_POST['c_product_nutrition_img_path']??'',
    $_POST['c_product_nutrition_table_path']??'',
    $c_product_is_special_sale,
]);   // 發送


$output['success'] = $stmt->rowCount()==1;
$output['rowCount']=$stmt->rowCount();

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>