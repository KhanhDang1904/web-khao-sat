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

function load_cau_hoi() {
  if(!user_access("load_cau_hoi_permission")){
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
        'title_ch' => isset($data->title) ?$data->title: "",
        'field_mo_ta_ch' => isset($data->field_mo_ta['und']) ?$data->field_mo_ta['und'][0]['value']: "",
        'block_cau_hoi'=>getBlockCauHoi($data->field_danh_sach_cau_hoi['und'])
      ]
    );
  }
}

function getBlockCauHoi( $data)
{
  $body = "";
  if (count($data)>0){
    foreach ($data as $index =>$item){
      $cauHoi = json_decode($item['value']);
      $body.= '<tr>
                  <td >
                    <div class="row">
                      <div class="col-md-8 col-12 mb-1 mb-md-0">
                        <label class="form-label">Câu hỏi '.($index+1).'</label>
                        <input type="text" class="form-control" name="cau_hoi[]" placeholder="Câu hỏi '.($index+1).'"
                               aria-describedby="button-addon2" value="'.$cauHoi->cau_hoi.'"/>
                      </div>
                      <div class="col-md-2 col-6">
                        <label class="form-label">Yêu cầu</label>
                        <select name="bat_buoc[]" class="form-select ">
                          <option '.($cauHoi->bat_buoc=="1"?"selected":"").' value="1">Bắt buộc</option>
                          <option '.($cauHoi->bat_buoc=="0"?"selected":"").' value="0">Không bắt buộc</option>
                        </select>
                      </div>
                      <div class="col-md-2 col-6">
                        <label class="form-label">Loại</label>
                        <select name="type[]" class="form-select ">
                          <option '.($cauHoi->type=="1"?"selected":"").' value="1">Đúng/Sai</option>
                          <option '.($cauHoi->type=="0"?"selected":"").' value="0">Văn bản</option>
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
