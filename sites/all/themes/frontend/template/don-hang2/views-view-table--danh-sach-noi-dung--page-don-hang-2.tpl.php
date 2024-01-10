<?php

/**
 * @file
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $caption: The caption for this table. May be empty.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 *
 * @ingroup views_templates
 */
?>
<div class="card">
  <div class="table-responsive">
    <table class="table  table-bordered ">
      <thead>
      <tr>
        <th>STT</th>
        <th>Mã đơn</th>
        <th>Họ tên</th>
        <th>Điện thoại</th>
        <th>Tên Vợt</th>
        <th>Mức căng</th>
        <th>Loại cước</th>
        <th colspan="2">Trạng thái</th>
        <th>TG gửi</th>
        <th>TG nhận</th>
        <th>Ảnh</th>
        <th class="hidden">Ảnh nhận</th>
        <th>CN</th>
      </tr>

      </thead>
      <tbody>
      <?php foreach ($rows as $row_count => $row): ?>
        <?php $data = node_load($row['nid']) ?>
        <?php $product = $data->field_danh_sach_vot['und'] ?>
        <?php $jsProduct = json_decode($product[0]['value']) ?>
        <tr>
          <td rowspan="<?= count($product) ?>"><?= $row_count + 1 ?></td>
          <td rowspan="<?= count($product) ?>"><?= $data->title ?></td>
          <td rowspan="<?= count($product) ?>"><?= $row['field_khach_hang'] ?></td>
          <td rowspan="<?= count($product) ?>"><?= $row['field_dien_thoai'] ?></td>
          <td>
            <?= $jsProduct->ten_vot ?>
          </td>
          <td><?= $jsProduct->muc_cang . " " . $jsProduct->don_vi ?> </td>
          <td><?= isset($jsProduct->id)?(node_load($jsProduct->id)->title):$jsProduct->loai_cuoc ?></td>
          <td><?= getListTrangThai($jsProduct->trang_thai) ?></td>
          <td><?=  getListTrangThaiThanhToan($row['field_trang_thanh_toan']) ?></td>
          <td><?= $row['field_ngay_nhap'] ?></td>
          <td><?= $row['field_ngay_nhan'] ?></td>
          <td><?= $jsProduct->anh_truoc == "" ? "" : "<img width='50px' src='" . $jsProduct->anh_truoc . "'>" ?></td>
          <td class="hidden"><?= $jsProduct->anh_sau == "" ? "" : "<img width='50px' src='" . $jsProduct->anh_sau . "'>" ?></td>
          <td class="text-center" rowspan="<?= count($product) ?>">
            <div class="dropdown">
              <button type="button"
                      class="btn btn-sm hide-arrow py-0"
                      data-bs-toggle="dropdown">
                <i data-feather='settings'></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end text-nowrap p-1">
                <a class="text-primary btn-in" href="#" data-value="<?=$row['nid']?>">
                  <i data-feather='printer' class="m-50"></i>  In </a>
                <br>
                <?= isset($user->roles[8]) ? "" : '<a class="text-primary btn-cap-nhat-trang-thai" data-value="' . $row['nid'] . '"><i data-feather="edit" class="m-50"></i> Cập nhật trạng thái</a> <br>' ?>

                <?= isset($user->roles[8]) ? "" : '<a class="text-primary btn-cap-nhat-trang-thai-thanh-toan" data-value="' . $row['nid'] . '"><i data-feather="edit" class="m-50"></i> Cập nhật thanh toán</a> <br>' ?>

                <a class="text-info btn-xem" href="#" data-value="<?=$row['nid']?>">
                  <i data-feather="eye" class="m-50"></i> Xem
                </a>
                <br>
                <a href="#" class="text-success btn-sua" data-value="<?=$row['nid']?>">
                  <i data-feather="edit" class="m-50"></i>  Sửa
                </a>
                <br>
                <a class="text-danger  btn-xoa" href="#" data-value="<?=$row['nid']?>">
                  <i data-feather="delete" class="m-50"></i>  Xóa
                </a>

              </div>
            </div>
          </td>
        </tr>
        <?php if (count($product) > 1): ?>
          <?php foreach (range(1, count($product) - 1) as $item): ?>
            <?php $jsProduct2 = json_decode($product[$item]['value'])?>
            <tr>
              <td>
                <?= $jsProduct2->ten_vot ?>
              </td>
              <td><?= $jsProduct2->muc_cang . " " . $jsProduct2->don_vi ?></td>
              <td><?= isset($jsProduct2->id)?(node_load($jsProduct2->id)->title):$jsProduct2->loai_cuoc ?></td>
              <td><?= getListTrangThai($jsProduct2->trang_thai) ?></td>
              <td><?= getListTrangThaiThanhToan($row['field_trang_thanh_toan']) ?></td>
              <td><?= $row['field_ngay_nhap'] ?></td>
              <td><?= $row['field_ngay_nhan'] ?></td>
              <td><?= $jsProduct2->anh_truoc == "" ? "" : "<img width='50px' src='" . $jsProduct2->anh_truoc . "'>" ?></td>
              <td class="hidden"><?= $jsProduct2->anh_sau == "" ? "" : "<img width='50px' src='" . $jsProduct2->anh_sau . "'>" ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php
function getListTrangThaiThanhToan($trangThai)
{
  $arr = [
    'Đã thanh toán' => '<div class="badge bg-success"><i data-feather="check-circle"></i> Đã thanh toán</div>',
    'Thanh toán một phần' => '<div class="badge bg-warning"><i data-feather="alert-octagon"></i> Thanh toán một phần</div>',
    'Chưa thanh toán' => '<div class="badge bg-danger"><i data-feather="alert-triangle"></i> Chưa thanh toán</div>',
  ];
  return $arr[$trangThai];
}
?>
