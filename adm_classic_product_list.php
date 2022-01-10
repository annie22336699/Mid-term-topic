<?php
require __DIR__ . '/parts/__connect_db.php';
$title = '經典產品';
$pageName = 'adm_classic_product_list';


$sqlcount = "SELECT COUNT(1) FROM classic_product";
$totalrows = $pdo->query($sqlcount)->fetch(PDO::FETCH_NUM)[0];

$pagenation = 5;
$tatlepage = ceil($totalrows / $pagenation);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: adm_classic_product_list.php');
    exit;
}

$sql = sprintf("SELECT * FROM classic_product LIMIT %s,%s", ($page - 1) * $pagenation, $pagenation);
if ($page > $tatlepage) {
    header('Location: adm_classic_product_list.php?page=' . $tatlepage);
    exit;
}

$rows = $pdo->query($sql)->fetchAll();

$changeCategory=[
    'sh'=>'壽司',
    'dz'=>'甜點',
    'bx'=>'禮盒',
];

?>

<?php include __DIR__ . './parts/__html_head.php' ?>
<style>
    .cmsCpimg {
        width: 70px;
        height: 70px;
        display: flex;
        margin: auto;
        object-fit: cover;
    }
    .upper{
        display: flex;
        justify-content: space-between;
        margin: 25px 0px 10px;
        align-items: baseline;
        align-content: center;
    }
</style>


<?php include __DIR__ . '/parts/__navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col">
        <div class="title my-4">
            <h2>經典產品</h2>
        </div>
            <div class="upper">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-arrow-left"></i></a>
                        </li>
    
                        <?php for ($i = $page - 2; $i <= $page + 2; $i++) if ($i >= 1 && $i <= $tatlepage) :; ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endif; ?>
    
                        <li class="page-item <?= $tatlepage == $page ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-arrow-right"></i></a>
                        </li>
                    </ul>
                </nav>

                <a href="./adm_classic_product_insert.php"><button type="button" class="btn btn-dark">新增產品</button></a>
            </div>

            <table class="table table-hover table-light">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">產品圖片</th>
                        <th scope="col">產品名稱</th>
                        <th scope="col">單價</th>
                        <th scope="col">類別</th>
                        <th scope="col">印製時間</th>
                        <th scope="col">產品敘述</th>
                        <th scope="col"><i class="far fa-trash-alt"></i></th>
                        <th scope="col"><i class="far fa-edit"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $classic_product) : ?>
                        <tr>
                            <td><img src="<?= ($classic_product['c_product_img_path']!=='')?'./uploaded/img_classic_product/c_product_img_path/'.$classic_product['c_product_img_path']:'' ?>" alt="" class="cmsCpimg <?= $classic_product['c_product_name'] ?>"> </td>
                            <td class="del_name"><?= $classic_product['c_product_name'] ?></td>
                            <td><?= $classic_product['c_product_value'] ?></td>
                            <td><?= $changeCategory[$classic_product['c_product_category']] ?></td>
                            <td><?= $classic_product['c_product_print_time'] ?></td>

                            <td><?= $classic_product['c_product_description'] ?></td>
                            <td>
                                <a href="javascript: delete_data(<?= "'".$classic_product['c_product_name'] ."'" ?>,<?= $classic_product['c_product_id'] ?>)"><i class="far fa-trash-alt"></i></a>
                            </td>
                            <td><a href="adm_classic_product_edit.php?c_product_id=<?= $classic_product['c_product_id'] ?>"><i class="far fa-edit"></i></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    function delete_data(c_product_name,c_product_id) {
        // 待修改ID為產品名稱
        if(confirm(`請問確認需要刪除產品「${c_product_name}」嗎？`)){
            location.href=`./adm_classic_product_delete_api.php?c_product_id=${c_product_id}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>