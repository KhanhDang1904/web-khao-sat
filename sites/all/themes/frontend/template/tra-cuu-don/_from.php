<?php
  $loaiLuoi = getLoaiCuoc();
  $mauLuoi = getDanhMucs(26522);
  $trangThai = getDanhMucs(26543);
  $donVi = getDanhMucs(26590);
?>
<div class="modal fade text-start" id="modal-don-hang" tabindex="-1"
     aria-labelledby="myModalLabel20" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="title-modal-dong-hang">Thêm đơn hàng</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-don-hang">
          <input type="hidden" name="tokenForm" value="<?= getToken(); ?>">
          <input class="hidden" id="nid" name="nid">
          <div class="row">
            <div class="col-md-3 mt-1">
              <label class="form-label" for="field_khach_hang_id_form">Tên khách hàng <span class="text-danger">*</span></label>
              <div class="position-relative">
                <select class="form-select select2-data-ajax  name" name="field_khach_hang_id" id="field_khach_hang_id_form" >

                </select>
              </div>
            </div>
            <div class="col-md-3 mt-1">
              <input id="field_khach_hang_form" name="field_khach_hang" class="hidden">
              <label class="form-label" for="field_dien_thoai_form">Điện thoại <span class="text-danger">*</span></label>
              <input class="form-control name" name="field_dien_thoai" id="field_dien_thoai_form" placeholder="Điện thoại"/>
            </div>
            <div class="col-md-3 mt-1">
              <label class="form-label " for="field_ngay_nhap_form">Ngày gia hạn <span class="text-danger">*</span></label>
              <input class="form-control flatpickr-date-time" name="field_ngay_nhap" id="field_ngay_nhap_form" placeholder="Ngày nhập" value="<?=date("Y-m-d H:i")?>"/>
            </div>
            <div class="col-md-3 mt-1">
              <label class="form-label" for="field_ngay_nhan_form">Ngày trả</label>
              <input class="form-control flatpickr-date-time" name="field_ngay_nhan" id="field_ngay_nhan_form" placeholder="Ngày nhận" />
            </div>
            <div class="col-md-12 mt-1">
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap" id="danh_sach_vot">
                  <thead>
                  <tr>
                    <th width="15%">Tên vợt <a class="text-info btn-them-row"><i data-feather='plus-circle'></i></a></th>
                    <th width="15%">Tình trạng</th>
                    <th width="25%">Loại cước</th>
                    <th width="15%">Trạng thái</th>
                    <th >Yêu cầu khác</th>
                    <th  width="1%">#</th>
                  </tr>
                  </thead>
                  <tbody id="listbody">
                    <tr class="block-row hidden">
                      <td><input placeholder="Tên vợt" name="ten_vot[]"  class="form-control "></td>
                      <td><input placeholder="Tình trạng" name="tinh_trang[]" class="form-control"></td>
                      <td class="max-width-100">
                        <div>
                          <select  class="form-select load_cuoc_select">
                            <option value="">--Chọn--</option>
                            <?php foreach ($loaiLuoi as $item):?>
                              <option value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
                        <div class="col-12 text-right mt-1 block_total_price hidden text-danger">
                          Giá:  <span class="total_price"></span> đ
                          <input class="total_price_input hidden" name="price[]">
                        </div>
                        <input name="loai_cuoc[]" class="ten_san_pham hidden" >
                      </td>

                      <td>
                        <img src="_from.php" width="">
                        <fieldset>
                          <div class="input-group">
                            <input type="text" class="form-control numeral-mask text-right " style="min-width: 50px" name="muc_cang[]" placeholder="0" />
                            <select name="don_vi[]" class="form-select">
                              <?php foreach ($donVi as $item):?>
                                <option value="<?=$item?>"><?=$item?></option>
                              <?php endforeach;?>
                            </select>
                          </div>
                        </fieldset>
                        <select name="trang_thai[]" class="form-select mt-1">
                          <option value="">--Trạng thái--</option>
                          <?php foreach ($trangThai as $item):?>
                            <option value="<?=$item?>"><?=$item?></option>
                          <?php endforeach;?>
                        </select>
                      </td>
                      <td>
                        <textarea class="form-control" name="yeu_cau_khac[]" rows="2"></textarea>
                      </td>
                      <td class="text-center"><a class="text-danger btn-remove-row"><i data-feather='delete'></i></a></td>
                    </tr>

                  </tbody>
                  <tfoot>
                  <tr>
                    <td>
                      Tổng tiền:
                    </td>
                    <td colspan="2" >
                      <input
                        class="form-control numeral-mask text-right text-danger" placeholder="Tổng tiền thanh toán" name="field_tong_tien" id="field_tong_tien_form">
                    </td>
                    <td>
                      Khách trả:
                    </td>
                    <td colspan="2">
                      <input class="form-control numeral-mask text-right text-danger" placeholder="Khách trả" name="field_khach_tra" id="field_khach_tra_form">
                    </td>
                  </tr>
                  </tfoot>
                </table>

              </div>
            </div>
            <div class="col-md-12 ">
              <label class="form-label " for="field_ghi_chu_form">Ghi chú</label>
              <textarea class="form-control" name="field_ghi_chu" id="field_ghi_chu_form" ></textarea>
            </div>
            <div class="col-md-3 mt-1">
              <label class="form-label " for="field_trang_thai_form">Trạng thái</label>
              <select name="field_trang_thai" class="form-select" id="field_trang_thai_form">
                <option value="">--Chọn--</option>
                <?php foreach ($trangThai as $item):?>
                  <option value="<?=$item?>"><?=$item?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-9 mt-1">
              <label class="form-label " for="field_anh_form">Hình ảnh</label>
              <input type="file" class="form-control" multiple name="field_anh[]" accept="image/*" id="field_anh_form" ></input>
            </div>
            <div id="list_image" class="row">

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
