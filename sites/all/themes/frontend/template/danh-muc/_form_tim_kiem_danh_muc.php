<?php

?>
<form id="form-tim-kiem-danh-muc">
  <div class="row breadcrumbs-top">
    <div class="col-md-6">
      <input placeholder="Tên danh mục" name="title" id="title" class="form-control mb-1"value="<?=isset($_GET['title']) ? $_GET['title']:''?>">
    </div>
    <div class="col-md-2 mb-1">
      <a href="#" class="btn btn-primary btn-tim-kiem-danh-muc col-12">
        <i data-feather='search'></i> Tìm kiếm
      </a>
    </div>
    <div class="col-md-2 mb-1">
      <a href="#" class="btn btn-success btn-khoi-phuc-luoi col-12">
        <i data-feather='refresh-ccw'></i> Khôi phục lưới
      </a>
    </div>
    <div class="col-md-2">
      <a class="btn btn-outline-primary col-12" href="#" id="btn-them-moi-danh-muc">
        <i class="me-1" data-feather="plus-circle"></i>
        <span class="align-middle">Thêm mới</span>
      </a>
    </div>
  </div>

</form>
