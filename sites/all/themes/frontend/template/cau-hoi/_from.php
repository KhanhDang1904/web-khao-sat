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
              <textarea placeholder="Tiêu đề" name="field_mo_ta" id="title_ch" class="form-control"></textarea>
            </div>
            <div class="col-md-12 mt-1">
              <h4>Danh sách câu hỏi <a class="text-primary btn-add-row"><i data-feather='plus-circle'></i></a></h4>
            </div>
            <div class="col-md-12 ">
              <table class="table table-bordered table-striped">
                <tbody class="block-cau-hoi">
                <tr>
                  <td >
                    <div class="row">
                      <div class="col-md-8 col-12 mb-1 mb-md-0">
                        <label class="form-label">Câu hỏi</label>
                        <input type="text" class="form-control" name="cau_hoi[]" placeholder="Câu hỏi"
                               aria-describedby="button-addon2"/>
                      </div>
                      <div class="col-md-2 col-6">
                        <label class="form-label">Yêu cầu</label>
                        <select name="bat_buoc[]" class="form-select ">
                          <option value="1">Bắt buộc</option>
                          <option value="0">Không bắt buộc</option>
                        </select>
                      </div>
                      <div class="col-md-2 col-6">
                        <label class="form-label">Loại</label>
                        <select name="type[]" class="form-select ">
                          <option value="1">Đúng/Sai</option>
                          <option value="0">Văn bản</option>
                        </select>
                      </div>
                    </div>
                  </td>
                  <td width="1%" class="text-center">
                    <a class=" btn-xoa-dong " type="button"><i data-feather='trash-2' class="text-danger"></i></a>
                  </td>
                </tr>
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

