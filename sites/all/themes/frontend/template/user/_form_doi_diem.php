<div class="modal fade text-start" id="modal-doi-diem" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-doi-diem">Đổi điểm</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-doi-diem">
          <input type="hidden" name="tokenForm" value="<?= getToken(); ?>">
          <input class="hidden" id="uid_u" name="uid">
          <div class="row">
            <div class="col-12 mt-1">
              <label class="form-label" for="field_vi_u">Số điểm <span class="text-danger">*</span></label>
              <input class="form-control text-right numeral-mask" id="field_vi_u" name="field_vi" placeholder="0"/>
            </div>
            <div class="col-12 mt-1">
              <label class="form-label" for="field_phan_qua_u">Phần quà <span class="text-danger">*</span></label>
              <input class="form-control" id="field_phan_qua_u" name="field_phan_qua" placeholder="Phần quà"/>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-outline-secondary waves-effect pull-left"
                data-bs-dismiss="modal">Hủy
        </button>
        <button type="button" class="btn btn-primary btn-save-doi-diem">Lưu
        </button>
      </div>
    </div>
  </div>
</div>
