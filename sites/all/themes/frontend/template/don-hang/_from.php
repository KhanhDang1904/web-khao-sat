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
                <select class="form-select select2-data-ajax  name" name="field_khach_hang_id"
                        id="field_khach_hang_id_form">

                </select>
              </div>
            </div>
            <div class="col-md-3 mt-1">
              <input id="field_khach_hang_form" name="field_khach_hang" class="hidden">
              <label class="form-label" for="field_dien_thoai_form">Điện thoại <span
                  class="text-danger">*</span></label>
              <input class="form-control name" name="field_dien_thoai" id="field_dien_thoai_form"
                     placeholder="Điện thoại"/>
            </div>
            <div class="col-md-3 mt-1">
              <label class="form-label " for="field_ngay_nhap_form">Ngày gia hạn <span
                  class="text-danger">*</span></label>
              <input class="form-control flatpickr-date-time" name="field_ngay_nhap" id="field_ngay_nhap_form"
                     placeholder="Ngày nhập" value="<?= date("Y-m-d H:i") ?>"/>
            </div>
            <div class="col-md-3 mt-1">
              <label class="form-label" for="field_ngay_nhan_form">Ngày trả</label>
              <input class="form-control flatpickr-date-time" name="field_ngay_nhan" id="field_ngay_nhan_form"
                     placeholder="Ngày nhận"  value="<?= date("Y-m-d H:i",strtotime( '+1 day',strtotime(date("Y-m-d H:i")))) ?>"/>
            </div>
            <div class="col-md-12 mt-1">
              <table class="table table-bordered text-nowrap" id="danh_sach_vot">
                <thead>
                <tr>
                  <th>Danh sách <a class="text-info btn-them-row"><i data-feather='plus-circle'></i></a></th>
                  <th width="1%">#</th>
                </tr>
                </thead>
                <tbody id="listbody">
                <tr class="block-row hidden">
                  <td>
                    <div class="row">
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Tên vợt <span class="text-danger">*</span></label>
                            <input placeholder="Tên vợt" name="ten_vot[]" class="form-control ">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Tình trạng</label>
                            <input placeholder="Tình trạng" name="tinh_trang[]" class="form-control">
                          </div>
                          <div class="col-md-2 mb-1">
                            <label>Ảnh trước</label>
                            <input type="file" class="form-control"
                                   name="anh_truoc[]"/>
                          </div>
                          <div class="col-md-2 mb-1">
                            <label>Ảnh sau</label>
                            <input type="file" class="form-control"
                                   name="anh_sau[]"/>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Loại cước</label>
                            <div class="max-width-100">
                              <select class="form-select load_cuoc_select">
                                <option value="">--Chọn--</option>
                                <?php foreach ($loaiLuoi as $item): ?>
                                  <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-12 text-right mt-1 block_total_price hidden text-danger">
                              Giá: <span class="total_price"></span> đ
                              <input class="total_price_input hidden" name="price[]">
                            </div>
                            <input name="loai_cuoc[]" class="ten_san_pham hidden">
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Mức căng</label>
                            <fieldset>
                              <div class="input-group">
                                <input type="text" class="form-control numeral-mask text-right " style="min-width: 50px"
                                       name="muc_cang[]" placeholder="0"/>
                                <select name="don_vi[]" class="form-select">
                                  <?php foreach ($donVi as $item): ?>
                                    <option value="<?= $item ?>"><?= $item ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label class="form-label">Trạng thái</label>
                            <fieldset class="d-flex flex-column flex-md-row flex-md-wrap" >
                              <?php foreach ($trangThai as $item): ?>
                                <div class="mr-10">
                                  <label>
                                    <input name="trang_thai[]"  class="form-radio" type="radio"
                                           value="<?= $item ?>"> <?= $item ?>
                                  </label>
                                </div>
                              <?php endforeach; ?>
                            </fieldset>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Yêu cầu</label>
                        <textarea class="form-control" name="yeu_cau_khac[]" rows="4"></textarea>
                      </div>
                    </div>
                  </td>
                  <td class="text-center"><a class="text-danger btn-remove-row"><i data-feather='delete'></i></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <td colspan="2">
                    <div class="row">
                      <div class="col-md-6">
                        <label class="form-label">Tổng tiền</label>
                        <input class="form-control numeral-mask text-right text-danger"
                               placeholder="Tổng tiền thanh toán"
                               name="field_tong_tien" id="field_tong_tien_form">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Khách trả</label>
                        <div class="row">
                          <div class="col-md-6">
                            <fieldset class="d-flex flex-column flex-md-row flex-md-wrap" >
                              <div class="mr-10">
                                <label>
                                  <input name="trang_thai_thanh_toan"  class="form-radio input-thanh-toan" type="radio"
                                         value="Chưa thanh toán"> Chưa thanh toán
                                </label>
                              </div>
                              <div class="mr-10">
                                <label>
                                  <input name="trang_thai_thanh_toan"  class="form-radio input-thanh-toan" type="radio"
                                         value="Thanh toán một phần"> Thanh toán một phần
                                </label>
                              </div>
                              <div class="mr-10">
                                <label>
                                  <input name="trang_thai_thanh_toan"  class="form-radio input-thanh-toan" type="radio"
                                         value="Đã thanh toán"> Đã thanh toán
                                </label>
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6">
                            <input readonly class="form-control numeral-mask text-right text-danger" placeholder="Khách trả"
                                   name="field_khach_tra" id="field_khach_tra_form">
                          </div>

                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                </tfoot>
              </table>

            </div>
            <div class="col-md-12 ">
              <label class="form-label " for="field_ghi_chu_form">Ghi chú</label>
              <textarea class="form-control" name="field_ghi_chu" id="field_ghi_chu_form"></textarea>
            </div>
            <div class="col-md-3 mt-1">
              <label class="form-label " for="field_trang_thai_form">Trạng thái</label>
              <fieldset class="d-flex flex-column flex-md-row flex-md-wrap" >
                <?php foreach ($trangThai as $item): ?>
                  <div class="mr-10">
                    <label>
                      <input name="field_trang_thai"  class="form-radio input_field_trang_thai" type="radio"
                             value="<?= $item ?>"> <?= $item ?>
                    </label>
                  </div>
                <?php endforeach; ?>
              </fieldset>
            </div>
            <div class="col-md-9 mt-1">
              <label class="form-label " for="field_anh_form">Hình ảnh</label>
              <input type="file" class="form-control" multiple name="field_anh[]" accept="image/*"
                     id="field_anh_form"></input>
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
