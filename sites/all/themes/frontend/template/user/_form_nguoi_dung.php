<div class="modal fade text-start" id="modal-nguoi-dung" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-nguoi-dung">Thêm người dùng</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-nguoi-dung">
          <input type="hidden" name="tokenForm" value="<?=getToken(); ?>">
          <input class="hidden" id="uid" name="uid">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <div class="control-label">
                  <label>Tên đăng nhập <span class="text-danger">*</span></label>
                  <input  class="form-control name mt-1" name="name" placeholder="Tên đăng nhập"/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="control-label">
                  <label>Mật khẩu </label>
                  <input type="password" class="form-control password mt-1" name="password" placeholder="Mật khẩu"/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="control-label">
                  <label>Họ tên <span class="text-danger">*</span></label>
                  <input class="form-control field_ho_ten mt-1" name="field_ho_ten" placeholder="Họ tên"/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="control-label">
                  <label>Điện thoại <span class="text-danger">*</span></label>
                  <input class="form-control field_dien_thoai mt-1" name="field_dien_thoai" placeholder="Điện thoại"/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="control-label">
                  <label>Email </label>
                  <input class="form-control field_email mt-1" name="field_email" placeholder="Email"/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <div class="control-label">
                  <label for="field_ngay_sinh_thanh_lap_user">Ngày sinh </label>
                  <input type="text"  name="field_ngay_sinh_thanh_lap" class="form-control mt-1 flatpickr-basic field_ngay_sinh_thanh_lap" placeholder="Ngày sinh"   />
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <div class="control-label">
                  <label for="field_dia_chi_user">Địa chỉ</label>
                  <input class="form-control field_dia_chi mt-1" name="field_dia_chi" id="field_dia_chi_user" placeholder="Địa chỉ"/>
                </div>
              </div>
            </div>
            <div class="demo-inline-spacing field-role">

            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-outline-secondary waves-effect pull-left"
                data-bs-dismiss="modal">Hủy
        </button>
        <button type="button" class="btn btn-primary btn-save-user">Lưu
        </button>
      </div>
    </div>
  </div>
</div>
