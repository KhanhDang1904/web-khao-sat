<?php
?>
<form id="form_search_vai_tro" action="/vai-tro">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input name="name" value="<?=isset($_GET['name'])?$_GET['name']:''?>" placeholder="Tên vai trò" class="form-control">
      </div>
    </div>
    <div class="col-md-2 mb-1">
      <button type="submit" class="btn btn-primary col-12 "><i data-feather='search'></i> Tìm kiếm</button>
    </div>
    <div class="col-md-2 mb-1">
      <a href="/vai-tro" class="btn btn-success col-12 "><i data-feather='refresh-cw'></i> Khôi phục lại</a>
    </div>
    <div class="col-md-2 ">
      <a href="#" class="btn btn-outline-primary btn-them-vai-tro col-12"><i data-feather='plus'></i> Thêm mới</a
    </div>
  </div>
</form>
