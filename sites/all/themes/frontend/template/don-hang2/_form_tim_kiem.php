<?php
$trangThai = getDanhMucs(26543);
$thanhToan = getDanhMucs(26626);

?>
<form id="form-tim-kiem-danh-muc" action="/don-hang">
  <div class="row breadcrumbs-top">
    <div class="col-md-2 ">
      <input placeholder="Mã đơn" name="title" id="title" class="form-control mb-1"value="<?=isset($_GET['title']) ? $_GET['title']:''?>">
    </div>
    <div class="col-md-2 mb-1">
      <div class="position-relative">
        <select multiple name="field_trang_thai_value[]" class="form-select select2" placeholder="Trạng thái">
          <?php foreach ($trangThai as $item):?>
            <option value="<?=$item?>"><?=$item?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="col-md-2 mb-1">
      <select name="field_trang_thanh_toan_value" class="form-select" >
        <option value="All">--Thanh toán--</option>
        <?php foreach ($thanhToan as $item):?>
          <option value="<?=$item?>"><?=$item?></option>
        <?php endforeach;?>
      </select>
    </div>
    <div class="col-md-3 ">
      <div class="row">
        <div class="col-md-6">
          <input placeholder="Từ ngày" name="field_ngay_nhan_value_tu[value][date]"  class="form-control mb-1 flatpickr-customs" value="<?=isset($_GET['field_ngay_nhan_value_tu']) ? $_GET['field_ngay_nhan_value_tu']["value"]["date"]:''?>">
        </div>
        <div class="col-md-6">
          <input placeholder="Đến ngày" name="field_ngay_nhan_value_den[value][date]"  class="form-control mb-1 flatpickr-customs" value="<?=isset($_GET['field_ngay_nhan_value_den']) ? $_GET['field_ngay_nhan_value_den']["value"]["date"]:''?>">
        </div>
      </div>
    </div>
    <div class="col-md-1 mb-1">
      <button type="submit" class="btn btn-primary btn-tim-kiem-danh-muc col-12">
        <i data-feather='search'></i>
      </button>
    </div>
    <div class="col-md-1">
      <a class="btn btn-success col-12" href='/don-hang?title=&field_trang_thanh_toan_value=All&field_ngay_nhan_value_tu%5Bvalue%5D%5Bdate%5D=<?=date("m/d/Y",strtotime(date('Y-m-d')." - 1 day"))?>&field_ngay_nhan_value_den%5Bvalue%5D%5Bdate%5D=<?=date("m/d/Y",strtotime(date('Y-m-d')." + 1 day"))?>' >
        <i data-feather='refresh-ccw'></i>
      </a>
    </div>
    <?php
    global $user;
    if (!isset($user->roles[8])):
    ?>
    <div class="col-md-1">
      <a class="btn btn-outline-primary col-12" href="#" id="btn-them-moi">
        <i data-feather="plus-circle"></i>
      </a>
    </div>

    <?php endif;?>

  </div>

</form>
