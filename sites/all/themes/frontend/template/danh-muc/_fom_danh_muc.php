<div class="modal fade text-start" id="modal-danh-muc" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-danh-muc">Thêm danh-muc</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-danh-muc">
          <input type="hidden" name="tokenForm" value="<?= getToken(); ?>">
          <input class="hidden" id="nid" name="nid">
          <div class="row">
            <div class="col-12">
              <label class="form-label" for="title_form">Tên danh mục <span class="text-danger">*</span></label>
              <input class="form-control name" name="title" id="title_form" placeholder="Tên danh mục"/>
            </div>
            <h5 class="mt-1">Danh sách tử loại <a href="#" class="text-primary btn-them-dong"><i data-feather='plus-circle'></i></a></h5>
            <div class=" col-12 danh-sach-tu-loai">
              <div class="input-group mb-1">
                <input type="text" class="form-control" name="field_ghi_chu_form[]" placeholder="Từ loại" aria-describedby="button-addon2" />
                <button class="btn btn-xoa-dong btn-outline-primary"  type="button"><i data-feather='trash-2' class="text-danger"></i></button>
              </div>
            </div>
<!--           <div class="col-12 mt-1">-->
<!--               Ghi chú: <span class="text-danger">Danh sách từ liệu mỗi loại nằm trên một dòng!</span>-->
<!--           </div>-->
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-outline-secondary waves-effect pull-left"
                data-bs-dismiss="modal">Hủy
        </button>
        <button type="button" class="btn btn-primary btn-save-danh-muc">Lưu
        </button>
      </div>
    </div>
  </div>
</div>
