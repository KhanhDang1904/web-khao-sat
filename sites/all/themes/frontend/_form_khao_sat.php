<?php if (isset($_GET['nid'])): ?>
  <?php $node = node_load($_GET['nid']) ?>
  <?php if ($node !== FALSE): ?>
    <?php $checkKhaoSat = checKhaoSat($_GET['nid']) ?>
    <?php if ($checkKhaoSat !== FALSE): ?>
      <div class="row">
        <div class="col-md-6 offset-md-3 col-12">
          <div class="card">
            <div class="card-body">
              <div class="row ">
                <div class="text-success text-center"><i style="width: 100px;height: 100px"
                                                         data-feather='check-circle'></i></div>
                <div class="col-md-12 mt-1 text-center">
                  <h4>Gửi <?= $node->title ?> thành công</h4>
                </div>

                <div class="col-md-12 text-center">
                  <?php if (isset($_GET['uid'])): ?>
                    <?php $userCheck = user_load($_GET['uid']) ?>
                    <div><strong><i data-feather="user"></i> <?= $userCheck->field_ho_ten['und'][0]['value'] ?></strong></div>
                    <div><strong><i data-feather="mail"></i> <?= $userCheck->mail ?></strong></div>
                  <?php endif; ?>
                  Bạn đã gửi khảo sát vào ngày: <?= date("H:i d/m/Y", ($checkKhaoSat->created)) ?>
                </div>
                <div class="accordion accordion-margin" id="accordionMargin">
                  <?php $list = $checkKhaoSat->field_noi_dung_khao_sat['und'] ?>
                  <?php if (count($list) > 0): ?>
                    <?php foreach ($list as $index => $item): ?>
                      <?php $dapAn = json_decode($item['value']) ?>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingMarginOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#accordionMarginOne<?= $index ?>" aria-expanded="false"
                                  aria-controls="accordionMarginOne<?= $index ?>">
                            <strong>Câu <?= $index + 1 ?>: <?= $dapAn->cau_hoi ?></strong>
                          </button>
                        </h2>
                        <div id="accordionMarginOne<?= $index ?>" class="accordion-collapse collapse"
                             aria-labelledby="headingMarginOne"
                             data-bs-parent="#accordionMargin">
                          <div class="accordion-body ">
                            <i
                              data-feather='clipboard'></i> <?= $dapAn->dap_an == "" ? "Không có đáp án" : $dapAn->dap_an ?>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="alert alert-warning p-1">Hiện đang không có khảo sát!</div>
                  <?php endif; ?>
                </div>
                <div class="col-md-12 text-center mt-1">
                  <a class="btn-primary btn" href="/node">Quay lại</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <form id="form-khao-sat">
        <input name="nid" value="" class="hidden">
        <input name="field_khao_sat_id" value="<?= $node->nid ?>" class="hidden">
        <input type="hidden" name="tokenForm" value="<?= getToken(); ?>">
        <div class="row">
          <div class="offset-lg-2 col-lg-8  col-12">
            <div class="card border-top-danger">
              <div class="card-header">
                <div class="">
                  <h3><strong><?= $node->title ?></strong></h3>
                  <p><?= $node->field_mo_ta['und'][0]['value'] ?></p>

                </div>
              </div>
              <div class="card-footer">
                <span class="text-danger">* Biểu thị câu hỏi bắt buộc</span>
              </div>
            </div>
            <?php $page = 0 ?>
            <?php foreach ($node->field_danh_sach_cau_hoi['und'] as $index => $item): ?>
              <?php $cauHoi = json_decode($item['value']) ?>
              <?php if ($index % 3 == 0) {
                $page++;
              } ?>
              <input name="cau_hoi[]" class="hidden" value="<?= $cauHoi->cau_hoi ?>">
              <input name="bat_buoc[]" class="hidden" value="<?= $cauHoi->bat_buoc ?>">
              <input name="type[]" class="hidden" value="<?= $cauHoi->type ?>">
              <div class="card page-<?= $page ?> <?= $page > 1 ? "hidden" : "" ?>">
                <div class="card-body">
                  <p>Câu <?= $index + 1 ?>
                    : <?= $cauHoi->cau_hoi ?> <?= $cauHoi->bat_buoc == 1 ? "<span  class='text-danger required'>*</span>" : "" ?></p>
                  <?php if ($cauHoi->type == "1"): ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="dap_an[]" id="inlineRadio1" value="Đúng"
                             checked/>
                      <label class="form-check-label" for="inlineRadio1">Đúng</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="dap_an[]" id="inlineRadio2" value="Sai"/>
                      <label class="form-check-label" for="inlineRadio2">Sai</label>
                    </div>
                  <?php elseif ($cauHoi->type == 0): ?>
                    <input placeholder="Câu trả lời..." name="dap_an[]" class="form-control">
                  <?php else: ?>
                    <input placeholder="01/01/2024" name="dap_an[]" class="form-control flatpickr-basic">
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
            <div class="row" id="per_page" data-page="<?= $page ?>">
              <?php if ($page > 1): ?>
                <div class="col-12 text-right"><a data-page="1" class="btn btn-primary btn-next-page">Tiếp theo <i
                      data-feather='arrow-right'></i></a>
                </div>
              <?php else: ?>
                <div class="col-12 text-right"><a class="btn btn-success btn-send-khao-sat">Gửi <i
                      data-feather='send'></i></a></div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </form>
    <?php endif; ?>
  <?php else: ?>
    <div class="alert alert-warning p-1">Không tìm thấy khảo sát!</div>
  <?php endif; ?>
<?php else: ?>
  <div class="alert alert-warning p-1">Không tìm thấy khảo sát!</div>
<?php endif; ?>

