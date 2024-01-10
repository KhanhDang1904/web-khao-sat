<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */

global $user;

?>
<link rel="apple-touch-icon"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
      rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/css/extensions/swiper.min.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/css/extensions/toastr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/components.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/themes/semi-dark-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/core/menu/menu-types/horizontal-menu.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/pages/app-ecommerce-details.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/plugins/forms/form-number-input.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/plugins/extensions/ext-component-toastr.css">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/assets/css/style.css">
<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
     data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="<?php print $front_page ?>">
          <?php $node = node_load(26604); ?>
          <span class="brand-logo">
            <img src="<?= $node->field_ghi_chu['und'][0]['value'] ?>"/>
          </span>
          <h2 class="brand-text text-primary ms-1"></h2>
        </a>
      </li>
    </ul>
  </div>
  <div class="navbar-container d-flex content">
    <div class="bookmark-wrapper d-flex align-items-center">
      <ul class="nav navbar-nav d-xl-none">
        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
      </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ms-auto">
      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder"><?= $user->uid == 0 ? 'Khách hàng' : $user->name; ?></span>
            <span class="user-status"><?= $user->uid == 0 ? '' : array_values($user->roles)[0] ?></span>
          </div>
          <span class="avatar">
            <img class="round"
                 src="<?= $node->field_ghi_chu['und'][0]['value'] ?>"
                 alt="avatar" height="40" width="40">
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
          <?php
          global $user;
          if (!isset($user->roles[8]) && $user->uid !== 0):
            ?>
            <a class="dropdown-item" href="/ho-so-ca-nhan">
              <i class="me-50" data-feather="user"></i> Hồ sơ cá nhân
            </a>
          <?php endif; ?>
          <div class="dropdown-divider"></div>
          <?php if ($user->uid == 0): ?>
            <a class="dropdown-item" href="<?= url('user/login') ?>">
              <i class="me-50" data-feather="user"></i> Đăng nhập
            </a>
          <?php else: ?>
            <a class="dropdown-item" href="<?= url('user/logout') ?>">
              <i class="me-50" data-feather="power"></i> Đăng xuất
            </a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
  </div>
</nav>

<ul class="main-search-list-defaultlist-other-list d-none">
  <li class="auto-suggestion justify-content-between"><a
      class="d-flex align-items-center justify-content-between w-100 py-50">
      <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span>
      </div>
    </a></li>
</ul>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper">
  <div
    class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border container-xxl"
    role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item me-auto">
          <a class="navbar-brand" href="#">
            <?php $node = node_load(26604); ?>
            <span class="brand-logo">
            <img src="<?= $node->field_ghi_chu['und'][0]['value'] ?>"/>
          </span>
            <h2 class="brand-text mb-0"></h2>
          </a>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
              class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <?php print getMainMenuQLHD(); ?>
    </div>
  </div>
</div>
<!-- END: Main Menu-->

<div class="app-content content ecommerce-application">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-body">
      <!-- app e-commerce details start -->
      <section class="app-ecommerce-details">
        <div class="card">
          <!-- Product Details starts -->
          <div class="card-body">
            <?php if (isset($_GET['nid'])): ?>
              <?php $product = node_load($_GET['nid']) ?>
              <?php if ($product == FALSE): ?>
                <div class="alert alert-warning p-1">
                  Không tìm thấy thông tin sản phẩm!
                </div>
              <?php else: ?>
                <div class="row my-2">
                  <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                    <div class="d-flex align-items-center justify-content-center">
                      <img width="350px"
                        src="<?=$product->field_anh['und'][0]['value']?>"
                        class="img-fluid " alt="product image"/>
                    </div>
                  </div>
                  <div class="col-12 col-md-7">
                    <h4><?=$product->field_ten_san_pham['und'][0]['value']?></h4>
                    <span class="card-text item-company"><strong>Bởi:</strong> <a href="#" class="company-name"><?=$product->field_thuong_hieu['und'][0]['value']?></a></span>
                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                      <h4 class="item-price me-1 text-danger"><?=number_format($product->field_gia['und'][0]['value'])?> đ</h4>

                    </div>
                    <p class="card-text"><strong>Trạng thái: </strong><?=$product->field_active['und'][0]['value']==1?'<span class="badge bg-success">Còn hàng</span>':'<span class="badge bg-danger">Hết hàng</span>'?></p>
                    <p class="card-text"><strong>Cảm giác lưới:</strong> <?=$product->field_cam_giac_luoi['und'][0]['value']?></p>
                    <p class="card-text"><strong>Phân loại sản phẩm:</strong> <?=$product->field_phan_loai_san_pham['und'][0]['value']?></p>
                    <hr/>
                    <div class="product-color-options">
                      <h6><strong>Màu sắc</strong></h6>
                      <div class="d-flex">
                        <?php foreach ($product->field_mau_sac['und'] as $item): ?>
                            <label class="form-check-label mr-10 flex-wrap">
                               <span class="badge" style="margin-left: 5px; background: <?=$item['value']?>"><?=$item['value']?></span>
                            </label>
                        <?php endforeach; ?>
                      </div>
                    </div>
<!--                    <hr/>-->
<!--                    <div class="d-flex flex-column flex-sm-row pt-1">-->
<!--                      <a href="#" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0">-->
<!--                        <i data-feather="share-2"></i>-->
<!--                        <span class="">Chia sẻ</span>-->
<!--                      </a>-->
<!--                    </div>-->
                  </div>
                  <div class="col-md-12 mt-2">
                    <h4>Mô tả sản phẩm</h4>
                    <hr>
                    <?=$product->field_mo_ta['und'][0]['value']?>
                  </div>
                </div>
              <?php endif; ?>
            <?php else: ?>
              <div class="alert alert-warning p-1">
                Không tìm thấy thông tin sản phẩm!
              </div>
            <?php endif; ?>

          </div>
          <!-- Product Details ends -->

          <!-- Item features starts -->
          <div class="item-features">
            <div class="row text-center">
              <div class="col-12 col-md-4 mb-4 mb-md-0">
                <div class="w-75 mx-auto">
                  <i data-feather="award"></i>
                  <h4 class="mt-2 mb-1">Bảo đảm chất lượng</h4>
                  <h6 class="card-text">Sản phẩm bảo đảm chất lượng.</h6>
                </div>
              </div>
              <div class="col-12 col-md-4 mb-4 mb-md-0">
                <div class="w-75 mx-auto">
                  <i data-feather='credit-card'></i>
                  <h4 class="mt-2 mb-1">Tiến hành THANH TOÁN</h4>
                  <h6 class="card-text">Với nhiều PHƯƠNG THỨC.</h6>
                </div>
              </div>
              <div class="col-12 col-md-4 mb-4 mb-md-0">
                <div class="w-75 mx-auto">
                  <i data-feather='bookmark'></i>
                  <h4 class="mt-2 mb-1">Đổi sản phẩm mới</h4>
                  <h6 class="card-text">nếu sản phẩm lỗi.</h6>
                </div>
              </div>
            </div>
          </div>
          <!-- Item features ends -->

          <!-- Related Products starts -->
          <div class="card-body">
            <div class="mt-4 mb-2 text-center">
              <h3>Sản phẩm khác</h3>
            </div>
            <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
              <div class="swiper-wrapper">
                <?php foreach (getListSanPham() as $node):?>
                  <div class="swiper-slide">
                    <a href="/chi-tiet-san-pham?nid=<?=$node->nid?>">
                      <div class="img-container w-75 mx-auto py-75">
                        <img
                          src="<?=$node->field_anh['und'][0]['value']?>"
                          class="img-fluid" alt="image"/>
                      </div>
                      <div class="item-heading">
                        <h5 class=" mb-0"><strong><?=$node->field_ten_san_pham['und'][0]['value']?></strong></h5>
                      </div>
                      <div class="row mt-1">
                        <h5 class=" text-danger mb-0 col-md-7"><?=number_format($node->field_gia['und'][0]['value'])?> đ</h5>
                        <div class="col-md-5">
                          <small class="text-body">Bởi: <?=$node->field_thuong_hieu['und'][0]['value']?></small>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php endforeach;?>
              </div>
              <!-- Add Arrows -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
          <!-- Related Products ends -->
        </div>
      </section>
      <!-- app e-commerce details end -->

    </div>
  </div>
</div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
  <p class="clearfix mb-0">
    <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; <?= date("Y") ?>
      <span class="d-none d-sm-inline-block">, All rights Reserved</span>
    </span>
  </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/extensions/swiper.min.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app-menu.js"></script>
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/scripts/pages/app-ecommerce-details.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/scripts/forms/form-number-input.js"></script>
