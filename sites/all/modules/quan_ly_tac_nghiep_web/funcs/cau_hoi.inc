<?php

function save_cau_hoi() {
  if(!user_access("save_cau_hoi_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>');
  }
  else {
    if (trim($_POST['title']) == '') {
      throw new Exception('<div>Vui lòng nhập tiêu đề</div>');
    }
    $cauHois = [];
    foreach ($_POST['cau_hoi'] as $index=>$item){
      if (trim($item) == ''){
        throw new Exception('<div>Câu số '.($index+1).' đang để trống</div>');
      }
      $cauHois[] = json_encode([
        'cau_hoi'=>$_POST['cau_hoi'][$index],
        'bat_buoc'=>$_POST['bat_buoc'][$index],
        'type'=>$_POST['type'][$index],
      ]);
    }
    if (count($cauHois)==0){
      throw new Exception('<div>Vui lòng thêm câu hỏi</div>');
    }
    global $user;
    if ($_POST['nid'] == '') {
      $node = insertNewNode('cau_hoi',$_POST['title'],[],$user->uid);
    }
    else {
      $node = node_load($_POST['nid']);
    }
    if($node!=False){
      $entity =  entity_metadata_wrapper('node',$node);
      $entity->field_mo_ta->set($_POST['field_mo_ta']);
      $entity->title->set($_POST['title']);
      $entity->field_danh_sach_cau_hoi->set($cauHois);
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
