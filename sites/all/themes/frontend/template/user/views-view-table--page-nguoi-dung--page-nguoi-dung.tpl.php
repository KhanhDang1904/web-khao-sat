<!-- Bordered table start -->
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

                <th
                  width="<?= (
                    $field == 'nothing_1' ||
                    $field == 'field_code'||
                    $field == 'nothing_2'||
                    $field == 'nothing_3'||
                    $field == 'nothing'||
                    $field=='field_vi'||
                    $field=='field_total_money'
                  ) ? '1%' : '' ?>">
                  <?php print ($field=='field_total_money'?getSort('field_total_money_value',$label):($field=='created'?getSort('created',$label):$label)); ?>
                </th>
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
                <td class="<?= in_array($field,['field_vi','field_total_money','nothing_2','nothing_3'])?'text-right':''?>">
                  <?php print $content; ?>
                </td>
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
?>
