<?php

function save_don_hang()
{
  if (!user_access("save_don_hang_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>');
  } else {
    if (trim($_POST['field_khach_hang']) == '') {
      throw new Exception('<div>Vui lòng nhập tên khách hàng</div>');
    }
    if (trim($_POST['field_dien_thoai']) == '') {
      throw new Exception('<div>Vui lòng nhập số điện thoại</div>');
    }
    if (trim($_POST['field_ngay_nhap']) == '') {
      throw new Exception('<div>Vui lòng chọn ngày nhập</div>');
    }
    if (!isset($_POST['ten_vot'])) {
      throw new Exception('<div>Vui lòng thêm sản phẩm</div>');
    }
    $sanPham = [];
    foreach ($_POST['ten_vot'] as $index => $item) {
      if ($_POST['ten_vot'][$index] == "") {
        throw new Exception('<div>Vui lòng nhập tên vợt tại dòng ' . ($index + 1) . '</div>');
      }
      $anhTruoc = $_POST['anh_truoc_text'][$index];
      $anhSau = $_POST['anh_sau_text'][$index];
      if (count($_FILES['anh_truoc']['name']) > 0) {
        $filesName = time() . $_FILES['anh_truoc']['name'][$index];
        $target_path = "images/" . $filesName;
        move_uploaded_file($_FILES['anh_truoc']['tmp_name'][$index], $target_path);
        if ($_FILES['anh_truoc']['name'][$index] != "") {
          $anhTruoc = 'https://' . $_SERVER['SERVER_NAME'] . '/images/' . $filesName;
        }
      }
      if (count($_FILES['anh_sau']['name']) > 0) {
        $filesName = time() . $_FILES['anh_sau']['name'][$index];
        $target_path = "images/" . $filesName;
        move_uploaded_file($_FILES['anh_sau']['tmp_name'][$index], $target_path);
        if ($_FILES['anh_sau']['name'][$index] != "") {
          $anhSau = 'https://' . $_SERVER['SERVER_NAME'] . '/images/' . $filesName;
        }
      }
      $sanPham [] = json_encode([
        'id' => $_POST['id'][$index],
        'ten_vot' => $_POST['ten_vot'][$index],
        'tinh_trang' => $_POST['tinh_trang'][$index],
        'loai_cuoc' => $_POST['loai_cuoc'][$index],
        'muc_cang' => str_replace(',', '', $_POST['muc_cang'][$index]),
        'don_vi' => $_POST['don_vi'][$index],
        'trang_thai' => $_POST['trang_thai'][$index],
        'price' => $_POST['price'][$index],
        'yeu_cau_khac' => $_POST['yeu_cau_khac'][$index],
        'anh_truoc' => $anhTruoc,
        'anh_sau' => $anhSau,
      ]);
    }
    if (($_POST['field_tong_tien'] == "")) {
      throw new Exception('<div>Vui lòng nhập tổng tiền</div>');
    }
    if (($_POST['field_khach_tra'] == "")) {
      throw new Exception('<div>Vui lòng nhập khách trả</div>');
    }
//    if ($_POST['title']!==""){
//      $olds = node_load_multiple(NULL, array("title" => $_GET['title'],'type'=>'don_hang'));
//      $old = current($olds);
//      if ($old){
//        throw new Exception('<div>Mã đơn hàng đã tồn tại</div>');
//      }
//    }
    $fields = [
      'field_khach_hang' => $_POST['field_khach_hang'] != "" ? $_POST['field_khach_hang'] : null,
      'field_dien_thoai' => $_POST['field_dien_thoai'] != "" ? $_POST['field_dien_thoai'] : null,
      'field_ngay_nhap' => $_POST['field_ngay_nhap'] != "" ? strtotime($_POST['field_ngay_nhap']) : null,
      'field_ngay_nhan' => $_POST['field_ngay_nhan'] != "" ? strtotime($_POST['field_ngay_nhan']) : null,
      'field_ghi_chu' => $_POST['field_ghi_chu'] != "" ? $_POST['field_ghi_chu'] : null,
      'field_trang_thai' => $_POST['field_trang_thai'] != "" ? $_POST['field_trang_thai'] : "Đã tiếp nhận",
      'field_danh_sach_vot' => $sanPham,
    ];
    $quyDoi = intval(node_load(26662)->field_ghi_chu['und'][0]['value']);
    $phanTram = intval(node_load(26663)->field_ghi_chu['und'][0]['value']) / 100;
    $fields['field_tong_tien'] = str_replace(',', '', $_POST['field_tong_tien']);
    $fields['field_so_diem'] = round(intval($fields['field_tong_tien']) * $phanTram / $quyDoi);

    $fields['field_khach_tra'] = str_replace(',', '', $_POST['field_khach_tra']);
    $conNo = $fields['field_tong_tien'] - $fields['field_khach_tra'];
    if ($conNo <= 0) {
      $fields['field_trang_thanh_toan'] = "Đã thanh toán";
    } else {
      if ($fields['field_khach_tra'] == 0) {
        $fields['field_trang_thanh_toan'] = "Chưa thanh toán";
      } else {
        $fields['field_trang_thanh_toan'] = "Thanh toán một phần";
      }
    }
    $fields['field_con_no'] = $conNo;
    global $user;
    if ($_POST['nid'] == '') {
      $node = insertNewNode('don_hang', $_POST['title'], ['field_trang_thai' => $_POST['field_trang_thai']], $user->uid);
      $mucChi = $fields['field_tong_tien'];
      $diemUser = $fields['field_so_diem'];
      insertNewNode('lich_su_trang_thai_don', $_POST['title'], [
        'field_don_hang_id' => $node->nid,
        'field_trang_thai' => $_POST['field_trang_thai'],
        'field_ngay_nhap' => time(),
      ], $user->uid);
    } else {
      $node = node_load($_POST['nid']);
      $diemUser = $fields['field_so_diem'] - $node->field_so_diem['und'][0]['value'];
      $mucChi = $fields['field_tong_tien'] - $node->field_tong_tien['und'][0]['value'];
    }
    foreach ($node->field_anh['und'] as $item) {
      $paths [] = $item['value'];
    }
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
    if ($node != False) {

      $entity = entity_metadata_wrapper('node', $node);
      foreach ($fields as $field => $value) {
        $entity->{$field}->set($value);
      }
      if ($_POST['title'] == "") {
        $entity->title->set('DH' . sprintf("%07d", $node->nid));
      }
      $entity->field_anh->set($paths);
      if (validateName($_POST['field_dien_thoai'])) {
        $value = [
          'name' => $_POST['field_dien_thoai'],
          'pass' => user_hash_password($_POST['field_dien_thoai']),
          'create' => time(),
          'status' => 1,
          'roles' => [
            8 => 'my custom role',
          ],
          'mail' => "my" . $_POST['field_dien_thoai'] . "@gmail.com",
        ];
        $customer = entity_create('user', $value);
        $ewrapper = entity_metadata_wrapper('user', $customer);
        $ewrapper->field_ho_ten->set($_POST['field_khach_hang']);
        $ewrapper->field_dien_thoai->set($_POST['field_dien_thoai']);
        $ewrapper->field_code->set('KH' . sprintf("%07d", $ewrapper->getIdentifier()));
        $ewrapper->save();
        // Update code
        $customer = user_load_by_name($_POST['field_dien_thoai']);
        $ewrapper = entity_metadata_wrapper('user', $customer);
        $ewrapper->field_code->set('KH' . sprintf("%07d", $ewrapper->getIdentifier()));
        $ewrapper->save();
      } else {
        $customer = user_load_by_name($_POST['field_dien_thoai']);
      }
      if ($customer != FALSE) {
        $ewrapper = entity_metadata_wrapper('user', $customer);
        $diem = isset($customer->field_vi['und'][0]['value']) ? $customer->field_vi['und'][0]['value'] : 0;
        $chi = isset($customer->field_total_money['und'][0]['value']) ? $customer->field_total_money['und'][0]['value'] : 0;
        $ewrapper->field_vi->set($diem + $diemUser);
        $ewrapper->field_total_money->set($chi + $mucChi);
        $ewrapper->save();
        $entity->field_khach_hang_id->set($customer->uid);
      }
      $entity->save();
    }
    echo json_encode([
      'content' => 'Đã lưu thông tin thành công',
    ]);
  }
}

function updateDiem($user)
{

}

function xem_don_hang()
{
  if (!user_access("xem_don_hang_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    if (!isset($_POST['nid'])) {
      throw new Exception('<div>Không xác định dữ liệu</div>', 0);
    }
    $data = node_load($_POST['nid']);
    $arrFields = [
      'field_don_hang_id' => [
        'column' => 'target_id',
        'value' => $data->nid,
        'operator' => '='
      ],
    ];
    $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
    $perPage = isset($_POST['perPage']) ? (intval($_POST['perPage']) > 0 ? intval($_POST['perPage']) : 1) : 1;
    drupal_json_output(getListTrangThaiKhachHang(getListNodeOperator('lich_su_trang_thai_don', $arrFields, $perPage, $limit)));
  }
}

function getListTrangThaiKhachHang($nodes)
{
  $data = [];
  $index = ($nodes['perPage'] - 1) * $nodes['limit'];
  foreach ($nodes['data'] as $node) {
    $index++;
    $data[] = selectField($node, [
      getValueAttr('field_ngay_nhap', date('H:i d/m/Y', $node->created))
    ], [
      getValueField('index', '', $index),
      getValueField('field_trang_thai', 'field_trang_thai'),
    ]);
  }
  return [
    'data' => $data,
    'countPage' => $nodes['countPage'],
    'perPage' => $nodes['perPage'],
    'limit' => $nodes['limit'],
  ];
}

function getListNodeOperator($nameNode, $fieldCondition = [], $perPage = 1, $limit = 0)
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', $nameNode)
    ->propertyOrderBy('nid', 'DESC');

  foreach ($fieldCondition as $field => $item) {
    $query->fieldCondition($field, $item['column'], $item['value'], $item['operator'])
      ->fieldOrderBy($field, $item['column']);
  }
  $countPage = ceil(count(($query->execute()['node'])) / $limit);
  if ($limit != 0) {
    $query->range(($perPage - 1) * $limit, $limit);
  }
  $results = $query->execute();
  $nids = array_keys($results['node']);
  return [
    'data' => node_load_multiple($nids),
    'countPage' => $countPage,
    'perPage' => $perPage,
    'limit' => $limit,
  ];
}

function selectField($entity, $attr = [], $field = [])
{
  $data = [];
  foreach ($attr as $name => $item) {
    if (isset($item['value']) && $item['value'] != '') {
      $data[$item['attr']] = isset($item['value']) ? $item['value'] : "";
    } else
      $data[$name] = $entity->{$item};
  }
  foreach ($field as $item) {
    if (isset($item['value']) && $item['value'] != '') {
      $data[$item['field_name']] = isset($item['value']) ? $item['value'] : "";
    } else
      $data[$item['field_name']] = isset($entity->{$item['field']}['und'][0][$item['column']]) ? $entity->{$item['field']}['und'][0][$item['column']] : "";
  }
  return $data;
}

function getValueField($field_name, $field, $value = '', $column = 'value')
{
  return [
    'field_name' => $field_name,
    'field' => $field,
    'value' => $value,
    'column' => $column
  ];
}

function getValueAttr($attr, $value = '')
{
  return [
    'attr' => $attr,
    'value' => $value,
  ];
}

function load_don_hang()
{
  if (!user_access("load_don_hang_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>', 0);
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if (!isset($_POST['id'])) {
    throw new Exception('<div>Vui lòng chọn đơn hàng</div>', 0);
  }
  $node = node_load($_POST['id']);
  if ($node == False) {
    throw new Exception('<div>Không xác định dữ liệu</div>', 0);
  } else {
    $image = "";
    if (isset($node->field_anh['und'])) {
      foreach ($node->field_anh['und'] as $item) {
        $image .= "<div class='col-md-2 mt-1'><a target='_blank' href='" . $item["value"] . "'><img width='100px' src='" . $item["value"] . "'></a></div>";
      }
    }
    $loaiLuoi = getLoaiCuoc();
    $donVi = getDanhMucs(26590);
    $trangThai = getDanhMucs(26543);
    $sanPham = "";
    if (isset($node->field_danh_sach_vot['und'])) {
      foreach ($node->field_danh_sach_vot['und'] as $index => $item) {
        $item = json_decode($item['value']);
        $loaiCuoc = "";
        foreach ($loaiLuoi as $value) {
          $loaiCuoc .= "<option " . ($value['name'] == $item->loai_cuoc ? "selected" : "") . " value='" . $value['id'] . "'>" . $value['name'] . "</option>";
        }
        $donViSt = "";
        foreach ($donVi as $value) {
          $donViSt .= "<option " . ($value == $item->don_vi ? "selected" : "") . " value='" . $value . "'>" . $value . "</option>";
        }
        $trangThaiSt = "";
        foreach ($trangThai as $value) {
          $trangThaiSt .= '<div class="mr-10">
                                  <label>
                                    <input name="trang_thai[' . $index . ']" ' . ($value == $item->trang_thai ? "checked" : "") . ' class="form-radio" type="radio"
                                           value="' . $value . '"> ' . $value . '
                                  </label>
                                </div>';
        }
        $sanPham .= '<tr class="block-row-new">
                  <td>
                    <div class="row">
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Tên vợt <span class="text-danger">*</span></label>
                            <input placeholder="Tên vợt" name="ten_vot[' . $index . ']" class="form-control " value="' . $item->ten_vot . '">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Tình trạng</label>
                            <input placeholder="Tình trạng" name="tinh_trang[' . $index . ']" class="form-control" value="' . $item->tinh_trang . '">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label>Ảnh</label>
                            <input type="file" class="form-control"
                                   name="anh_truoc[' . $index . ']"/>
                                   <input type="text" class="form-control hidden" value="' . $item->anh_truoc . '"
                                   name="anh_truoc_text[' . $index . ']"/>
                          </div>
                          <div class="col-md-2 mb-1 hidden">
                            <label>Ảnh sau</label>
                            <input type="file" class="form-control"
                                   name="anh_sau[' . $index . ']"/>
                                      <input type="text" class="form-control hidden"  value="' . $item->anh_sau . '"
                                   name="anh_sau_text[' . $index . ']"/>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Loại cước</label>
                            <div class="max-width-100">
                              <select class="form-select load_cuoc_select" name="id[' . $index . ']">
                                <option value="">--Chọn--</option>
                                  ' . $loaiCuoc . '
                              </select>
                            </div>
                            <div class="col-12 text-right mt-1 block_total_price  text-danger">
                              Giá: <span class="total_price">' . number_format($item->price) . '</span> đ
                              <input class="total_price_input hidden" name="price[' . $index . ']" value="' . $item->price . '">
                            </div>
                            <input name="loai_cuoc[' . $index . ']" class="ten_san_pham hidden" value="' . $item->loai_cuoc . '">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Mức căng</label>
                            <fieldset>
                              <div class="input-group">
                                <input type="text" class="form-control numeral-mask text-right "  value="' . $item->muc_cang . '" style="min-width: 50px"
                                       name="muc_cang[' . $index . ']" placeholder="0"/>
                                <select name="don_vi[' . $index . ']" class="form-select">
                                    ' . $donViSt . '
                                </select>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Trạng thái</label>
                            <fieldset class="d-flex flex-column flex-md-row flex-md-wrap" >
                              ' . $trangThaiSt . '
                            </fieldset>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Yêu cầu</label>
                        <textarea class="form-control" name="yeu_cau_khac[' . $index . ']" rows="4">' . $item->yeu_cau_khac . '</textarea>
                      </div>
                    </div>
                  </td>
                  <td class="text-center"><a class="text-danger btn-remove-row"><i data-feather="delete"></i></a></td>
                </tr>';
      }
    }
    drupal_json_output(selectField($node, [
      'title_form' => 'title',
      'nid' => 'nid',
    ], [
      getValueField('field_khach_hang_form', 'field_khach_hang'),
      getValueField('field_dien_thoai_form', 'field_dien_thoai'),
      getValueField('field_ngay_nhap_form', 'field_ngay_nhap', date('Y-m-d H:i', strtotime($node->field_ngay_nhap['und'][0]['value']))),
      getValueField('field_ngay_nhan_form', 'field_ngay_nhan', $node->field_ngay_nhan['und'][0]['value'] != "" ? date('Y-m-d H:i', strtotime($node->field_ngay_nhan['und'][0]['value'])) : ""),
      getValueField('field_ghi_chu_form', 'field_ghi_chu'),
      getValueField('field_trang_thai_form', 'field_trang_thai'),
      getValueField('field_trang_thanh_toan', 'field_trang_thanh_toan'),
      getValueField('field_tong_tien_form', 'field_tong_tien', number_format($node->field_tong_tien['und'][0]['value'], 0, ',', '')),
      getValueField('field_khach_tra_form', 'field_khach_tra', number_format($node->field_khach_tra['und'][0]['value'], 0, ',', '')),
      getValueField('list_image', '', $image),
      getValueField('listbody', '', $sanPham),

    ]));
  }
}

function load_trang_thai()
{
  if (!user_access("load_trang_thai_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>', 0);
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if (!isset($_POST['id'])) {
    throw new Exception('<div>Vui lòng chọn đơn hàng</div>', 0);
  }
  $node = node_load($_POST['id']);
  if ($node == False) {
    throw new Exception('<div>Không xác định dữ liệu</div>', 0);
  } else {

    drupal_json_output(selectField($node, [
      'nid' => 'nid',
      'nid_tt' => 'nid',
    ], [
      getValueField('field_trang_thai_fm', 'field_trang_thai'),
      getValueField('field_trang_thai_thanh_toan_fm', 'field_trang_thanh_toan'),
    ]));
  }
}

function xoa_don_hang()
{
  if (!user_access("xoa_don_hang_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    if (trim($_POST['id']) == '') {
      throw new Exception('<div>Không có thông tin danh mục cần xoá</div>');
    } else {
      node_delete($_POST['id']);
      echo json_encode(
        [
          'content' => 'Xoá thông tin danh mục thành công',
        ]
      );
    }
  }
}

function save_trang_thai()
{
  global $user;
  if (!user_access("save_trang_thai_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    if (trim($_POST['nid']) == '') {
      throw new Exception('<div>Không có thông tin đơn hàng</div>');
    } else {
      if (trim($_POST['field_trang_thai']) == '') {
        throw new Exception('<div>Vui lòng chọn trạng thái</div>');
      }
      $node = node_load($_POST['nid']);
      $data = [];
      if (count($node->field_danh_sach_vot['und']) > 0) {
        foreach ($node->field_danh_sach_vot['und'] as $item) {
          $product = json_decode($item['value']);
          $product->trang_thai = $_POST['field_trang_thai'];
          $data[] = json_encode($product);
        }
      }
      $entity = entity_metadata_wrapper('node', $node);
      $entity->field_trang_thai->set($_POST['field_trang_thai']);
      $entity->field_danh_sach_vot->set($data);
      $entity->save();
      insertNewNode('lich_su_trang_thai_don', $_POST['title'], [
        'field_don_hang_id' => $node->nid,
        'field_trang_thai' => $_POST['field_trang_thai'],
        'field_ngay_nhap' => time(),
      ], $user->uid);
      echo json_encode(
        [
          'content' => 'Lưu thông tin thành công',
        ]
      );
    }
  }
}

function save_trang_thai_thanh_toan()
{
  global $user;
  if (!user_access("save_trang_thai_thanh_toan_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    if (trim($_POST['nid']) == '') {
      throw new Exception('<div>Không có thông tin đơn hàng</div>');
    } else {
      if (trim($_POST['field_trang_thai_thanh_toan']) == '') {
        throw new Exception('<div>Vui lòng chọn trạng thái</div>');
      }
      $node = node_load($_POST['nid']);
      $entity = entity_metadata_wrapper('node', $node);
      $entity->field_trang_thanh_toan->set($_POST['field_trang_thai_thanh_toan']);
      $entity->save();
      echo json_encode(
        [
          'content' => 'Lưu thông tin thành công',
        ]
      );
    }
  }
}

function load_mau_in()
{
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if ($_POST['id'] == '') {
    throw new Exception('<div>Không xác định đơn hàng</div>', 0);
  }
  $nodeDH = node_load($_POST['id']);
  if ($nodeDH == FALSE) {
    throw new Exception('<div>Không xác định đơn hàng </div>', 0);
  }
//  $dichVu = '';
//  if(isset($hopDong->field_nguon['und'][0]['tid'])){
//    $dichVu = taxonomy_term_load($hopDong->field_nguon['und'][0]['tid']);
//  }
//  $chiPhi = '';
//  if(isset($nodeThuChi->field_loai_chi_phi['und'][0]['tid'])){
//    $chiPhi = taxonomy_term_load($nodeThuChi->field_loai_chi_phi['und'][0]['tid']);
//  }
  $sanPham = "";
  foreach ($nodeDH->field_danh_sach_vot['und'] as $item) {
    $item = json_decode($item['value']);
    $sanPham .= '<tr>
			<td style="border-bottom:1px dashed black; border-left:1px dashed black; border-right:1px dashed black; border-top:none; vertical-align:top; width:160px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">' . $item->ten_vot . '</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:none; vertical-align:top; width:217px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">' . $item->tinh_trang . '</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:none; text-align:center; vertical-align:top; width:265px">
			<p  style="text-align:center"><span style="font-size:12pt"><span style="color:black">' . $item->loai_cuoc . '</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:none; vertical-align:top; width:265px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">' . $item->muc_cang . " " . $item->don_vi . '</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:none; vertical-align:top; width:265px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">' . (isset($item->trang_thai) ? getListTrangThai($item->trang_thai) : getListTrangThai("Đã tiếp nhận")) . '</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:none; vertical-align:top; width:265px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">' . $item->yeu_cau_khac . '</span></span></p>
			</td>
		</tr>';
  }


  $table = '
<table cellspacing="0" class="MsoTableGrid" style="border-collapse:collapse; border:none; width:100%">
	<tbody>
		<tr>
			<td style="border-bottom:1px dashed black; border-left:1px dashed black; border-right:1px dashed black; border-top:1px dashed black; vertical-align:top; width:160px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">T&ecirc;n vợt</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:1px dashed black; border-right:1px dashed black; border-top:1px dashed black; vertical-align:top; width:160px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">T&igrave;nh trạng</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:1px dashed black; border-right:1px dashed black; border-top:1px dashed black; vertical-align:top; width:160px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">Loại cước</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:1px dashed black; vertical-align:top; width:217px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">Mức căng</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:1px dashed black; vertical-align:top; width:265px">
			<p style="text-align:center"><span style="font-size:12pt"><span style="color:black">Trạng th&aacute;i</span></span></p>
			</td>
			<td style="border-bottom:1px dashed black; border-left:none; border-right:1px dashed black; border-top:1px dashed black; vertical-align:top; width:265px">
			<p style="text-align:center"><span style="color:#000000"><span style="font-size:16px">Y&ecirc;u cầu kh&aacute;c</span></span></p>
			</td>
		</tr>
		' . $sanPham . '
	</tbody>
</table>
';
  $node = node_load(26628);
  $mauIn = $node->field_ghi_chu['und'][0]['value'];
  $mauIn = str_replace('{{khach_tra}}', isset($nodeDH->field_khach_tra['und'][0]['value']) ? number_format($nodeDH->field_khach_tra['und'][0]['value']) : '0', $mauIn);
  $mauIn = str_replace('{{tong_tien_chu}}', convert_number_to_words(isset($nodeDH->field_khach_tra['und'][0]['value']) ? number_format($nodeDH->field_khach_tra['und'][0]['value']) : 0), $mauIn);
  $mauIn = str_replace('{{khach_tra_chu}}', convert_number_to_words(isset($nodeDH->field_khach_tra['und'][0]['value']) ? number_format($nodeDH->field_khach_tra['und'][0]['value']) : 0), $mauIn);
  $mauIn = str_replace('{{tong_tien}}', isset($nodeDH->field_tong_tien['und'][0]['value']) ? number_format($nodeDH->field_tong_tien['und'][0]['value']) : '0', $mauIn);
  $mauIn = str_replace('{{ngay_nhan}}', isset($nodeDH->field_ngay_nhan['und'][0]['value']) ? date('d/m/Y H:i', strtotime($nodeDH->field_ngay_nhan['und'][0]['value'])) : "", $mauIn);
  $mauIn = str_replace('{{ngay_gui}}', date('d/m/Y H:i', strtotime($nodeDH->field_ngay_nhap['und'][0]['value'])), $mauIn);
  $mauIn = str_replace('{{dien_thoai}}', $nodeDH->field_dien_thoai['und'][0]['value'], $mauIn);
  $mauIn = str_replace('{{ten_khach_hang}}', $nodeDH->field_khach_hang['und'][0]['value'], $mauIn);
  $mauIn = str_replace('{{thanh_toan}}', $nodeDH->field_trang_thanh_toan['und'][0]['value'], $mauIn);
  $mauIn = str_replace('{{ma_don}}', $nodeDH->title, $mauIn);
  $mauIn = str_replace('{{san_pham}}', $table, $mauIn);
  drupal_json_output($mauIn);
}

function getListTrangThai($trangThai)
{
  $arr = [
    'Đã tiếp nhận' => '<div class="badge bg-primary"><i data-feather="info"></i> Đã tiếp nhận</div>',
    'Đã đan xong' => '<div class="badge bg-warning"><i data-feather="check-square"></i> Đã đan xong</div>',
    'Đã lấy' => '<div class="badge bg-success"><i data-feather="check-circle"></i> Đã lấy</div>',
  ];
  return isset($arr[$trangThai]) ? $arr[$trangThai] : $arr[0];
}

function save_mau_in()
{
  if (!user_access("save_mau_in_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  $node = node_load(26628);
  $entity = entity_metadata_wrapper('node', $node);
  $entity->field_ghi_chu->set($_POST['content']);
  $entity->save();
  drupal_json_output([
    'content' => "Lưu mẫu in thành công",
  ]);
}

function validateName($name)
{
  $existingName = user_load_by_name($name);
  if ($existingName != FALSE) {
    return false;
  }
  return true;
}

//function getDanhMucs($nid){
//  $node = node_load($nid);
//  $content = explode('<br />', nl2br($node->field_ghi_chu['und'][0]['value']));
//  foreach ($content as $index => $item)
//    $content[$index] = trim($item);
//  return array_filter($content);
//}
function get_khach_hang()
{
  if (!user_access("get_khach_hang_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'user');
    if (intval($_POST['q']) > 0) {
      $query = $query->fieldCondition('field_dien_thoai', 'value', $_POST['q'], 'CONTAINS');
    } else {
      $query = $query->fieldCondition('field_ho_ten', 'value', $_POST['q'], 'CONTAINS');
    }
    $query = $query->pager();
    $results = $query->execute();
    if (isset($results['user']))
      $users = user_load_multiple(array_keys($results['user']));
    else
      $users = [];
    $listUsers = [];
    foreach ($users as $user) {
      $listUsers[] = [
        'id' => $user->uid,
        'name' => isset($user->field_ho_ten['und']) ? $user->field_ho_ten['und'][0]['value'] : $user->name
      ];
    }
    $listUsers[] = [
      'id' => 0,
      'name' => $_POST['q']
    ];
    drupal_json_output([
      'items' => $listUsers,
      'total_count' => count($listUsers),
      'incomplete_results' => true
    ]);
  }
}

function getLoaiCuoc()
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node');
  $query = $query->fieldCondition('field_ten_san_pham', 'value', $_POST['q'], 'CONTAINS');
  $results = $query->execute();
  if (isset($results['node']))
    $nodes = node_load_multiple(array_keys($results['node']));
  else
    $nodes = [];
  $listNodes = [];
  foreach ($nodes as $node) {
    $listNodes[] = [
      'id' => $node->nid,
      'name' => isset($node->field_ten_san_pham['und']) ? $node->field_ten_san_pham['und'][0]['value'] : ""
    ];
  }
  return $listNodes;
}

function get_cuoc_dan()
{
  if (!user_access("get_cuoc_dan_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>', 0);
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if (!isset($_POST['id'])) {
    throw new Exception('<div>Vui lòng chọn đơn hàng</div>', 0);
  }
  $node = node_load($_POST['id']);
  drupal_json_output(selectField($node, [
  ], [
    getValueField('field_ten_san_pham', 'field_ten_san_pham'),
    getValueField('field_gia', 'field_gia', number_format($node->field_gia['und'][0]['value'])),
  ]));

}

function load_khach_hang()
{
  if (!user_access("load_khach_hang_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>', 0);
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if (!isset($_POST['id'])) {
    throw new Exception('<div>Vui lòng chọn đơn hàng</div>', 0);
  }
  $user = user_load($_POST['id']);
  $node = node_load(getDonHangGanNhat($_POST['id'])[0]);
  $image = "";
  if (isset($node->field_anh['und'])) {
    foreach ($node->field_anh['und'] as $item) {
      $image .= "<div class='col-md-2 mt-1'><a target='_blank' href='" . $item["value"] . "'><img width='100px' src='" . $item["value"] . "'></a></div>";
    }
  }
  $loaiLuoi = getLoaiCuoc();
  $donVi = getDanhMucs(26590);
  $trangThai = getDanhMucs(26543);
  $sanPham = "";
  if (isset($node->field_danh_sach_vot['und'])) {
    foreach ($node->field_danh_sach_vot['und'] as $index => $item) {
      $item = json_decode($item['value']);
      $loaiCuoc = "";
      foreach ($loaiLuoi as $value) {
        $loaiCuoc .= "<option " . ($value['name'] == $item->loai_cuoc ? "selected" : "") . " value='" . $value['id'] . "'>" . $value['name'] . "</option>";
      }
      $donViSt = "";
      foreach ($donVi as $value) {
        $donViSt .= "<option " . ($value == $item->don_vi ? "selected" : "") . " value='" . $value . "'>" . $value . "</option>";
      }
      $trangThaiSt = "";
      foreach ($trangThai as $value) {
        $trangThaiSt .= '<div class="mr-10">
                                  <label>
                                    <input name="trang_thai[' . $index . ']" ' . ($value == $item->trang_thai ? "checked" : "") . ' class="form-radio" type="radio"
                                           value="' . $value . '"> ' . $value . '
                                  </label>
                                </div>';
      }
      $sanPham .= '<tr class="block-row-new">
                  <td>
                    <div class="row">
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Tên vợt <span class="text-danger">*</span></label>
                            <input placeholder="Tên vợt" name="ten_vot[' . $index . ']" class="form-control " value="' . $item->ten_vot . '">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Tình trạng</label>
                            <input placeholder="Tình trạng" name="tinh_trang[' . $index . ']" class="form-control" value="' . $item->tinh_trang . '">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label>Ảnh</label>
                            <input type="file" class="form-control"
                                   name="anh_truoc[' . $index . ']"/>
                                   <input type="text" class="form-control hidden"
                                   name="anh_truoc_text[' . $index . ']"/>
                          </div>
                          <div class="col-md-2 mb-1 hidden">
                            <label>Ảnh sau</label>
                            <input type="file" class="form-control"
                                   name="anh_sau[' . $index . ']"/>
                                      <input type="text" class="form-control hidden"
                                   name="anh_sau_text[' . $index . ']"/>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Loại cước</label>
                            <div class="max-width-100">
                              <select class="form-select load_cuoc_select" name="id[' . $index . ']">
                                <option value="">--Chọn--</option>
                                  ' . $loaiCuoc . '
                              </select>
                            </div>
                            <div class="col-12 text-right mt-1 block_total_price  text-danger">
                              Giá: <span class="total_price">' . number_format($item->price) . '</span> đ
                              <input class="total_price_input hidden" name="price[' . $index . ']" value="' . $item->price . '">
                            </div>
                            <input name="loai_cuoc[' . $index . ']" class="ten_san_pham hidden" value="' . $item->loai_cuoc . '">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Mức căng</label>
                            <fieldset>
                              <div class="input-group">
                                <input type="text" class="form-control numeral-mask text-right "  value="' . $item->muc_cang . '" style="min-width: 50px"
                                       name="muc_cang[' . $index . ']" placeholder="0"/>
                                <select name="don_vi[' . $index . ']" class="form-select">
                                    ' . $donViSt . '
                                </select>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Trạng thái</label>
                            <fieldset class="d-flex flex-column flex-md-row flex-md-wrap" >
                              ' . $trangThaiSt . '
                            </fieldset>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Yêu cầu</label>
                        <textarea class="form-control" name="yeu_cau_khac[' . $index . ']" rows="4">' . $item->yeu_cau_khac . '</textarea>
                      </div>
                    </div>
                  </td>
                  <td class="text-center"><a class="text-danger btn-remove-row"><i data-feather="delete"></i></a></td>
                </tr>';
    }
  }
  drupal_json_output(selectField($node, [
    'title_form' => 'title',
  ], [
    getValueField('field_khach_hang_form', '', $_POST['name']),
    getValueField('field_dien_thoai_form', '', $user->field_dien_thoai['und'][0]['value']),
    getValueField('field_yeu_cau_khac_form', 'field_yeu_cau_khac'),
    getValueField('field_ghi_chu_form', 'field_ghi_chu'),
    getValueField('list_image', '', $image),
    getValueField('listbody', '', $sanPham),

  ]));

}

function getDonHangGanNhat($id)
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'don_hang')
    ->fieldCondition('field_khach_hang_id', 'target_id', $id)
    ->fieldOrderBy('field_ngay_nhap', 'value', 'DESC');
  $results = $query->execute();
  return isset($results['node']) ? (array_keys($results['node'])) : 0;

}

function getMauIn()
{
  $node = node_load(26628);
  $mauIn = $node->field_ghi_chu['und'][0]['value'];
  return $mauIn;
}

function convert_number_to_words($number)
{

  $hyphen = ' ';
  $conjunction = '  ';
  $separator = ' ';
  $negative = 'âm ';
  $decimal = ' phẩy ';
  $dictionary = array(
    0 => 'Không',
    1 => 'Một',
    2 => 'Hai',
    3 => 'Ba',
    4 => 'Bốn',
    5 => 'Năm',
    6 => 'Sáu',
    7 => 'Bảy',
    8 => 'Tám',
    9 => 'Chín',
    10 => 'Mười',
    11 => 'Mười một',
    12 => 'Mười hai',
    13 => 'Mười ba',
    14 => 'Mười bốn',
    15 => 'Mười năm',
    16 => 'Mười sáu',
    17 => 'Mười bảy',
    18 => 'Mười tám',
    19 => 'Mười chín',
    20 => 'Hai mươi',
    30 => 'Ba mươi',
    40 => 'Bốn mươi',
    50 => 'Năm mươi',
    60 => 'Sáu mươi',
    70 => 'Bảy mươi',
    80 => 'Tám mươi',
    90 => 'Chín mươi',
    100 => 'trăm',
    1000 => 'ngàn',
    1000000 => 'triệu',
    1000000000 => 'tỷ',
    1000000000000 => 'nghìn tỷ',
    1000000000000000 => 'ngàn triệu triệu',
    1000000000000000000 => 'tỷ tỷ'
  );

  if (!is_numeric($number)) {
    return false;
  }

  if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
    // overflow
    trigger_error(
      'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
      E_USER_WARNING
    );
    return false;
  }

  if ($number < 0) {
    return $negative . convert_number_to_words(abs($number));
  }

  $string = $fraction = null;

  if (strpos($number, '.') !== false) {
    list($number, $fraction) = explode('.', $number);
  }

  switch (true) {
    case $number < 21:
      $string = $dictionary[$number];
      break;
    case $number < 100:
      $tens = ((int)($number / 10)) * 10;
      $units = $number % 10;
      $string = $dictionary[$tens];
      if ($units) {
        $string .= $hyphen . $dictionary[$units];
      }
      break;
    case $number < 1000:
      $hundreds = $number / 100;
      $remainder = $number % 100;
      $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
      if ($remainder) {
        $string .= $conjunction . convert_number_to_words($remainder);
      }
      break;
    default:
      $baseUnit = pow(1000, floor(log($number, 1000)));
      $numBaseUnits = (int)($number / $baseUnit);
      $remainder = $number % $baseUnit;
      $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
      if ($remainder) {
        $string .= $remainder < 100 ? $conjunction : $separator;
        $string .= convert_number_to_words($remainder);
      }
      break;
  }

  if (null !== $fraction && is_numeric($fraction)) {
    $string .= $decimal;
    $words = array();
    foreach (str_split((string)$fraction) as $number) {
      $words[] = $dictionary[$number];
    }
    $string .= implode(' ', $words);
  }
  $string = strtolower($string);
  $string[0] = strtoupper($string[0]);
  return $string;
}

function getListDonHang()
{
  $getKhachHangByCode = getKhachHangByCode($_GET['title']);
  $arrFields = [
    'field_khach_hang_id' => [
      'column' => 'target_id',
      'value' => $getKhachHangByCode->uid,
      'operator' => '='
    ],
    'field_trang_thai' => [
      'column' => 'value',
      'value' => "Đã lấy",
      'operator' => '<>'
    ],
    'field_trang_thanh_toan' => [
      'column' => 'value',
      'value' => "Đã thanh toán",
      'operator' => '<>'
    ],
  ];
  $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
  $perPage = isset($_GET['perPage']) ? (intval($_GET['perPage']) > 0 ? intval($_GET['perPage']) : 1) : 1;
  return (getListPhieuDan(getListNodeOperator('don_hang', $arrFields, $perPage, $limit)));
}

function getKhachHangByCode($code)
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'user')
    ->fieldCondition('field_code', 'value', $code);
  $results = $query->execute();
  $uids = array_keys($results['user']);
  return user_load($uids[0]);
}

function getListPhieuDan($nodes)
{
  $data = [];
  $index = ($nodes['perPage'] - 1) * $nodes['limit'];
  foreach ($nodes['data'] as $node) {
    $index++;
    $data[] = selectField($node, [
      'title' => 'title'
    ], [
      getValueField('index', '', $index),
      getValueField('field_trang_thai', 'field_trang_thai'),
      getValueField('field_ngay_nhap', '', $node->field_ngay_nhap['und'][0]['value'] !== "" ? date('H:i d/m/Y', strtotime($node->field_ngay_nhap['und'][0]['value'])) : ""),
      getValueField('field_ngay_nhan', '', $node->field_ngay_nhan['und'][0]['value'] == "" ? "" : date('H:i d/m/Y', strtotime($node->field_ngay_nhan['und'][0]['value']))),
      getValueField('field_ghi_chu', 'field_ghi_chu'),
      getValueField('field_danh_sach_vot', '', $node->field_danh_sach_vot['und']),
      getValueField('field_tong_tien', 'field_tong_tien'),
      getValueField('field_trang_thanh_toan', 'field_trang_thanh_toan'),
    ]);
  }
  return [
    'data' => $data,
    'countPage' => $nodes['countPage'],
    'perPage' => $nodes['perPage'],
    'limit' => $nodes['limit'],
  ];
}
function getListImage(){
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', "banner")
    ->propertyOrderBy('nid', 'DESC');
  $query->fieldCondition('field_hoat_dong','value',1);
  $results = $query->execute();
  $nids = array_keys($results['node']);
  return [
    'data' => node_load_multiple($nids),
  ];
}
