<?php
require __DIR__ . '/parts/__connect_db.php';
$pageName = 'user_index';


$sqlcount = "SELECT COUNT(1) FROM classic_product";
$totalrows = $pdo->query($sqlcount)->fetch(PDO::FETCH_NUM)[0];

$pagenation = 8;
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
    /* align-items: center; */
}

.cpimg img{
    width: 100%;
    object-fit: cover;
}
</style>

<?php include __DIR__ . '/parts/__navbar.php' ?>
<div class="container my-4 classic_product">
    <div class="row">
        <div class="title my-4">
            <h2>經典產品</h2>
        </div>

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


        <?php foreach ($rows as $classic_product_card) : ?>
        <div class="card m-2" style="width: 18rem;">
            <div class="cpimg">
                <img <?= 'src="'.$classic_product_card['c_product_img_path'].'"' ?> class="card-img-top" alt="">
            </div>
            <div class="card-body card-inside">
                <h5 class="card-title"><?= $classic_product_card['c_product_name'] ?></h5>
                <div class="container card-inside mt-3">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <!-- -- -->
                        <button type="button" class="btn btn-outline-primary" onclick="inqtyMi(event)"><i class="fas fa-minus"></i></button>
                        <!-- 數量 -->
                        <input type="text" class="form-control qty" value="1" onkeypress="return isNumberKey(event)"></input>
                        <!-- ++ -->
                        <button type="button" class="btn btn-outline-primary" onclick="inqtyPl(event)"><i class="fas fa-plus"></i></button>
                    </div>

                    <a href="#" class="btn btn-primary my-3 ">加入購物車</a>

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

    // 輸入數量判斷正確性
    function isNumberKey(event){
    const charCode= event.which;
    return !(charCode>31 && (charCode<48 || charCode>57));
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>