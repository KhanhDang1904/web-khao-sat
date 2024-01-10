<form id="form_search_phan_quyen" action="/phan-quyen">
  <div class="row">
    <div class="col-8">
      <div class="form-group">
        <input name="name" value="<?=isset($_GET['name'])?$_GET['name']:''?>" placeholder="Tên chức năng" class="form-control">
      </div>
    </div>
    <div class="col-4">
      <button type="submit" class="btn btn-primary "><i data-feather='search'></i> Tìm kiếm</button>
      <a href="/phan-quyen" class="btn btn-success ml-10"><i data-feather='refresh-cw'></i> Khôi phục lại</a>
    </div>
  </div>
</form>
