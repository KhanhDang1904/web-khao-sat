<?php
function ho_so_ca_nhan()
{
  return [
    '#type' => 'markup',
  ];
}

function save_user()
{
  if (!user_access("save_user_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    checkEmPty([
      'name' => 'Tên đăng nhập',
      'field_ho_ten' => 'Họ tên',
      'field_dien_thoai' => 'Điện thoại',
    ]);
    validateExisting($_POST['uid'], $_POST['name'], $_POST['field_email']);

    if (strlen($_POST['field_ho_ten']) < 8) {
      throw new Exception('<div>Họ tên tối thiểu 8 kí tự</div>', 0);
    }
    if (strlen($_POST['field_dien_thoai']) != 10) {
      throw new Exception('<div>Số điện thoại không hợp lệ</div>', 0);
    }
    $roles = [];
    foreach ($_POST['field_role'] as $item) {
      $roles[$item] = 'my custom role';
    }
    if (count($roles) == 0) {
      $roles = [
        4 => 'my custom role',
      ];
    }
    if ($_POST['uid'] == '') {

      $value = [
        'name' => $_POST['name'],
        'pass' => user_hash_password($_POST['password']),
        'create' => time(),
        'status' => 1,
        'roles' => $roles,
        'mail' => $_POST['field_email'],
      ];
      $user = entity_create('user', $value);
      $ewrapper = entity_metadata_wrapper('user', $user);
    } else {
      $user = user_load($_POST['uid']);
      $ewrapper = entity_metadata_wrapper('user', $user);
      $ewrapper->name->set($_POST['name']);
      if ($_POST['password'] != '') {
        $user->pass = user_hash_password($_POST['password']);
      }
      $user->roles = $roles;
      $user->mail = $_POST['field_email'];
    }
    $ewrapper->field_ho_ten->set($_POST['field_ho_ten']);
    $ewrapper->field_code->set('KH' . sprintf("%07d", $user->uid));
//    $ewrapper->field_email->set($_POST['field_email']);
    $ewrapper->field_dien_thoai->set($_POST['field_dien_thoai']);
    $ewrapper->field_dia_chi->set($_POST['field_dia_chi']);
    if ($_POST['field_ngay_sinh_thanh_lap'] != '') {
      $ewrapper->field_ngay_sinh->set(strtotime($_POST['field_ngay_sinh_thanh_lap']));
    }
    $ewrapper->save();
    drupal_json_output(
      [
        'content' => 'Lưu thông tin người dùng thành công',
      ]
    );
  }
}

function save_logo()
{
  if (!user_access("save_logo_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>', 0);
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if (0 < $_FILES['file']['error']) {
    throw new Exception('<div>Error:</div>' . $_FILES['file']['error'], 0);
  } else {
    $node = node_load(26604);
    $entity = entity_metadata_wrapper('node', $node);
    $entity->field_ghi_chu->set('images/' . $_FILES['file']['name']);
    $entity->save();
    move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $_FILES['file']['name']);
  }
  drupal_json_output(
    [
      'content' => 'Cập nhật logo thành công',
    ]
  );
}

function getRoles()
{
  $sql = 'SELECT rid,name FROM {role} Where rid>3 ';
  $q = db_query($sql)->fetchAll();
  return $q;
}

function load_role()
{
  if (!user_access("load_role_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    $q = getRoles();
    drupal_json_output($q);
  }
}

function xoa_user()
{
  if (!user_access("xoa_user_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  /**
   * @todo Kiểm tra lại token trước khi xử lý dữ liệu
   */
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if ($_POST['id'] == 1) {
    throw new Exception('<div>Bạn không có quyền xóa tài khoản admin</div>', 0);
  }
  global $user;
  if ($_POST['id'] == $user->uid) {
    throw new Exception('<div>Tài khoản hiện đang được đăng nhập, bạn không thực hiện thao tác xóa tài khoản này</div>', 0);
  }
  $userUpdate = user_load($_POST['id']);
  if (is_null($userUpdate)) {
    throw new Exception('<div>Không xác định người dùng</div>');
  }
  $ewrapper = entity_metadata_wrapper('user', $userUpdate);
  /**
   * @todo bỏ field_active, sử dụng status thay thế
   */
  $userUpdate->status = 0;
  $ewrapper->save();
  drupal_json_output(
    [
      'user' => $user,
      'content' => 'Xóa thông tin người dùng thành công',
    ]
  );
}

function load_user()
{
  if (!user_access("load_user_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    $user = user_load($_POST['id']);
    if (is_null($user)) {
      throw new Exception('<div>Không xác định người dùng</div>');
    }
    $sql = 'SELECT rid,name FROM {role} Where rid>3 ';
    $roles = db_query($sql)->fetchAll();
    drupal_json_output([
        'user' => [
          'uid' => $user->uid,
          'field_ho_ten' => isset($user->field_ho_ten['und']) ? $user->field_ho_ten['und'][0]['value'] : '',
          'field_dia_chi' => isset($user->field_dia_chi['und']) ? $user->field_dia_chi['und'][0]['value'] : '',
          'field_dien_thoai' => isset($user->field_dien_thoai['und']) ? $user->field_dien_thoai['und'][0]['value'] : '',
          'field_hinh_anh' => isset($user->field_hinh_anh['und']) ? $user->field_hinh_anh['und'][0]['value'] : '',
          'field_ngay_sinh_thanh_lap' => isset($user->field_ngay_sinh['und']) ? $user->field_ngay_sinh['und'][0]['value'] : '',
          'mail' => $user->mail,
          'name' => $user->name,
          'pass' => $user->pass,
          'roles' => $user->roles,
        ],
        'role' => $roles,
      ]
    );
  }
}

function load_diem()
{
  if (!user_access("load_diem_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    $user = user_load($_POST['id']);
    if (is_null($user)) {
      throw new Exception('<div>Không xác định người dùng</div>');
    }
    drupal_json_output([
        'uid_u' => $user->uid,
        'field_vi_u' => isset($user->field_vi['und']) ? $user->field_vi['und'][0]['value'] : 0,
      ]
    );
  }
}

function save_doi_diem()
{
  if (!user_access("save_doi_diem_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    $user = user_load($_POST['uid']);
    if ($user==FALSE){
      throw new Exception('<div>Không xác định khách hàng </div>', 0);
    }
    $diem = intval(str_replace(',','',$_POST['field_vi']));
    if ($diem<100){
      throw new Exception('<div>Số điểm tối thiểu là 100</div>', 0);
    }
    if ($_POST['field_phan_qua']==""){
      throw new Exception('<div>Vui lòng nhập phần thưởn đổi quà</div>', 0);
    }
    $diemHeThong = isset($user->field_vi['und'])?$user->field_vi['und'][0]['value']:0;
    if ($diem>intval($diemHeThong)){
      throw new Exception('<div>Số điểm không đủ</div>', 0);
    }
    $ewrapper = entity_metadata_wrapper('user', $user);
    $ewrapper->field_vi->set($diemHeThong - $_POST['field_vi']);
    $ewrapper->save();
    insertNewNode('lich_su_doi_diem',"Đổi điểm ".time(),[
      'field_khach_hang_id'=>$user->uid,
      'field_so_diem'=>$diem,
      'field_phan_qua'=> $_POST['field_phan_qua'],
    ]);
    drupal_json_output(
      [
        'content' => 'Đổi điểm thành công',
      ]
    );
  }
}
function lich_su_doi_diem() {
  if(!user_access("lich_su_doi_diem_permission")){
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  else {
    if(!isset($_POST['nid'])){
      throw new Exception('<div>Không xác định dữ liệu</div>', 0);
    }
    $arrFields = [
      'field_khach_hang_id' => [
        'column' => 'target_id',
        'value' => $_POST['nid'],
        'operator'=>'='
      ],
    ];
    $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
    $perPage = isset($_POST['perPage']) ? (intval($_POST['perPage']) > 0 ? intval($_POST['perPage']) : 1) : 1;
    drupal_json_output(getListLichSuDoiDiem(getListNodeOperator('lich_su_doi_diem', $arrFields, $perPage, $limit)));
  }
}
function getListLichSuDoiDiem($nodes)
{
  $data = [];
  $index = ($nodes['perPage'] - 1) * $nodes['limit'];
  foreach ($nodes['data'] as $node) {
    $index++;
    $khachHang = user_load($node->field_khach_hang_id['und'][0]['target_id']);
    $data[] = selectField($node, [
      getValueAttr('created',date('H:i d/m/Y',$node->created))
    ], [
      getValueField('index', '', $index),
      getValueField('field_ho_ten', '',$khachHang->field_ho_ten['und'][0]['value']),
      getValueField('field_so_diem', 'field_so_diem',number_format($node->field_so_diem['und'][0]['value'])),
      getValueField('field_phan_qua', 'field_phan_qua'),
    ]);
  }
  return [
    'data' => $data,
    'countPage' => $nodes['countPage'],
    'perPage' => $nodes['perPage'],
    'limit' => $nodes['limit'],
  ];
}
function validateExisting($uid, $name, $email)
{
  if ($uid == '') {
    if (strlen($_POST['password']) < 6) {
      throw new Exception('<div>Mật khẩu tối thiểu 6 kí tự</div>');
    }
    if (strlen($_POST['name']) < 8) {
      throw new Exception('<div>Tên đăng nhập tối thiểu 8 kí tự</div>', 0);
    }
    $existingName = user_load_by_name($name);
    if ($existingName != FALSE) {
      throw new Exception('<div>Tên đăng nhập đã tồn tại</div>');
    }
    if ($email != '') {
      $existingEmail = user_load_by_mail($email);
      if ($existingEmail != FALSE) {
        throw new Exception('<div>Email đã tồn tại</div>');
      }
      if (!verifyEmail($_POST['field_email'])) {
        throw new Exception('<div>Email không hợp lệ</div>');
      }
    }
  } else {
    $user = user_load($uid);
    if ($user->name != $name) {
      $existingName = user_load_by_name($name);
      if ($existingName != FALSE) {
        throw new Exception('<div>Tên đăng nhập đã tồn tại</div>');
      }
    }
    if ($email != '') {
      if ($user->mail != $email) {
        $existingEmail = user_load_by_mail($email);
        if ($existingEmail != FALSE) {
          throw new Exception('<div>Email đã tồn tại</div>');
        }
        if (!verifyEmail($_POST['field_email'])) {
          throw new Exception('<div>Email không hợp lệ</div>');
        }
      }
    }
    if ($_POST['password'] != '') {
      if (strlen($_POST['password']) < 6) {
        throw new Exception('<div>Mật khẩu tối thiểu 6 kí tự</div>');
      }
    }
  }
}

?>
