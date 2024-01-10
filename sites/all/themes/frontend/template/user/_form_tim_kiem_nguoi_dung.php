<?php

?>
<form id="form-tim-kiem-nguoi-dung" action="/nguoi-dung">
  <input class="hidden" name="sort_by" id="sort_bys" value="created">
  <input class="hidden" name="sort_order" id="sort_orders" value="DESC">
  <input class="hidden" name="created[min]" id="created_min" value="<?=isset($_GET['created'])?$_GET['created']['min']:""?>">
  <input class="hidden" name="created[max]" id="created_max" value="<?=isset($_GET['created'])?$_GET['created']['max']:""?>">
  <div class="row breadcrumbs-top">
    <div class="col-md-3">
      <input placeholder="Mã..." name="field_code_value" class="form-control mb-1"
             value="<?=isset($_GET['field_code_value']) ? $_GET['field_code_value']:''?>">
    </div>

    <div class="col-md-3">
      <input placeholder="Từ ngày đến ngày" id="field_tu_den_ngay" class="form-control mb-1 flatpickr-range"
             value="<?= isset($_GET['created'])?($_GET['created']['min']!=""?($_GET['created']['min']." to ".$_GET['created']['max']):""):"" ?>">
    </div>

    <div class="col-md-2">
      <button type="submit" class="btn btn-primary btn-tim-kiem col-12">
        <i data-feather='search'></i> Tìm kiếm
      </button>
    </div>
    <div class="col-md-2 ">
      <a href="#" class="btn btn-success btn-khoi-phuc-luoi col-12">
        <i data-feather='refresh-ccw'></i> Khôi phục lưới
      </a>
    </div>
    <div class="col-md-2">
      <a class="btn btn-outline-primary col-12" href="#" id="btn-them-moi-nguoi-dung">
        <i class="me-1" data-feather="plus-circle"></i>
        <span class="align-middle">Thêm mới</span>
      </a>
    </div>
  </div>

</form>
