<?php
  $loaiLuoi = getDanhMucs(26521);
  $mauLuoi = getDanhMucs(26522);
  $trangThai = getDanhMucs(26543);
  $donVi = getDanhMucs(26590);
?>
<div class="modal fade text-start" id="modal-san-pham" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
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
            <div class="col-12 mt-1">
              <label class="form-label" for="title_sp">Mã sản phẩm</label>
              <input placeholder="Mã sản phẩm" name="title" id="title_sp" class="form-control">
            </div>
            <div class="col-12 mt-1">
              <label class="form-label" for="field_ten_san_pham_sp">Tên sản phẩm <span class="text-danger">*</span></label>
              <input placeholder="Tên sản phẩm" name="field_ten_san_pham" id="field_ten_san_pham_sp" class="form-control">
            </div>
            <div class="col-12 mt-1">
              <label class="form-label" for="field_gia_sp">Giá <span class="text-danger">*</span></label>
              <input placeholder="0" name="field_gia" id="field_gia_sp" class="form-control numeral-mask text-right">
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
