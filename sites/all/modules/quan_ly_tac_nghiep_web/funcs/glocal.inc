<?php
function active() {
  if(!user_access("active_permission")){
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
          'content' => ($_POST['value']==1?"Tắt":"Bật").'  thành công',
        ]
      );
    }
  }
}
function xoa_node() {
  if(!user_access("xoa_node_permission")){
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
        $entity->field_hoat_dong->set(0);
        $entity->save();
      }
      echo json_encode(
        [
          'content' => 'Xóa thành công',
        ]
      );
    }
  }
}
?>
