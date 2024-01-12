<!-- Bordered table start -->
<?php global $user?>
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive fix-scoll">
        <table class="table table-bordered text-nowrap">
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
                <?php if (!((isset($user->roles[8])||$user->uid==0)&&in_array($field,['nothing_1','nothing_2','nothing_3','field_active']))):?>
                  <th
                    width="<?= ($field == 'nothing_1' || $field == 'nothing'||$field == 'nothing_2'||$field == 'field_khao_sat_id'||$field == 'field_danh_sach_cau_hoi') ? '1%' : '' ?>">
                    <?php print ($field=='field_gia'?
                      getSort('field_gia_value',$label):($field=='field_ten_san_pham'?
                        getSort('field_ten_san_pham_value',$label):($field=='field_noi_bat'?
                          getSort('field_noi_bat_value',$label):$label))); ?>
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
                  <?php if ($field == 'field_active'): ?>
                    <?php $trangThai = explode("{{}}", $content)[0] ?>
                    <?php $nid = explode("{{}}", $content)[1] ?>
                    <td width="1%">
                      <div class="form-check form-switch form-check-success text-right">
                        <input type="checkbox" class="form-check-input btn-active" id="customSwitch<?=$nid?>" value="<?=$trangThai?>" <?=$trangThai==1?'checked':''?> data-value="<?=$nid?>"  />
                        <label class="form-check-label" for="customSwitch<?=$nid?>">
                          <span class="switch-icon-left"><i data-feather="check"></i></span>
                          <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                      </div>                    </td>
                  <?php else: ?>
                    <td class="<?=$field=="field_gia"||$field=="field_khao_sat_id"||$field=="field_danh_sach_cau_hoi"?'text-center':''?>">
                      <?php print $content; ?>
                    </td>
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
function getSort($field,$label){
  $butonSort= '<div class="d-flex align-items-center">'.$label.' <a class="btn-sort" data-sort="DESC"   data-value="'.$field.'"><span class="d-flex flex-column"><i data-feather="chevron-up"></i><i data-feather="chevron-down"></i></span> </a></div>';
  if(isset($_GET['sort_by'])){
    if ($_GET['sort_by']==$field){
      if ($_GET['sort_order']=='DESC'){
        $butonSort='<div class="d-flex">'.$label.'<a class="btn-sort" data-sort="ASC" data-value="'.$field.'"><i data-feather="chevron-down"></i></a></div>';
      }else{
        $butonSort= '<div class="d-flex">'.$label.'<a class="btn-sort" data-sort="DESC" data-value="'.$field.'"><i data-feather="chevron-up"></i></a></div>';
      }
    }
  }
  return $butonSort;
}
