<?php

function save_danh_muc() {
  if(!user_access("save_danh_muc")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>');
  }
  else {
    if (trim($_POST['title']) == '') {
      throw new Exception('<div>Vui lòng nhập tên danh mục</div>');
    }
    global $user;
    if ($_POST['nid'] == '') {
      insertNewNode('cau_hinh',$_POST['title'],[
        'field_ghi_chu'=>join('<br />',array_filter($_POST['field_ghi_chu_form'])),
      ],$user->uid);
    }
    else {
      $node = node_load($_POST['nid']);
      if($node!=False){
        $entity =  entity_metadata_wrapper('node',$node);
        $entity->field_ghi_chu->set(join('<br />',array_filter($_POST['field_ghi_chu_form'])));
        $entity->title->set($_POST['title']);
        $entity->save();
      }
    }
    echo json_encode([
      'content' => 'Đã lưu thông tin thành công',
    ]);
  }
}

function load_danh_muc() {
  if(!user_access("load_danh_muc")){
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
        'field_ghi_chu_form' => isset($data->field_ghi_chu) ? getDanhMucs($_POST['id']): [],
        'title_form' => $data->title,
        ]
    );
  }
}

function xoa_danh_muc() {
  if(!user_access("xoa_danh_muc")){
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
      node_delete($_POST['id']);
      echo json_encode(
        [
          'content' => 'Xoá thông tin danh mục thành công',
        ]
      );
    }
  }
}
function getDanhMucs($nid){
  $node = node_load($nid);
  $content = explode('<br />', nl2br($node->field_ghi_chu['und'][0]['value']));
  foreach ($content as $index => $item)
    $content[$index] = trim($item);
  return array_filter($content);
}
