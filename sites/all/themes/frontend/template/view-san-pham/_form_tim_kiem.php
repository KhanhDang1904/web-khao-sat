<?php
$trangThai = getDanhMucs(26543);
$thanhToan = getDanhMucs(26626);

?>
<form id="form-tim-kiem-danh-muc" action="/san-pham">
  <div class="row breadcrumbs-top">
    <div class="col-md-4 ">
      <input placeholder="Mã sản phẩm" name="title" id="title" class="form-control mb-1"value="<?=isset($_GET['title']) ? $_GET['title']:''?>">
    </div>
    <div class="col-md-4 ">
      <input placeholder="Tên sản phẩm" name="field_ten_san_pham_value" id="title" class="form-control mb-1" value="<?=isset($_GET['field_ten_san_pham_value']) ? $_GET['field_ten_san_pham_value']:''?>">
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
  </div>

</form>
