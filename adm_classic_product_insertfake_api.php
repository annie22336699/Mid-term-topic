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


// 判斷有無折數??
    // if(['c_product_discount']!=='100'){
    //     $_POST['c_product_is_special_sale']=false;
    // }else{
    //     $_POST['c_product_is_special_sale']=true;
    // }

// 轉換??
    // switch($c_product_category){
    //     case '壽司':
    //         $_POST['c_product_category']='sh';
    //         break;
    //     case '甜點':
    //         $_POST['c_product_category']='dz';
    //         break;
    //     default:
    //         $_POST['c_product_category']='bx';
    // }    
    
    $sql="INSERT INTO `classic_product`(`c_product_img_path`, `c_product_name`, `c_product_category`, `c_product_description`, `c_product_value`, `c_product_discount`, `c_product_print_time`, `c_product_weight`, `c_product_calories`, `c_product_materials_id`, `c_product_recommend_pids`, `c_product_nutrition_img_path`, `c_product_nutrition_table_path`,`c_product_is_special_sale`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $pdo->beginTransaction();
    $stmt=$pdo->prepare($sql);
    for($i=1;$i<3;$i++){
        $stmt->execute([
            str_shuffle('12345sajdn').'.jpg',
            '壽司'.$i,
            'sh',
            '產品詳細'.$i,
            $i.'00',
            '80',
            $i.'0',
            $i.'00',
            '1'.$i.'0',
            '1,2,'.$i,
            '1,2,'.$i,
            str_shuffle('12345sajdn').'.jpg',
            str_shuffle('12345sajdn').'.jpg',
            $c_product_is_special_sale,

    ]);   // 發送
};

$pdo->commit();
echo 'ok';
?>