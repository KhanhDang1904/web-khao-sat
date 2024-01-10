<?php
?>
<div class="modal fade text-start" id="modal-vai-tro" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-vai-tro">Thêm vai trò</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-vai-tro">
          <input type="hidden" name="tokenForm" value="<?=getToken(); ?>">
          <input class="hidden" id="roleID" name="roleID">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <label class="form-label">Tên vai trò <span class="text-danger">*</span></label>
                  <input  class="form-control name mt-1" name="name" placeholder="Tên vai trò"/>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-outline-secondary waves-effect pull-left"
                data-bs-dismiss="modal">Hủy
        </button>
        <button type="button" class="btn btn-primary btn-save-vai-tro">Lưu
        </button>
      </div>
    </div>
  </div>
</div>

