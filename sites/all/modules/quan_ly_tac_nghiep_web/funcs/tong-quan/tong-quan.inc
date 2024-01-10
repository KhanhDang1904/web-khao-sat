<?php
function get_thong_ke_hop_dong_by_year()
{
  if (!validateToken($_POST['token'], 60 * 24)) {
    throw new Exception('<div>Token hết hạn, vui lòng Làm mới lại trang</div>', 0);
  }
  if (!user_access("get_thong_ke_hop_dong_by_year_permission")) {
    throw new Exception('<div>Bạn không có quyền truy cập chức năng này</div>', 0);
  }
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'thu_chi')
    ->fieldCondition('field_hoat_dong', 'value', 1)
    ->fieldCondition('field_ngay_nhap', 'value',   date('Y-01-01 00:00:00'), '>=')
    ->fieldCondition('field_ngay_nhap', 'value',  date('Y-12-t 00:00:00'), '<=');
  $results = $query->execute();
  if (isset($results['node'])) {
    $nodes = node_load_multiple(array_keys($results['node']));
  } else {
    $nodes = [];
  }
  $tongThu = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  $tongChi = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  foreach ($nodes as $node) {
    if ($node->field_phan_loai['und'][0]['value'] == "Thu") {
      $tongThu[intval(date('m', $node->created) - 1)] += (ceil((isset($node->field_thanh_tien['und'][0]['value']) ? $node->field_thanh_tien['und'][0]['value'] : $node->field_so_tien['und'][0]['value']) ));
    } else {
      $tongChi[intval(date('m', $node->created) - 1)] -= ceil((isset($node->field_thanh_tien['und'][0]['value']) ? $node->field_thanh_tien['und'][0]['value'] : $node->field_so_tien['und'][0]['value']));
    }
  }
  $dataTongThu = [];
  $dataTongChi = [];
  foreach ($tongThu as $item){
    $dataTongThu[]=ceil($item/1000000);
  }
  foreach ($tongChi as $item){
    $dataTongChi[]=ceil($item/1000000);
  }
  drupal_json_output([
    'node'=>$nodes,
    'tongChi' => $dataTongChi,
    'tongThu' => $dataTongThu,
  ]);
}

function getDoanhSoTheoThang($month, $year)
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'hop_dong')
    ->fieldCondition('field_hoat_dong', 'value', 1)
    ->propertyCondition('created', strtotime(date($year . "-" . $month . "-1 00:00:01")), ">=")
    ->propertyCondition('created', strtotime(date($year . "-" . $month . "-t 23:59:59")), "<=");
  $results = $query->execute();
  if (isset($results['node'])) {
    $nodes = node_load_multiple(array_keys($results['node']));
  } else {
    $nodes = [];
  }
  $doanhSo = 0;
  $daThanhToan = 0;
  $hanDichVu = 0;
  $thanhLapDoanhNgiep = 0;
  $tongGiaHan = 0;
  $chuKiSo = 0;
  foreach ($nodes as $node) {
    if ($node->field_canh_bao['und'][0]['value'] == 1) {
      $hanDichVu++;
    }
    $doanhSo += $node->field_thanh_tien['und'][0]['value'];
    $thanhLapDoanhNgiep += $node->field_dich_vu['und'][0]['tid'] == 23 ? 1 : 0;
    $chuKiSo += $node->field_dich_vu['und'][0]['tid'] == 27 ? 1 : 0;
    if (isset($node->field_hop_dong_cu['und'])) {
      $slGiaHan++;
      $tongGiaHan += $node->field_thanh_tien['und'][0]['value'];
    }
    if ($node->field_trang_thai['und'][0]['value'] == "Dừng hoạt động") {
      $slHetHan++;
    }
    $daThanhToan += $node->field_so_tien_da_thanh_toan['und'][0]['value'];
  }
  return [
//    'date'=>date($year . "-" . $month . "-1" . " 00:00:00")."/".,
    'date' => $nodes,
    'tongGiaHan' => $tongGiaHan,
    'hanDichVu' => $hanDichVu,
    'chuKiSo' => $chuKiSo,
    'thanhLapDoanhNgiep' => $thanhLapDoanhNgiep,
    'tongDoanhSo' => $doanhSo,
    'daThanhToan' => $daThanhToan / 1000000,
    'tongHopDong' => count($nodes),
    'tiLe' => number_format($slHetHan > 0 ? $slGiaHan * 100 / $slHetHan : 0, 0, '', ','),
     'slHetHan'=>$slHetHan==0?0:($slHetHan-$slGiaHan)*100/$slHetHan,
     'slGiaHan'=>$slHetHan==0?0:$slGiaHan*100/$slHetHan,
    ];
}

function tongThu($month, $year)
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'thu_chi')
    ->fieldCondition('field_hoat_dong', 'value', 1)
    ->fieldCondition('field_phan_loai', 'value', "Thu")
    ->fieldCondition('field_ngay_nhap', 'value',   date($year . "-" .(sprintf('%02d', $month)) .'-01 00:00:00'), '>=')
    ->fieldCondition('field_ngay_nhap', 'value',  date($year . "-" .(sprintf('%02d', $month)).'-t 00:00:00'), '<=');
  $results = $query->execute();
  if (isset($results['node'])) {
    $nodes = node_load_multiple(array_keys($results['node']));
  } else {
    $nodes = [];
  }
  $tongThu = 0;
  foreach ($nodes as $node) {
      $tongThu += isset($node->field_thanh_tien['und'][0]['value']) ? $node->field_thanh_tien['und'][0]['value'] : $node->field_so_tien['und'][0]['value'];
  }
  return [
    'tongThu' => $tongThu / 1000000
  ];
}

function tongKhach($month, $year)
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'khach_hang')
    ->fieldCondition('field_hoat_dong', 'value', 1)
    ->propertyCondition('created', strtotime(date($year . "-" . $month . "-1 00:00:01")), ">=")
    ->propertyCondition('created', strtotime(date($year . "-" . $month . "-t 23:59:59")), "<=");
  $results = $query->execute();

  if (isset($results['node'])) {
    $nodes = node_load_multiple(array_keys($results['node']));
  } else {
    $nodes = [];
  }
  return [
    'tongKhach' => count($nodes)
  ];
}

function test()
{
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'thu_chi')
    ->fieldCondition('field_hoat_dong', 'value', 1)
    ->fieldCondition('field_phan_loai', 'value', "Thu")
    ->propertyCondition('created', strtotime(date("y-m-1 00:00:01")), ">=")
    ->propertyCondition('created', strtotime(date("Y-m-t 23:59:59")), "<=");
  $results = $query->execute();
  if (isset($results['node'])) {
    $nodes = node_load_multiple(array_keys($results['node']));
  } else {
    $nodes = [];
  }
  $tongThu = 0;
  $tongTien = [];
  foreach ($nodes as $node) {
    $tongThu += isset($node->field_thanh_tien['und']) ? intval($node->field_thanh_tien['und'][0]['value']) : intval($node->field_so_tien['und'][0]['value']);
    $tongTien[] = [
      'field_thanh_tien' => $node->field_thanh_tien,
      'field_tong_tien' => $node->field_tong_tien,
      'Tien' => isset($node->field_thanh_tien['und']) ? intval($node->field_thanh_tien['und'][0]['value']) : intval($node->field_so_tien['und'][0]['value']),
      'SoTien' => $tongThu,
    ];

  }
  drupal_json_output(
    [
      'data' => $nodes
    ]
  );
}

?>
