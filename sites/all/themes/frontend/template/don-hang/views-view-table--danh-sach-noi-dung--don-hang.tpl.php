<!-- Bordered table start -->
<?php global $user?>
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive fix-scoll">
        <table class="table table-bordered">
          <?php if (!empty($title) || !empty($caption)): ?>
            <caption><?php print $caption . $title; ?></caption>
          <?php endif; ?>
          <?php if (!empty($header)) : ?>
            <thead>
            <tr>
              <th width="1%">TT</th>
              <?php foreach ($header as $field => $label): ?>
              <?php

                ?>
                <?php if (!(isset($user->roles[8])&&in_array($field,['nothing_1','nothing_2','nothing_3']))):?>
                <th
                  width="<?= ($field == 'nothing_1' || $field == 'nothing'||$field == 'nothing_2') ? '1%' : '' ?>">
                  <?php print $label; ?>
                </th>
                <?php endif;?>
              <?php endforeach; ?>
            </tr>
            </thead>
          <?php endif; ?>
          <tbody>
          <?php foreach ($rows as $row_count => $row): ?>
            <tr>
              <td>
                <?= $row_count + 1 ?>
              </td>
              <?php foreach ($row as $field => $content): ?>
              <?php if (!(isset($user->roles[8])&&in_array($field,['nothing_1','nothing_2','nothing_3']))):?>
                <?php if ($field == 'field_trang_thai'): ?>
                    <?php $trangThai = explode("{{}}", $content)[0] ?>
                    <?php $nid = explode("{{}}", $content)[1] ?>
                    <td>
                      <?php print getListTrangThai($trangThai); ?> <?= isset($user->roles[8]) ? "" : '<a class="text-success btn-cap-nhat-trang-thai" data-value="' . $nid . '"><i data-feather="edit"></i></a>' ?>
                    </td>
                  <?php elseif ($field == 'field_trang_thanh_toan'): ?>
                    <?php $trangThai = explode("{{}}", $content)[0] ?>
                    <?php $nid = explode("{{}}", $content)[1] ?>
                    <td>
                      <?php print getListTrangThaiThanhToan($trangThai); ?> <?= isset($user->roles[8]) ? "" : '<a class="text-success btn-cap-nhat-trang-thai-thanh-toan" data-value="' . $nid . '"><i data-feather="edit"></i></a>' ?>
                    </td>
                  <?php else: ?>
                    <td>
                      <?php print $content; ?>
                    </td>
                  <?php endif;?>
              <?php endif;?>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Bordered table end -->
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
