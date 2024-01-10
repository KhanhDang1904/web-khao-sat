<?php
$mauSac = getDanhMucs(26718);
$thuongHieu = getDanhMucs(26708);

?>
<div class="modal fade text-start" id="modal-san-pham" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-san-pham">Thêm sản phẩm </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-san-pham">
          <input type="hidden" name="tokenForm" value="<?= getToken(); ?>">
          <input class="hidden" id="nid" name="nid">
          <div class="row">
            <div class="col-md-6 mt-1">
              <label class="form-label" for="title_sp">Mã sản phẩm</label>
              <input placeholder="Mã sản phẩm" name="title" id="title_sp" class="form-control">
            </div>
            <div class="col-md-6 mt-1">
              <label class="form-label" for="field_ten_san_pham_sp">Tên sản phẩm <span
                  class="text-danger">*</span></label>
              <input placeholder="Tên sản phẩm" name="field_ten_san_pham" id="field_ten_san_pham_sp"
                     class="form-control">
            </div>
            <div class="col-md-6 mt-1">
              <label class="form-label" for="field_gia_sp">Giá <span class="text-danger">*</span></label>
              <input placeholder="0" name="field_gia" id="field_gia_sp" class="form-control numeral-mask text-right">
            </div>
            <div class="col-md-6 mt-1">
              <label class="form-label" for="field_thuong_hieu_sp">Thương hiệu <span
                  class="text-danger">*</span></label>
              <select placeholder="-- Chọn --" name="field_thuong_hieu" id="field_thuong_hieu_sp" class="form-select ">
                <?php foreach ($thuongHieu as $item): ?>
                  <option value="<?= $item ?>"><?= $item ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-6 mt-1">
              <label class="form-label">Loại sản phẩm</label>
              <div class="d-flex">
                <?php foreach (getDanhMucs(26766) as $item): ?>
                  <label class="form-check-label mr-10 flex-wrap">
                    <input type="radio"
                           value="<?= $item ?>"
                           name="field_phan_loai_san_pham"
                           class="form-radio field_phan_loai_san_pham_sp"/><span style="margin-left: 5px"><?= $item ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="col-6 mt-1">
              <label class="form-label">Cảm giác lưới</label>
              <div class="d-flex">
                <?php foreach (getDanhMucs(26750) as $item): ?>
                  <label class="form-check-label mr-10 flex-wrap">
                    <input type="radio"
                           value="<?= $item ?>"
                           name="field_cam_giac_luoi"
                           class="form-radio field_cam_giac_luoi_sp"/><span style="margin-left: 5px"><?= $item ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="col-12 mt-1">
              <label class="form-label">Màu sắc</label>
              <div class="d-flex flex-wrap ">
                <?php foreach (getDanhMucs(26718) as $item): ?>
                  <label class="form-check-label mr-10 flex-wrap mb-1">
                    <input type="checkbox"
                           value="<?= $item ?>"
                           name="field_mau_sac[]"
                           class="form-check-input"/><span style="margin-left: 5px; background: <?= $item ?>" class="badge"><?= $item ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="col-12 mt-1">
              <label for="editor">Mô tả</label>
              <textarea id="editor" rows="8">

              </textarea>
            </div>
            <div class="col-3 mt-1">
              <label class="form-label" for="field_noi_bat_sp">Nổi bật </label>
              <input name="field_noi_bat"  id="field_noi_bat_sp" type="number" class="form-control text-right ">
            </div>
            <div class="col-9 mt-1">
              <label class="form-label" for="field_anh_sp">Ảnh sản phẩm </label>
              <input name="field_anh[]"  id="field_anh_sp" type="file" class="form-control ">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button"
                class="btn btn-outline-secondary waves-effect pull-left"
                data-bs-dismiss="modal">Hủy
        </button>
        <button type="button" class="btn btn-primary btn-save">Lưu
        </button>
      </div>
    </div>
  </div>
</div>

