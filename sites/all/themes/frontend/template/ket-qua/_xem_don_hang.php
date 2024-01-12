<div class="modal fade text-start" id="modal-xem-don-hang" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-dong-hang">Xem đơn hàng</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="table-responsive" id="table-trang-thai">
          <table class="table table-bordered text-nowrap">
            <thead>
            <tr>
              <th width="1%">STT</th>
              <th width="1%">Ngày</th>
              <th >Trạng thái</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
              <td colspan="4" class="text-center">
                <div class="row">
                  <div class="col-1">
                    <select name="limit" id="table_limit" class="form-select">
                      <option value="10" selected>10</option>
                      <option value="20">20</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                  </div>
                  <div class="col-11">
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
        <button type="button" class="btn btn-primary btn-save">Lưu
        </button>
      </div>
    </div>
  </div>
</div>
