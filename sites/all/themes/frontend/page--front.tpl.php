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
<!-- BEGIN: Header-->
<nav
  class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
  data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="<?php print $front_page ?>">
          <?php $node = node_load(26604); ?>
          <span class="brand-logo">
            <img src="<?= $node->field_ghi_chu['und'][0]['value'] ?>"/>
          </span>
          <h2 class="brand-text mb-0">CSTAKA</h2>
        </a>
      </li>
    </ul>
  </div>
  <div class="navbar-container d-flex content">
    <div class="bookmark-wrapper d-flex align-items-center">
      <ul class="nav navbar-nav d-xl-none">
        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i
              class="ficon" data-feather="menu"></i></a></li>
      </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ms-auto">
      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link"
           id="dropdown-user" href="#" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder"><?= $user->name == "" ? "Khách hàng" : $user->name; ?></span>
            <span
              class="user-status"><?= array_values($user->roles)[0] ?></span>
          </div>
          <span class="avatar">
            <img class="round"
                 src="<?= $node->field_ghi_chu['und'][0]['value'] ?>"
                 alt="avatar" height="40" width="40">
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end"
             aria-labelledby="dropdown-user">
          <a class="dropdown-item" href="/user/login">
            <i class="me-50" data-feather="user"></i> Đăng nhập
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </div>
</nav>

<ul class="main-search-list-defaultlist-other-list d-none">
  <li class="auto-suggestion justify-content-between"><a
      class="d-flex align-items-center justify-content-between w-100 py-50">
      <div class="d-flex justify-content-start"><span class="me-75"
                                                      data-feather="alert-circle"></span><span>No results found.</span>
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
            <h2 class="brand-text mb-0">CSTAKA</h2>
          </a>
        </li>
        <li class="nav-item nav-toggle"><a
            class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
              class="d-block d-xl-none text-primary toggle-icon font-medium-4"
              data-feather="x"></i></a></li>
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
<div class="app-content content ">

  <form action="/">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div id="carousel-interval" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
              <ol class="carousel-indicators">
                <li data-bs-target="#carousel-interval" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carousel-interval" data-bs-slide-to="1"></li>
                <li data-bs-target="#carousel-interval" data-bs-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <?php $count = 0;
                foreach (getListImage()['data'] as $index => $item): ?>
                  <div class="carousel-item <?= $count++ == 0 ? "active" : "" ?>">
                    <img class="img-fluid"
                         src="/sites/default/files/images/<?= $item->field_image['und'][0]['filename'] ?>"
                         style="max-height: 350px!important;"/>
                  </div>
                <?php endforeach; ?>
              </div>
              <a class="carousel-control-prev" data-bs-target="#carousel-interval" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </a>
              <a class="carousel-control-next" data-bs-target="#carousel-interval" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h4>KHẢO SÁT</h4>
            <div class="accordion accordion-margin" id="accordionMargin">
              <?php $list = getListKhaoSat()['data'] ?>
              <?php if (count($list) > 0): ?>
                <?php foreach ($list as $index=>$item): ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingMarginOne">
                      <button  class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne<?=$index?>" aria-expanded="false" aria-controls="accordionMarginOne<?=$index?>">
                        <?=$item->title?>
                      </button>
                    </h2>
                    <div id="accordionMarginOne<?=$index?>" class="accordion-collapse collapse" aria-labelledby="headingMarginOne"
                         data-bs-parent="#accordionMargin">
                      <div class="accordion-body text-center">
                         <p>Bắt đầu khảo sát : <?=$item->title?></p>
                        <a class="btn btn-primary" href="/khao-sat?nid=<?=$item->nid?>">Bắt đầu</a>

                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
            </div>
            <div class="alert alert-warning p-1">Hiện đang không có khảo sát!</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </form>
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
<button class="btn btn-primary btn-icon scroll-top" type="button"><i
    data-feather="arrow-up"></i></button>
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
<!-- END: Theme JS-->
<?php

function getListTrangThaiThanhToan($trangThai)
{
  $arr = [
    'Đã thanh toán' => '<div class="badge bg-success"><i data-feather="check-circle"></i> Đã thanh toán</div>',
    'Thanh toán một phần' => '<div class="badge bg-warning"><i data-feather="alert-octagon"></i> Thanh toán một phần</div>',
    'Chưa thanh toán' => '<div class="badge bg-danger"><i data-feather="alert-triangle"></i> Chưa thanh toán</div>',
  ];
  return $arr[$trangThai];
}

?>

