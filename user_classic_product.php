<?php
require __DIR__ . '/parts/__connect_db.php';
$pageName = 'user_classic_product';


$sqlcount = "SELECT COUNT(1) FROM classic_product";
$totalrows = $pdo->query($sqlcount)->fetch(PDO::FETCH_NUM)[0];

$pagenation = 6;
$tatlepage = ceil($totalrows / $pagenation);

$page= isset($_GET['page']) ? intval($_GET['page']):1;
if($page < 1){
    header('Location: user_classic_product.php');
    exit;
}

$sql = sprintf("SELECT * FROM classic_product LIMIT %s,%s" , ($page-1)*$pagenation, $pagenation);
if($page > $tatlepage){
    header('Location: user_classic_product.php?page='. $tatlepage);
    exit;
}

$rows = $pdo->query($sql)->fetchAll();


?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<style>
.classic_product .card-inside{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.cpimg{
    width: 250px;
    height: 250px;
    margin: auto;
    padding: 20px;
    display: flex;
}

.cpimg img{
    width: 100%;
    object-fit: cover;
}
.cp-card h6{
    color: #aaa;
    text-align: end;
}
</style>

<?php /* include __DIR__ . '/parts/__navbar__user.php' */ ?>
<div class="container my-4 classic_product">
    <div class="row">
    
        <div class="title my-4">
            <h2>經典產品</h2>
        </div>
        <!-- 分頁條 -->
        <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1==$page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>"><i class="fas fa-arrow-left"></i></a>
                    </li>
                    
                    <?php for($i=$page-2;$i<=$page+2;$i++) if($i>=1 && $i<=$tatlepage): ; ?>
                    <li class="page-item <?= $i==$page ? 'active' : '' ?>"><a class="page-link" href="?page=<?=$i ?>"><?=$i ?></a></li>
                    <?php endif; ?>

                    <li class="page-item <?= $tatlepage==$page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>"><i class="fas fa-arrow-right"></i></a>
                    </li>

                </ul>
            </nav>

        <!-- 產品卡片 -->
        <?php foreach ($rows as $classic_product_card) : ?>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card m-2 cp-card" style="width: 18rem;">
            
                <div class="cpimg" style="transform: rotate(0);">
                    <a href="./user_classic_product_detailed.php?c_product_id=<?= $classic_product_card['c_product_id'] ?>" class="stretched-link"></a>
                    <img <?= 'src="./uploaded/img_classic_product/c_product_img_path/'.$classic_product_card['c_product_img_path'].'"' ?> class="card-img-top" alt="">
                </div>
                <div class="card-body card-inside ">
                    <h5 class="card-title col-8"><?= $classic_product_card['c_product_name'] ?></h5><h6 class="col-4 "><?= $classic_product_card['c_product_value'] ?> 元</h6>
                    <div class="container card-inside mt-3">
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <div class="pid" hidden><?=$classic_product_card['c_product_id']?></div>
                            <div class="value" hidden><?=$classic_product_card['c_product_value']?></div>
                            <div class="cat" hidden><?=$classic_product_card['c_product_category']?></div>
                            <!-- -- -->
                            <button type="button" class="btn btn-outline-dark btn-dark" onclick="inqtyMi(event)"><i class="fas fa-minus text-light"></i></button>
                            <!-- 數量 -->
                            <input type="text" class="form-control qty" value="1" oninput = "value=value.replace(/[^\d]/g,'')" style="text-align: center;"></input>
                            <!-- ++ -->
                            <button type="button" class="btn btn-outline-dark btn-dark" onclick="inqtyPl(event)"><i class="fas fa-plus text-light"></i></button>
                        </div>

                        <button class="btn btn-dark my-3" onclick="sendData(event)">加入購物車</button>
                        
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach ?>
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
                alert('新增成功');
                Location.href='./user_classic_product.php';
            } else {
                alert(obj.error || '資料新增發生錯誤');
            }
        })
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>