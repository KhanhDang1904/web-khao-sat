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
if ($user->uid != 0) {
  if (isset($user->roles[8]))
    header('location: /view-san-pham');
  else
    header('location: /san-pham');
}
?>
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/css/extensions/nouislider.min.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/css/extensions/toastr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/colors.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/components.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/themes/semi-dark-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/core/menu/menu-types/horizontal-menu.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/plugins/extensions/ext-component-sliders.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/pages/app-ecommerce.css">
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/css/plugins/extensions/ext-component-toastr.css">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css"
      href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//assets/css/style.css">
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
      <li class="nav-item dropdown dropdown-notification me-25">
        <a class="nav-link" href="#" data-bs-toggle="dropdown">
          <i class="ficon" data-feather="bell"></i>
          <span class="badge rounded-pill bg-danger badge-up">5</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
          <li class="dropdown-menu-header">
            <div class="dropdown-header d-flex">
              <h4 class="notification-title mb-0 me-auto">Thông báo</h4>
              <div class="badge rounded-pill badge-light-primary">6 Thông báo mới</div>
            </div>
          </li>
          <li class="scrollable-container media-list">
            <?php
            module_load_include('inc', 'webform', 'includes/webform.submissions');
            $submissions = webform_get_submissions(array('nid' => 26686));
            array_multisort($submissions);
            foreach ($submissions as $submission) {
              print ' <a class="d-flex" href="#">
            <div class="list-item d-flex align-items-start">
              <div class="me-1">
                <div class="avatar bg-light-warning">
                  <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                </div>
              </div>
              <div class="list-item-body flex-grow-1">
                <p class="media-heading">
                  <span class="fw-bolder">' . $submission->data[1][0] . ' </span>
                </p>
                <small class="notification-text">' . date("d/m/y H:i", $submission->submitted) . '</small>
              </div>
            </div>
          </a>';
            }
            ?>
          </li>

          <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Xem tất cả</a></li>
        </ul>
      </li>
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
    <div class="content-detached content-right">
      <div class="content-body">
        <!-- E-commerce Content Section Starts -->
        <!-- E-commerce Content Section Starts -->

        <!-- background Overlay when sidebar is shown  starts-->
        <div class="body-content-overlay"></div>
        <!-- background Overlay when sidebar is shown  ends-->

        <!-- E-commerce Search Bar Starts -->
        <form action="/view-san-pham">
          <input name="sort_by" class="hidden sort_by_page">
          <input name="sort_order" class="hidden sort_order_page">
          <section id="ecommerce-searchbar" class="ecommerce-searchbar">
            <div class="row mt-1">
              <div class="col-sm-12">
                <div class="input-group">
                  <select class="form-select" id="sort_page"   style="max-width: 110px">
                    <option  value="">Sắp xếp</option>
                    <option <?=isset($_GET['sort_by'])?($_GET['sort_by']=='field_noi_bat_value'&&$_GET['sort_order']=='DESC'?"selected":""):""?> data-value="field_noi_bat_value" value="DESC">Nổi bật</option>
                    <option <?=isset($_GET['sort_by'])?($_GET['sort_by']=='field_ten_san_pham_value'&&$_GET['sort_order']=='ASC'?"selected":""):""?> data-value="field_ten_san_pham_value" value="ASC">A -> Z</option>
                    <option <?=isset($_GET['sort_by'])?($_GET['sort_by']=='field_ten_san_pham_value'&&$_GET['sort_order']=='DESC'?"selected":""):""?> data-value="field_ten_san_pham_value" value="DESC">Z -> A</option>
                    <option <?=isset($_GET['sort_by'])?($_GET['sort_by']=='field_gia_value'&&$_GET['sort_order']=='ASC'?"selected":""):""?> data-value="field_gia_value" value="ASC">Giá tăng</option>
                    <option <?=isset($_GET['sort_by'])?($_GET['sort_by']=='field_gia_value'&&$_GET['sort_order']=='DESC'?"selected":""):""?> data-value="field_gia_value" value="DESC">Giá giảm</option>
                    <option <?=isset($_GET['sort_by'])?($_GET['sort_by']=='created'&&$_GET['sort_order']=='DESC'?"selected":""):""?> data-value="created" value="DESC">Mới nhất</option>
                    <option <?=isset($_GET['sort_by'])?($_GET['sort_by']=='created'&&$_GET['sort_order']=='ASC'?"selected":""):""?> data-value="created" value="ASC">Cũ nhất</option>
                  </select>
                  <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm ..." value="<?=isset($_GET['field_ten_san_pham1_value'])?$_GET['field_ten_san_pham1_value']:""?>"
                         name="field_ten_san_pham1_value" aria-describedby="button-addon2"/>
                  <button class="btn btn-outline-primary" type="submit"><i data-feather='search'></i></button>
                </div>
              </div>
            </div>
          </section>
        </form>
        <!-- E-commerce Search Bar Ends -->

        <!-- E-commerce Products Starts -->
        <div class="hidden">
          <?php print $messages; ?>
        </div>
        <?php if ($tabs): ?>
          <div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php if ($page['content']) print render($page['content']); ?>

        <!-- E-commerce Products Ends -->
      </div>
    </div>
    <form action="/view-san-pham">

      <div class="sidebar-detached sidebar-left">
        <div class="sidebar">
          <!-- Ecommerce Sidebar Starts -->
          <div class="sidebar-shop">
            <div class="card">
              <div class="card-body">

                <?php
                $mucGia = getDanhMucs(26707);
                $thuongHieu = getDanhMucs(26708);
                ?>
                <div class="multi-range-price">
                  <h6 class="filter-title mt-0">LOẠI SẢN PHẨM</h6>
                  <ul class="list-unstyled price-range" id="price-range">
                    <?php foreach (getDanhMucs(26766) as $item): ?>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox"
                                   value="<?= $item ?>" <?= isset($_GET['field_phan_loai_san_pham_value']) ? (in_array($item, $_GET['field_phan_loai_san_pham_value']) ? "checked" : "") : "" ?>
                                   name="field_phan_loai_san_pham_value[]"
                                   class="form-check-input"/>
                            <?= $item ?>
                          </label>
                        </div>
                      </li>
                    <?php endforeach; ?>

                  </ul>
                </div>
                <div class="multi-range-price">
                  <h6 class="filter-title mt-0">CẢM GIÁC LƯỚI</h6>
                  <ul class="list-unstyled price-range" id="price-range">
                    <?php foreach (getDanhMucs(26750) as $item): ?>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox"
                                   value="<?= $item ?>" <?= isset($_GET['field_cam_giac_luoi_value']) ? (in_array($item, $_GET['field_cam_giac_luoi_value']) ? "checked" : "") : "" ?>
                                   name="field_cam_giac_luoi_value[]"
                                   class="form-check-input"/>
                            <?= $item ?>
                          </label>
                        </div>
                      </li>
                    <?php endforeach; ?>

                  </ul>
                </div>
                <div class="multi-range-price">
                  <h6 class="filter-title mt-0">THƯƠNG HIỆU </h6>
                  <ul class="list-unstyled price-range height-200 overflow-auto" id="thuong_hieu">
                    <?php foreach ($thuongHieu as $item): ?>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox"
                                   value="<?= $item ?>" <?= isset($_GET['field_thuong_hieu_value']) ? (in_array($item, $_GET['field_thuong_hieu_value']) ? "checked" : "") : "" ?>
                                   name="field_thuong_hieu_value[]"
                                   class="form-check-input"/>
                            <?= $item ?>
                          </label>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
                <!-- Price Filter starts -->
              </div>
              <div id="clear-filters">
                <button type="submit" class="btn w-100 btn-primary"><i data-feather='filter'></i> Lọc</button>
              </div>
              <!-- Clear Filters Ends -->
            </div>
          </div>
        </div>
        <!-- Ecommerce Sidebar Ends -->
    </form>
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
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app-menu.js"></script>
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/scripts/jquery.PrintArea.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/js/extensions/wNumb.min.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/js/extensions/nouislider.min.js"></script>
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/js/core/app-menu.js"></script>
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend//app-assets/js/scripts/pages/app-ecommerce.js"></script>
<!-- END: Theme JS-->
