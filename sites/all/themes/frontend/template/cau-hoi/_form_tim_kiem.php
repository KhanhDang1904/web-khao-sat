
<form id="form-tim-kiem-danh-muc" action="/cau-hoi">
  <input class="hidden" name="sort_by" id="sort_bys" value="created">
  <input class="hidden" name="sort_order" id="sort_orders" value="DESC">
  <div class="row breadcrumbs-top">
    <div class="col-md-8">
      <input placeholder="Tiêu đề" name="title" id="title" class="form-control mb-1"value="<?=isset($_GET['title']) ? $_GET['title']:''?>">
    </div>
    <div class="col-md-2 mb-1">
      <button type="submit" class="btn btn-primary btn-tim-kiem col-12">
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
        <span class="align-middle">Thêm</span>
      </a>
    </div>
    <?php endif;?>
  </div>

</form>
