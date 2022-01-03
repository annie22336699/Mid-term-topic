<?php
require __DIR__ . '/parts/__connect_db.php';
$title = '經典產品';
$pageName = 'adm_classic_product_list.php';


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

?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<style>
    .cmsCpimg {
        width: 70px;
        height: 70px;
        display: flex;
        margin: auto;
        object-fit: cover;
    }
</style>


<?php include __DIR__ . '/parts/__navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col">
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

            <button type="button" class="btn btn-primary">新增產品</button>

            <table class="table table-hover table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">產品圖片</th>
                        <th scope="col">產品名稱</th>
                        <th scope="col">單價</th>
                        <th scope="col">類別</th>
                        <th scope="col">印製時間</th>
                        <th scope="col">印製時間</th>
                        <th scope="col"><i class="far fa-trash-alt"></i></th>
                        <th scope="col"><i class="far fa-edit"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $classic_product) : ?>
                        <tr>
                            <td><img <?= 'src="' . $classic_product['c_product_img_path'] . '"' ?> alt="" class="cmsCpimg"> </td>
                            <td><?= $classic_product['c_product_name'] ?></td>
                            <td><?= $classic_product['c_product_value'] ?></td>
                            <td><?= $classic_product['c_product_category'] ?></td>
                            <td><?= $classic_product['c_product_print_time'] ?></td>

                            <td><?= $classic_product['address'] ?></td>
                            <td>
                                <a href="javascript: delete_data(<?= $classic_product['sid'] ?>)"><i class="far fa-trash-alt"></i></a>
                            </td>
                            <td><a href="edit.php?sid=<?= $classic_product['sid'] ?>"><i class="far fa-edit"></i></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/__scripts.php' ?>
<?php include __DIR__ . '/parts/__html_foot.php' ?>