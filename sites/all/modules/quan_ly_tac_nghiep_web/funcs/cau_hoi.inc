<?php
function save_cau_hoi()
{
  if (!user_access("save_cau_hoi_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['tokenForm'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>');
  } else {
    if (trim($_POST['title']) == '') {
      throw new Exception('<div>Vui lòng nhập tiêu đề</div>');
    }
    $cauHois = [];
    foreach ($_POST['cau_hoi'] as $index => $item) {
      if (trim($item) == '') {
        throw new Exception('<div>Câu số ' . ($index + 1) . ' đang để trống</div>');
      }
      $cauHois[] = json_encode([
        'cau_hoi' => $_POST['cau_hoi'][$index],
        'bat_buoc' => $_POST['bat_buoc'][$index],
        'type' => $_POST['type'][$index],
      ]);
    }
    if (count($cauHois) == 0) {
      throw new Exception('<div>Vui lòng thêm câu hỏi</div>');
    }
    global $user;
    if ($_POST['nid'] == '') {
      $node = insertNewNode('cau_hoi', $_POST['title'], [], $user->uid);
    } else {
      $node = node_load($_POST['nid']);
    }
    if ($node != False) {
      $entity = entity_metadata_wrapper('node', $node);
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

function load_cau_hoi()
{
  if (!user_access("load_cau_hoi_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>');
  }
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  } else {
    if (!isset($_POST['id'])) {
      throw new Exception('<div>Không xác định dữ liệu</div>', 0);
    }
    $data = node_load($_POST['id']);
    if ($data == FALSE) {
      throw new Exception('<div>Không xác định dữ liệu</div>', 0);
    }
    echo json_encode(
      [
        'nid' => $_POST['id'],
        'title_ch' => isset($data->title) ? $data->title : "",
        'field_mo_ta_ch' => isset($data->field_mo_ta['und']) ? $data->field_mo_ta['und'][0]['value'] : "",
        'block_cau_hoi' => getBlockCauHoi($data->field_danh_sach_cau_hoi['und'])
      ]
    );
  }
}

function getBlockCauHoi($data)
{
  $body = "";
  if (count($data) > 0) {
    foreach ($data as $index => $item) {
      $cauHoi = json_decode($item['value']);
      $body .= '<tr>
                  <td >
                    <div class="row">
                      <div class="col-md-8 col-12 mb-1 mb-md-0">
                        <label class="form-label">Câu hỏi ' . ($index + 1) . '</label>
                        <input type="text" class="form-control" name="cau_hoi[]" placeholder="Câu hỏi ' . ($index + 1) . '"
                               aria-describedby="button-addon2" value="' . $cauHoi->cau_hoi . '"/>
                      </div>
                      <div class="col-md-2 col-6">
                        <label class="form-label">Yêu cầu</label>
                        <select name="bat_buoc[]" class="form-select ">
                          <option ' . ($cauHoi->bat_buoc == "1" ? "selected" : "") . ' value="1">Bắt buộc</option>
                          <option ' . ($cauHoi->bat_buoc == "0" ? "selected" : "") . ' value="0">Không bắt buộc</option>
                        </select>
                      </div>
                      <div class="col-md-2 col-6">
                        <label class="form-label">Loại</label>
                        <select name="type[]" class="form-select ">
                          <option ' . ($cauHoi->type == "1" ? "selected" : "") . ' value="1">Đúng/Sai</option>
                          <option ' . ($cauHoi->type == "0" ? "selected" : "") . ' value="0">Văn bản</option>
                        </select>
                      </div>
                    </div>
                  </td>
                  <td width="1%" class="text-center">
                    <a class="btn-xoa-dong" type="button"><i data-feather="trash-2" class="text-danger"></i></a>
                  </td>
                </tr>';
    }
  }
  return $body;
}

function xem_khao_sat()
{
  if (!user_access("xem_khao_sat_permission")) {
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
      'field_khach_hang_id' => [
        'column' => 'target_id',
        'value' => $data->nid,
        'operator' => '='
      ],
    ];
    $limit = isset($_POST['limit']) ? $_POST['limit'] : 10;
    $perPage = isset($_POST['perPage']) ? (intval($_POST['perPage']) > 0 ? intval($_POST['perPage']) : 1) : 1;
    drupal_json_output(getListKetQuaKhaoSat(getListNodeOperator('khao_sat', $arrFields, $perPage, $limit)));
  }
}

function getListKetQuaKhaoSat($nodes)
{
  $data = [];
  $index = ($nodes['perPage'] - 1) * $nodes['limit'];
  foreach ($nodes['data'] as $node) {
    $index++;
    $khachHang = user_load($node->field_khach_hang_id['und'][0]['target_id']);
    $data[] = selectField($node, [
      getValueAttr('field_ngay_nhap', date('H:i d/m/Y', $node->created))
    ], [
      getValueField('index', '', $index),
      getValueField('field_ho_ten', '', $khachHang->field_ho_ten['und'][0]['value']),
      getValueField('field_email', '', $khachHang->mail),
      getValueField('field_action_eye', '', '<a class="text-primary btn-xem-khao-sat"><i data-feather="eye"></i></a>'),
      getValueField('field_action_edit', '', '<a class="text-primary btn-sua-khao-sat"><i data-feather="edit"></i></a>'),
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
