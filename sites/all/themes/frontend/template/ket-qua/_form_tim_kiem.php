<form id="form-tim-kiem-danh-muc" action="/ket-qua-khao-sat">
  <input class="hidden" name="sort_by" id="sort_bys" value="created">
  <input class="hidden" name="sort_order" id="sort_orders" value="DESC">
  <div class="row breadcrumbs-top">
    <div class="col-md-2">
      <input placeholder="Khảo sát" name="title" id="title" class="form-control mb-1" value="<?=isset($_GET['title']) ? $_GET['title']:''?>">
    </div>
    <div class="col-md-3">
      <input placeholder="Họ tên" name="field_ho_ten_value"  class="form-control mb-1" value="<?=isset($_GET['field_ho_ten_value']) ? $_GET['field_ho_ten_value']:''?>">
    </div>
    <div class="col-md-3">
      <input placeholder="Gmail" name="mail"  class="form-control mb-1" value="<?=isset($_GET['mail']) ? $_GET['mail']:''?>">
    </div>
    <div class="col-md-2 mb-1">
      <button type="submit" class="btn btn-primary btn-tim-kiem col-12">
        <i data-feather='search'></i> Tìm kiếm
      </button>
    </div>
  </div>

</form>
