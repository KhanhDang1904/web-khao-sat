<?php
function save_phan_quyen(){
  if(!user_access("save_phan_quyen_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if(count($_POST['user_perm'])>0){
    deleteCurrentPerm('quan_ly_tac_nghiep_web');
    $roles = getRoles();
    foreach ($_POST['user_perm'][1] as $item){
      db_insert('role_permission')->fields([
        'rid' =>1,
        'permission' => $item,
        'module' => "quan_ly_tac_nghiep_web",
      ])->execute();
    }
    foreach ($roles as $role){
      foreach ($_POST['user_perm'][$role->rid] as $item){
        db_insert('role_permission')->fields([
          'rid' => $role->rid,
          'permission' => $item,
          'module' => "quan_ly_tac_nghiep_web",
        ])->execute();
      }
    }
  }
  drupal_json_output([
    'content' => "Lưu phân quyền thành công",
  ]);
}

/**
 * @param $name
 * @param $rid
 * @return bool
 */
function existingPerm($name,$rid){
  $sql = "SELECT * FROM {role_permission} Where permission = '".$name."' and rid =".$rid;
  $perm = db_query($sql)->fetchAll();
  if(count($perm)==0){
    return false;
  }
  return true;
}
function phan_quyen() {
  return [
    '#type' => 'markup',
  ];
}
function deleteCurrentPerm($moduleName){
  db_delete('role_permission')
    ->condition('module', $moduleName)
    ->execute();
}
?>
