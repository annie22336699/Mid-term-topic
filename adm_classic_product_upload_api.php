<?php

header('Content-Type: application/json');
$upload_floder= __DIR__. './uploaded';

$imgtype=[
  'image/jpeg'=>'.jpg',
  'image/png'=>'.png',
  'image/gif'=>'.gif',
];

$output=[
  'success'=> 0,
  'error'=>[],
  'files'=>[],
];

if(!empty($_FILES['cp-pd-img']) and !empty($_FILES['cp-pd-img']['name'])){
    foreach($_FILES['cp-pd-img']['name'] as $i=>$name){

        $imgtype=$imgtypes[$_FILES['cp-pd-img']['type'][$i]] ?? '';

        if(! empty($imgtype)){
            $filename=sha1($name. rand()).$imgtype;
    
            $target=$upload_floder.'/'.$filename;
            if(move_uploaded_file($_FILES['cp-pd-img']['tmp_name'][$i],$target)){
                $output['success'] ++;
                $output['files'][] = $filename; 
            }else{
                $output['error']='無法移動檔案';
            }
        }else{
            $output['error']='檔案類型不合規定';
        }
    }
}else{
    $output['error']='請上傳檔案';
};


echo json_encode($output, JSON_UNESCAPED_UNICODE);




?>