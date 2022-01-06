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
  <form name="formDataAdd" onsubmit="sendData(); return false;">
      <div class="container cp-form-area">
        <div class="row flex-lg-nowrap">
          <!-- 產品圖 -->
          <div class="cp-form-img mb-3 col-sm-12 col-lg-3 flex-lg-wrap">
            <img class="mb-3" src="" id="cpnDimg" />  
            <label for="c_product_img_path" class="form-label" >產品圖片</label>
            <div name="c_product_img_path" runat="server">
              <input class="form-control" accept="image/*" type="file" id="uplimg" name="cpPdImg"/>
            </div>
          </div>
  
          <div class="row flex-md-nowrap flex-sm-wrap col-sm-12 col-md-6 col-lg-4 ">
            <!-- 名稱類別 -->
            <div class="cp-form-np mb-3 ">
              <div class="mb-3">
                <label for="c_product_name" class="form-label">產品名稱</label>
                <input type="text" class="form-control" placeholder="" id="c_product_name" name="c_product_name" required/>
                <div class="form-text"></div>
              </div>
              <div class="mb-3">
                <label for="c_product_category" class="form-label">產品類別</label>
                <select class="form-select" aria-label="Default select example" id="c_product_category" name="c_product_category">
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
              <label for="c_product_description" class="form-label mb-3">產品敘述</label>
              <textarea class="form-control" id="c_product_description" rows="4" id="c_product_description" name="c_product_description"></textarea>
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
                <label for="c_product_value" class="form-label">單價</label>
                <input type="text" class="form-control" placeholder="" id="c_product_value" name="c_product_value" oninput = "value=value.replace(/[^\d]/g,'')"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="c_product_discount" class="form-label">折數</label>
                <input type="text" class="form-control" placeholder="" id="c_product_discount" name="c_product_discount" oninput = "value=value.replace(/[^\d]/g,'')"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="c_product_print_time" class="form-label">印製時間</label>
                <input type="text" class="form-control" placeholder="" id="c_product_print_time" name="c_product_print_time" oninput = "value=value.replace(/[^\d]/g,'')"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="c_product_weight" class="form-label">產品重量</label>
                <input type="text" class="form-control" placeholder="" id="c_product_weight" name="c_product_weight" oninput = "value=value.replace(/[^\d]/g,'')"/>
                <div class="form-text"></div>
              </div>
  
              <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="c_product_calories" class="form-label">產品卡路里</label>
                <input type="text" class="form-control" placeholder="" id="c_product_calories" name="c_product_calories" oninput = "value=value.replace(/[^\d]/g,'')"/>
                <div class="form-text"></div>
              </div>
            </div>
          </div>
  
          <!-- 產品ID區 -->
          <div class="container cp-form-area">
            <div class="row">
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="c_product_materials_id" class="form-label">使用食材ID</label>
                <input type="text" class="form-control" placeholder="請用,分隔ID" id="c_product_materials_id" name="c_product_materials_id"/>
              </div>              
  
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="c_product_recommend_pids" class="form-label">推薦產品ID</label>
                <input type="text" class="form-control" placeholder="請用,分隔ID" id="c_product_recommend_pids" name="c_product_recommend_pids"/>
              </div>
            </div>
          </div>
  
          <!-- 圖片上傳 -->
          <div class="container cp-form-area">
            <div class="row">
              <div class="mb-3 col-md-6 col-sm-12" runat="server">
                <label for="c_product_nutrition_img_path" class="form-label" >營養成分六角分析圖</label>
                <input class="form-control" accept="image/*"  type="file" id="cpNuImg" name="cpNuImg"/>
                <br />
                <img src="" id="cpnImg" />
              </div>
  
              <div class="mb-3 col-md-6 col-sm-12" runat="server">
                <label for="c_product_nutrition_table_path" class="form-label">營養成分表圖</label>
                <input class="form-control" type="file" accept="image/*" id="cpNuTaImg" name="cpNuTaImg"/>
                <br />
                <img src="" id="cpntableImg" />
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="save my-4">
        <a href="<?= $come_from ?>"><button type="button" class="btn btn-dark">取消</button></a>
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
  cpNuImg.onchange=e=>{
    const [file]=cpNuImg.files;
    if(file){
      cpnImg.src=URL.createObjectURL(file);
    }
  }
// 營養成分表圖預覽
  cpNuTaImg.onchange=e=>{
    const [file]=cpNuTaImg.files;
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

  const value_rule= /^\d{9}$/ ;

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
      c_product_category.nextElementSibling.innerHTML='請選擇產品類別';
    }
    if(c_product_description.value.length<2){
      isPass=false;
      c_product_description.nextElementSibling.innerHTML='請輸入產品敘述';
    }
    if(!c_product_value.value && !value_rule.test(c_product_value.value)){
      isPass=false;
      c_product_value.nextElementSibling.innerHTML='請填寫金額';
    }
    if(c_product_discount.value>100){
      isPass=false;
      c_product_discount.nextElementSibling.innerHTML='請輸入正確折數';
    }
    if(!c_product_print_time.value && !value_rule.test(c_product_print_time.value)){
      isPass=false;
      c_product_print_time.nextElementSibling.innerHTML='請輸入印製時間';
    }
    if(!c_product_weight.value && !value_rule.test(c_product_weight.value)){
      isPass=false;
      c_product_weight.nextElementSibling.innerHTML='請輸入產品重量';
    }

    if(isPass){
      const fd = new FormData(document.formDataAdd);

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
          alert(obj.error||'新增資料錯誤');
        }
      });
    }

  };

</script>
<?php include __DIR__.'/parts/__html_foot.php' ?>