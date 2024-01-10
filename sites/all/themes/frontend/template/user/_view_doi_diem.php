<div class="modal fade text-start" id="modal-view-doi-diem" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-doi-diem">Lịch sử đổi điểm</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive" id="table-lich-su-doi-diem">
          <table class="table table-bordered text-nowrap">
            <thead>
            <tr>
              <th width="1%">STT</th>
              <th width="1%">Ngày</th>
              <th >Họ tên</th>
              <th >Số điểm</th>
              <th >Phần quà</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
              <td colspan="5" class="text-center">
                <div class="row">
                  <div class="col-2">
                    <select name="limit" id="table_limit" class="form-select">
                      <option value="10" selected>10</option>
                      <option value="20">20</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                  </div>
                  <div class="col-10">
                    <ul class="pagination justify-content-start ">

                    </ul>
                  </div>

                </div>
              </td>
            </tr>
            </tfoot>
          </table>
        </div>
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
