<?php 
require __DIR__.'./parts/__connect_db.php';
$title = '經典產品上架頁';
$pageName = 'classic_product_insert';
?>

<?php include __DIR__.'./parts/__html_head.php' ?>
<style>
      .cp-form-area {
        margin: 30px auto;
      }
      /* .cp-form-img {
        display: flex;
        align-items: center;
      } */
      .cp-form-area img {
        width: 100%;
        object-fit: cover;
      }
      .upper{
        display: flex;
        justify-content: space-between;
        margin: 25px 0px 10px;
        align-items: baseline;
        align-content: center;
      }
      .save{
        display: flex;
        justify-content: flex-end;
      }
      .save button{
        margin: 0px 5px;
      }
      .form-text{
        color: red;
      }
</style>

<?php include __DIR__.'/parts/__navbar.php' ?>

<div class="container my-4 classic_product">
    <div class="row">
      <div class="title my-4 upper">
        <h2>經典產品</h2>
      </div>
    </div>
    <!-- 主區 -->
  <form name="forminsert" onsubmit="sendData(); return false;">
      <div class="container cp-form-area">
        <div class="row flex-lg-nowrap">
          <!-- 產品圖 -->
          <div class="cp-form-img mb-3 col-sm-12 col-lg-3 flex-lg-wrap">
            <img class="mb-3" src="" id="cpnDimg" />  
            <label for="formFile" class="form-label" >產品圖片</label>
            <div name="uploading" runat="server">
              <input class="form-control" accept="image/*" type="file" id="uplimg" name="cp-pd-img"/>
            </div>
          </div>
  
          <div class="row flex-md-nowrap flex-sm-wrap col-sm-12 col-md-6 col-lg-4 ">
            <!-- 名稱類別 -->
            <div class="cp-form-np mb-3 ">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >產品名稱</label
                >
                <input type="text" class="form-control" placeholder="" name="c_product_name"/>
                <div class="form-text"></div>
              </div>
              <div class="mb-3">
                <label for="exampleDataList" class="form-label">產品類別</label>
                <select class="form-select" aria-label="Default select example" name="c_product_category">
                  <option selected>請選擇類別</option>
                  <option value="sh">壽司</option>
                  <option value="dz">甜點</option>
                  <option value="bx">禮盒</option>
                </select>
                <div class="form-text"></div>
              </div>
            </div>
  
            <!-- 產品敘述 -->
            <div class="cp-form-na mb-3">
              <label for="exampleFormControlTextarea1" class="form-label mb-3"
                >產品敘述</label
              >
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="c_product_description"></textarea>
              <div class="form-text"></div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="container">
        <div class="row col-lg-9 ms-md-auto">
          <!-- 詳細 -->
          <div class="container cp-form-area">
            <div class="row">
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="exampleFormControlInput1" class="form-label">單價</label>
                <input type="text" class="form-control" placeholder="" name="c_product_value"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="exampleFormControlInput1" class="form-label">折數</label>
                <input type="text" class="form-control" placeholder="" name="c_product_discount"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="exampleFormControlInput1" class="form-label">印製時間</label>
                <input type="text" class="form-control" placeholder="" name="c_product_print_time"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="exampleFormControlInput1" class="form-label">產品重量</label>
                <input type="text" class="form-control" placeholder="" name="c_product_weight"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="exampleFormControlInput1" class="form-label">產品卡路里</label>
                <input type="text" class="form-control" placeholder="" name="c_product_calories"/>
                <div class="form-text"></div>
              </div>
            </div>
          </div>
  
          <!-- 產品ID區 -->
          <div class="container cp-form-area">
            <div class="row">
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="exampleFormControlInput1" class="form-label"
                  >使用食材ID</label
                >
                <input
                  type="text"
                  class="form-control"
                  placeholder="請用,分隔ID"
                />
              </div>
  
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="exampleFormControlInput1" class="form-label"
                  >推薦產品ID</label
                >
                <input
                  type="text"
                  class="form-control"
                  placeholder="請用,分隔ID"
                />
              </div>
            </div>
          </div>
  
          <!-- 圖片上傳 -->
          <div class="container cp-form-area">
            <div class="row">
              <div class="mb-3 col-md-6 col-sm-12" runat="server">
                <label for="formFile" class="form-label"
                  >營養成分六角分析圖</label
                >
                <input class="form-control" accept="image/*" type="file" id="formFile1" />
                <br />
                <img src="" id="cpnImg" />
              </div>
  
              <div class="mb-3 col-md-6 col-sm-12" runat="server">
                <label for="formFile" class="form-label">營養成分表圖</label>
                <input class="form-control" type="file" accept="image/*" id="formFile2" />
                <br />
                <img src="" id="cpntableImg" />
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="save my-4">
        <a href="./adm_classic_product_list.php"><button type="button" class="btn btn-dark">取消</button></a>
        <button type="submit" class="btn btn-dark">新增</button>
      </div>
  </form>

<?php include __DIR__.'/parts/__scripts.php' ?>
<script>

// 產品圖片預覽
  uplimg.onchange=e=>{
    const [file]=uplimg.files;
    if(file){
      cpnDimg.src=URL.createObjectURL(file);
    }
  }
// 六角分析圖預覽
  formFile1.onchange=e=>{
    const [file]=formFile1.files;
    if(file){
      cpnImg.src=URL.createObjectURL(file);
    }
  }
// 營養成分表圖預覽
  formFile2.onchange=e=>{
    const [file]=formFile2.files;
    if(file){
      cpntableImg.src=URL.createObjectURL(file);
    }
  }


// 輸出
  const c_product_name=document.querySelector('#c_product_name');
  const c_product_category=document.querySelector('#c_product_category');
  const c_product_description=document.querySelector('#c_product_description');
  const c_product_value=document.querySelector('#c_product_value');
  const c_product_discount=document.querySelector('#c_product_discount');
  const c_product_print_time=document.querySelector('#c_product_print_time');
  const c_product_weight=document.querySelector('#c_product_weight');
  const c_product_calories=document.querySelector('#c_product_calories');


  function sendData(){
    c_product_name.nextElementSibling.innerHTML='';
    c_product_category.nextElementSibling.innerHTML='';
    c_product_description.nextElementSibling.innerHTML='';
    c_product_value.nextElementSibling.innerHTML='';
    c_product_discount.nextElementSibling.innerHTML='';
    c_product_print_time.nextElementSibling.innerHTML='';
    c_product_weight.nextElementSibling.innerHTML='';
    c_product_calories.nextElementSibling.innerHTML='';

    let isPass=true;

    if(c_product_name.value.length<2){
      isPass=false;
      c_product_name.nextElementSibling.innerHTML='請輸入產品名稱';
    }
    if(c_product_category.value==='請選擇類別'){
      isPass=false;
      name.nextElementSibling.innerHTML='請選擇類別';
    }

    if(isPass){
      const fd = new FormData(document.forminsert);

      fetch('./adm_classic_product_insert_api.php',{
        method:'POST',
        body: fd,
      }).then(rt=>rt.json())
      .then(obj=>{
        console.log(obj);
        if(obj.success){
          alert('新增成功');
          location.href='./adm_classic_product_list.php'
        }else{
          alert(obj.error||'你輸入錯惹QQ');
        }
      });
    }

  };

</script>
<?php include __DIR__.'/parts/__html_foot.php' ?>