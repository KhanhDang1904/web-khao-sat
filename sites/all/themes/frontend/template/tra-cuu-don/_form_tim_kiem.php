<?php
$trangThai = getDanhMucs(26543);
$thanhToan = getDanhMucs(26626);

?>
<form id="form-tim-kiem-danh-muc" action="/tra-cuu-don">
  <div class="row breadcrumbs-top">
    <div class="col-md-2 ">
      <input placeholder="Mã đơn" name="title" id="title" class="form-control mb-1"value="<?=isset($_GET['title']) ? $_GET['title']:''?>">
    </div>
    <div class="col-md-2 mb-1">
        <select name="field_trang_thai_value" class="form-select" >
          <option value="All">--Trạng thái--</option>
          <?php foreach ($trangThai as $item):?>
            <option value="<?=$item?>"><?=$item?></option>
          <?php endforeach;?>
        </select>
    </div>
    <div class="col-md-2 mb-1">
      <select name="field_trang_thanh_toan_value" class="form-select" >
        <option value="All">--Thanh toán--</option>
        <?php foreach ($thanhToan as $item):?>
          <option value="<?=$item?>"><?=$item?></option>
        <?php endforeach;?>
      </select>
    </div>
    <div class="col-md-2 mb-1">
      <button type="submit" class="btn btn-primary btn-tim-kiem-danh-muc col-12">
        <i data-feather='search'></i> Tìm kiếm
      </button>
    </div>
    <?php
    global $user;
    if (!isset($user->roles[8])):
    ?>
    <div class="col-md-2">
      <a class="btn btn-outline-primary col-12" href="#" id="btn-them-moi">
        <i class="me-1" data-feather="plus-circle"></i>
        <span class="align-middle">Thêm mới</span>
      </a>
    </div>
    <?php endif;?>
    <div class="col-md-2 mb-1 flex-column d-flex flex-column justify-content-center">
      <div class="form-check form-switch form-check-success">
        <input type="checkbox" class="form-check-input" id="customSwitch111"  />
        <label class="form-check-label" for="customSwitch111">
          <span class="switch-icon-left"><i data-feather="check"></i></span>
          <span class="switch-icon-right"><i data-feather="x"></i></span>
        </label>
      </div>
    </div>
  </div>

</form>
