<?php if (isset($_GET['nid'])): ?>
  <?php $node = node_load($_GET['nid']) ?>
  <?php if ($node !== FALSE): ?>
    <div class="row">
      <div class="offset-lg-2 col-lg-8  col-12">
        <div class="card border-top-danger">
          <div class="card-header">
            <h3><strong><?= $node->title ?></strong></h3>
            <?= $node->field_mo_ta['und'][0]['value'] ?>
          </div>
          <div class="card-footer">
            <span class="text-danger">* Biểu thị câu hỏi bắt buộc</span>
          </div>
        </div>
        <?php foreach ($node->field_danh_sach_cau_hoi['und'] as $index => $item): ?>
          <?php $cauHoi = json_decode($item['value']) ?>
          <div class="card">
            <div class="card-body">
              <p>Câu <?= $index + 1 ?>
                : <?= $cauHoi->cau_hoi ?> <?= $cauHoi->bat_buoc == 1 ? "<span  class='text-danger'>*</span>" : "" ?></p>
              <?php if ($cauHoi->type == "1"): ?>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="dap_an[]" id="inlineRadio1" value="Đúng" checked/>
                  <label class="form-check-label" for="inlineRadio1">Đúng</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="dap_an[]" id="inlineRadio2" value="Sai"/>
                  <label class="form-check-label" for="inlineRadio2">Sai</label>
                </div>
              <?php else: ?>
                <input placeholder="Câu trả lời..." name="dap_an[]" class="form-control">
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-warning p-1">Không tìm thấy khảo sát!</div>
  <?php endif; ?>
<?php else: ?>
  <div class="alert alert-warning p-1">Không tìm thấy khảo sát!</div>
<?php endif; ?>

