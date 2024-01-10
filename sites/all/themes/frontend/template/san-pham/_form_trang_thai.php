<?php
$trangThai= getDanhMucs(26543);
?>
<div class="modal fade text-start" id="modal-don-hang-trang-thai" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-dong-hang-trang-thai">Cập nhật trạng thái</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-don-hang-trang-thai">
          <input type="hidden" name="tokenForm" value="<?= getToken(); ?>">
          <input class="hidden" id="nid" name="nid">
          <div class="row">
            <div class="col-md-12 mt-1">
              <label class="form-label" for="field_trang_thai_fm">Trạng thái</label>
              <select name="field_trang_thai" class="form-select" id="field_trang_thai_fm">
                <option value="">--Chọn--</option>
                <?php foreach ($trangThai as $item):?>
                  <option value="<?=$item?>"><?=$item?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-outline-secondary waves-effect pull-left"
                data-bs-dismiss="modal">Hủy
        </button>
        <button type="button" class="btn btn-primary btn-save-trang-thai">Lưu
        </button>
      </div>
    </div>
  </div>
</div>
