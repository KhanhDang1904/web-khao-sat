<div class="modal fade text-start" id="modal-cau-hoi" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-cau-hoi">Thêm câu hỏi </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-cau-hoi">
          <input type="hidden" name="tokenForm" value="<?= getToken(); ?>">
          <input class="hidden" id="nid" name="nid">
          <div class="row">
            <div class="col-md-12 mt-1">
              <label class="form-label" for="title_ch">Tiêu đề <span class="text-danger">*</span></label>
              <input placeholder="Tiêu đề" name="title" id="title_ch" class="form-control">
            </div>
            <div class="col-md-12 mt-1">
              <label class="form-label" for="field_mo_ta_ch">Mô tả <span class="text-danger">*</span></label>
              <textarea placeholder="Tiêu đề" name="field_mo_ta" id="field_mo_ta_ch" class="form-control"></textarea>
            </div>
            <div class="col-md-12 mt-1">
              <h4>Danh sách câu hỏi <a class="text-primary btn-add-row"><i data-feather='plus-circle'></i></a></h4>
            </div>
            <div class="col-md-12 ">
              <table class="table table-bordered table-striped">
                <tbody class="block-cau-hoi">

                </tbody>
              </table>
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

