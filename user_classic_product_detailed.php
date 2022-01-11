<?php
require __DIR__ . '/parts/__connect_db.php';
$pageName = 'user_classic_product_detailed';


$c_product_id = intval($_GET['c_product_id']);
$row = $pdo->query("SELECT * FROM `classic_product` WHERE c_product_id=$c_product_id")->fetch();

if (empty($row)) {
    header('location:./user_classic_product.php');
}

?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<style>
    .leftImg img{
        width: 100%;
        object-fit: cover;
    };
    .six-path{
        width: 50%;
        align-items: center;
        justify-content: center; 
    }
    .six-path img{
        width: 100%;
        object-fit: contain;
    };

</style>

<?php include __DIR__ . '/parts/__navbar__user.php' ?>
<div class="container mt-5">
        <div class="row">
            <!-- 圖區 -->
            <div class="leftImg col-lg-7">
                <img <?= 'src="./uploaded/img_classic_product/c_product_img_path/'.$row['c_product_img_path'].'"' ?> alt="">
            </div>

            <!-- 詳細頁 -->
            <div class="rightDet col-lg-5">
                <h3 class="my-3"><?= $row['c_product_name'] ?></h3>
                <h5 class="my-3"><?= $row['c_product_description'] ?></h5>
                <!-- 分析圖片 -->
                <div class="six-patharea">
                    <div class="row">
                        <div class="six-path col-6">
                            <h6>營養成分六角分析</h6>
                            <img src="<?= ($row['c_product_nutrition_img_path']!=='') ? './uploaded/img_classic_product/c_product_nutrition_img_path/'.$row['c_product_nutrition_img_path']:'' ?>" alt="">
                        </div>
                        <div class="six-path col-6">
                            <h6>營養成分表圖</h6>
                            <img src="<?= ($row['c_product_nutrition_table_path'] !=='') ? './uploaded/img_classic_product/c_product_nutrition_table_path/'.$row['c_product_nutrition_table_path'] :'' ?>" alt="">
                        </div>
                    </div>
                </div>

            <div class="container card-inside mt-3">
                <div class="row justify-content-between">
                    <div class="btn-group col-6 my-3" role="group" aria-label="Basic outlined example">
                        <div class="pid" hidden><?=$row['c_product_id']?></div>
                        <div class="value" hidden><?=$row['c_product_value']?></div>
                        <div class="cat" hidden><?=$row['c_product_category']?></div>
                        <!-- -- -->
                        <button type="button" class="btn btn-outline-dark btn-dark" onclick="inqtyMi(event)"><i class="fas fa-minus text-light"></i></button>
                        <!-- 數量 -->
                        <input type="text" class="form-control qty" value="1" oninput = "value=value.replace(/[^\d]/g,'')" style="text-align: center;"></input>
                        <!-- ++ -->
                        <button type="button" class="btn btn-outline-dark btn-dark" onclick="inqtyPl(event)"><i class="fas fa-plus text-light"></i></button>
                    </div>
    
                    <button class="btn btn-dark btn-dark col-3 my-3" onclick="sendData(event)">加入購物車</button>
                    <a href="<?= $_SERVER['HTTP_REFERER']??'list.php'; ?>" class="col-3 my-3"><button class="btn btn-dark btn-dark ">返回</button></a>
                </div>
            </div>
        </div>
        </div>
    </div>
<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>

    // 數量++
    function inqtyPl(event){
    // console.log(event.currentTarget);
    const qty=event.currentTarget.parentNode.querySelector('.qty').value;
    // console.log(qty);
    event.currentTarget.parentNode.querySelector('.qty').value=+ qty+1;
    };

    // 數量--
    function inqtyMi(event){
    const qty=event.currentTarget.parentNode.querySelector('.qty').value;
    if(qty>0){
        event.currentTarget.parentNode.querySelector('.qty').value=+ qty-1;
    }
    };

    // 加入購物車
    function sendData(event) {

        <?php
        if (!isset($_SESSION['user'])) {
            echo "alert('您尚未登入，請登入帳號');";
            echo "window.location = './user_login.php';";
        }
        ?>
        
        let fd = new FormData(); 
        let pid= event.currentTarget.parentNode.querySelector('.pid').innerHTML;
        let amount = event.currentTarget.parentNode.querySelector('.qty').value;
        let value = event.currentTarget.parentNode.querySelector('.value').innerHTML;
        let category = event.currentTarget.parentNode.querySelector('.cat').innerHTML;

        if(amount == 0 || amount == ''){
            console.log('數量不能為空或0');
            return false;
        }

        fd.append('pid', pid);
        fd.append('amount', amount);
        fd.append('value', value);
        fd.append('category', category);

        fetch('user_orders_insert_api.php', {                
            method: 'POST',            
            body: fd,
        }).then(r => r.json())
        .then(obj => {
            console.log('obj', obj); 
            if (obj.success) {
                location.reload();
                alert('新增成功');
            } else {
                alert(obj.error || '資料新增發生錯誤');
            }
        })
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>