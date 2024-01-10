<?php

function save_san_pham() {
  if(!user_access("save_san_pham_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>');
  }
  else {
    if (trim($_POST['field_ten_san_pham']) == '') {
      throw new Exception('<div>Vui lòng nhập tên sản phẩm</div>');
    }
    if (trim($_POST['field_gia']) == '') {
      throw new Exception('<div>Vui lòng nhập giá</div>');
    }
    if (trim($_POST['field_thuong_hieu']) == '') {
      throw new Exception('<div>Vui lòng chọn thương hiệu</div>');
    }
    $khoangGia = getKhoangGia(str_replace(',','',$_POST['field_gia']));
    global $user;
    if ($_POST['nid'] == '') {
      $node = insertNewNode('san_pham',$_POST['title'],[],$user->uid);
    }
    else {
      $node = node_load($_POST['nid']);
    }
//    foreach ($node->field_anh['und'] as $item) {
//      $paths [] = $item['value'];
//    }
    if (count($_FILES['field_anh']['name']) > 0) {
      for ($i = 0; $i < count($_FILES['field_anh']['name']); $i++) {
        if ($_FILES['field_anh']['name'][$i] != "") {
          $filesName = time() . $_FILES['field_anh']['name'][$i];
          $target_path = "images/" . $filesName;
          move_uploaded_file($_FILES['field_anh']['tmp_name'][$i], $target_path);
          $paths [] = 'https://' . $_SERVER['SERVER_NAME'] . '/images/' . $filesName;
        }
      }
    }
    if($node!=False){
      $entity =  entity_metadata_wrapper('node',$node);
      $entity->field_ten_san_pham->set($_POST['field_ten_san_pham']);
      $entity->field_gia->set(str_replace(',','',$_POST['field_gia']));
      $entity->field_thuong_hieu->set($_POST['field_thuong_hieu']);
      $entity->field_mau_sac->set($_POST['field_mau_sac']);
      $entity->field_mo_ta->set($_POST['field_mo_ta']);
      $entity->field_noi_bat->set(intval($_POST['field_noi_bat']));
      $entity->field_phan_loai_san_pham->set($_POST['field_phan_loai_san_pham']);
      $entity->field_cam_giac_luoi->set($_POST['field_cam_giac_luoi']);
      $entity->field_khoang_gia->set($khoangGia);
      $entity->field_anh->set($paths);
      $entity->title->set($_POST['title']==""?'VNB' . sprintf("%07d", $node->nid):$_POST['title']);
      $entity->save();
    }
    echo json_encode([
      'content' => 'Đã lưu thông tin thành công',
    ]);
  }
}

function load_san_pham() {
  if(!user_access("load_san_pham_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  else {
    if(!isset($_POST['id'])){
      throw new Exception('<div>Không xác định dữ liệu</div>', 0);
    }
    $data = node_load($_POST['id']);
    if($data==FALSE){
      throw new Exception('<div>Không xác định dữ liệu</div>', 0);
    }
    echo json_encode(
      [
        'nid' => $_POST['id'],
        'field_ten_san_pham_sp' => isset($data->field_ten_san_pham['und']) ?$data->field_ten_san_pham['und'][0]['value']: "",
        'field_cam_giac_luoi_sp' => isset($data->field_cam_giac_luoi['und']) ?$data->field_cam_giac_luoi['und'][0]['value']: "",
        'field_phan_loai_san_pham_sp' => isset($data->field_phan_loai_san_pham['und']) ?$data->field_phan_loai_san_pham['und'][0]['value']: "",
        'field_gia_sp' => isset($data->field_gia['und']) ? number_format($data->field_gia['und'][0]['value'],0,',',''): "",
        'field_thuong_hieu_sp' => isset($data->field_thuong_hieu['und']) ? $data->field_thuong_hieu['und'][0]['value']: "",
        'field_noi_bat_sp' => isset($data->field_noi_bat['und']) ? $data->field_noi_bat['und'][0]['value']: "",
        'editor' => isset($data->field_mo_ta['und']) ? $data->field_mo_ta['und'][0]['value']: "",
        'field_mau_sac_sp' => isset($data->field_mau_sac['und']) ? $data->field_mau_sac['und']:[],
        'title_sp' => $data->title,
        ]
    );
  }
}

function active_san_pham() {
  if(!user_access("active_san_pham_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  else {
    if (trim($_POST['id']) == '') {
      throw new Exception('<div>Không có thông tin danh mục cần xoá</div>');
    }
    else {
      $node = node_load($_POST['id']);
      if ($node!=False)
      {
        $entity =  entity_metadata_wrapper('node',$node);
        $entity->field_active->set($_POST['value']==1?0:1);
        $entity->save();
      }
      echo json_encode(
        [
          'content' => ($_POST['value']==1?"Tắt":"Bật").' sản phẩm thành công',
        ]
      );
    }
  }
}
function getKhoangGia($gia){
  if ($gia<500000)
    return 'Giá dưới 500.000';
  if ($gia >= 500000 && $gia<1000000)
    return '500.000đ - 1 triệu';
  if ($gia >= 1000000 && $gia<2000000)
    return '1 - 2 triệu';
  if ($gia >= 2000000 && $gia<3000000)
    return '2 - 3 triệu';
  return 'Giá trên 3 triệu';
};
//function getDanhMucs($nid){
//  $node = node_load($nid);
//  $content = explode('<br />', nl2br($node->field_ghi_chu['und'][0]['value']));
//  foreach ($content as $index => $item)
//    $content[$index] = trim($item);
//  return array_filter($content);
//}
function getMauSac($color){
  $arr = [
    'Orange'=>'<span class="badge" style="background: orange">Orange</span>',
    'Red'=>'<span class="badge" style="background: red">Red</span>',
    'Amethist'=>'<span class="badge" style="background: purple">Amethist</span>',
    'Green'=>'<span class="badge" style="background: green">Green</span>',
    'Blue'=>'<span class="badge" style="background: blue">Blue</span>',
    'White'=> '<span class="badge" style="background: #f3f2f2;color: black">White</span>',
    'Black'=>'<span class="badge" >Black</span>',
    'Yellow'=>'<span class="badge" style="background: yellow">Yellow</span>',
    'Pink'=>'<span class="badge" style="background: pink;color: black">Pink</span>',
    'Cyan'=>'<span class="badge" style="background: cyan">Cyan</span>',
    'Violet'=>'<span class="badge" style="background: violet">Violet</span>',
    'Multi'=>'<span class="badge" style="background: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet)">Multi</span>',
  ];
  return $arr[$color];
}
function getListSanPham(){
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'san_pham');
  $query->range(0 , 50);
  $results = $query->execute();
  $nids = array_keys($results['node']);
  shuffle($nids);
  return node_load_multiple($nids);
}
