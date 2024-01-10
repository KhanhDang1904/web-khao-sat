<?php
function save_vai_tro() {
  if(!user_access("save_vai_tro_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if ($_POST['name'] == '') {
    throw new Exception('<div>Tên vai trò không được để trống</div>', 0);
  }
  existingVaiTro($_POST['name'], $_POST['roleID']);
  if ($_POST['roleID'] == '') {
    db_insert('role')->fields([
      'name' => $_POST['name'],
      'weight' => 4,
    ])->execute();
  }
  else {
    $role = user_role_load($_POST['roleID']);
    $role->name = $_POST['name'];
    user_role_save($role);
  }
  drupal_json_output([
    'content' => "Lưu vai trò thành công",
  ]);
}
function vai_tro() {
  return [
    '#type' => 'markup',
  ];
}
function load_vai_tro() {
  if(!user_access("load_vai_tro_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if ($_POST['roleID'] == '') {
    throw new Exception('<div>Không xác định vai trò</div>', 0);
  }
  $role = user_role_load($_POST['roleID']);
  drupal_json_output([
    'roleID' => $role->rid,
    'name' => $role->name,
  ]);
}

function xoa_vai_tro() {
  if(!user_access("xoa_vai_tro_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if ($_POST['roleID'] == '') {
    throw new Exception('<div>Không xác định vai trò</div>', 0);
  }
  $role = user_role_load($_POST['roleID']);
  if ($role == FALSE) {
    throw new Exception('<div>Không xác định vai trò</div>', 0);
  }

  db_delete('role')
    ->condition('rid', $role->rid)
    ->execute();
  drupal_json_output([
    'content' => "Xóa vai trò thành công",
  ]);
}

function existingVaiTro($name, $roleID) {
  if ($roleID == '') {
    $role = user_role_load_by_name($name);
    if ($role != FALSE) {
      throw new Exception('<div>Vai trò đã tồn tại</div>', 0);
    }
  }
  else {
    $role = user_role_load($roleID);
    if ($name != $role->name) {
      if ($role != FALSE) {
        throw new Exception('<div>Vai trò đã tồn tại</div>', 0);
      }

    }
  }
}

?>
