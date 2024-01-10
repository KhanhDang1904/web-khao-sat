<!-- Bordered table start -->
<?php global $user?>
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
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
                    width="<?= ($field == 'nothing_1' || $field == 'nothing'||$field == 'nothing_2') ? '1%' : '' ?>">
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
                <?php if (!((isset($user->roles[8])||$user->uid==0)&&in_array($field,['nothing_1','nothing_2','nothing_3','field_active']))):?>
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
                    <td class="<?=$field=="field_gia"?'text-right':''?>">
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
