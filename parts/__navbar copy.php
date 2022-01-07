<style>
  .navbar-light .navbar-nav .nav-link.active {
    color: white;
    background-color: #aaa;
    border-radius: 5px;
    
  };

</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="./adm_index.php">印食</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link  <?= $pageName=='list' ? 'active disabled' : '' ?>" aria-current="page" href="./user_classic_product.php">經典產品</a>
              </li>
            </ul>

<?php /*
            <ul class="navbar-nav mb-2 mb-lg-0">
              <?php if(isset($_SESSION['admin'])): ?>
                  <li class="nav-item">
                  <a class="nav-link"><?= $_SESSION['admin']['nickname'].'，歡迎' ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./?????????.php">登出</a>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link" href="./?????????.php">登入</a>
              <?php endif; ?>

              </li>
            </ul>
*/ ?>

          </div>
        </div>
      </nav>