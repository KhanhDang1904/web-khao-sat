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
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
     data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="<?php print $front_page ?>">
                     <span class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1"
                                                        x1="100%"
                                                        y1="10.5120544%"
                                                        x2="50%"
                                                        y2="89.4879456%">
                                            <stop stop-color="#000000"
                                                  offset="0%"></stop>
                                            <stop stop-color="#FFFFFF"
                                                  offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2"
                                                        x1="64.0437835%"
                                                        y1="46.3276743%"
                                                        x2="37.373316%"
                                                        y2="100%">
                                            <stop stop-color="#EEEEEE"
                                                  stop-opacity="0"
                                                  offset="0%"></stop>
                                            <stop stop-color="#FFFFFF"
                                                  offset="100%"></stop>
                                        </lineargradient>
                                    </defs>
                                    <g id="Page-1" stroke="none"
                                       stroke-width="1" fill="none"
                                       fill-rule="evenodd">
                                        <g id="Artboard"
                                           transform="translate(-400.000000, -178.000000)">
                                            <g id="Group"
                                               transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary"
                                                      id="Path"
                                                      d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                      style="fill:currentColor"></path>
                                                <path id="Path1"
                                                      d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                      fill="url(#linearGradient-1)"
                                                      opacity="0.2"></path>
                                                <polygon id="Path-2"
                                                         fill="#000000"
                                                         opacity="0.049999997"
                                                         points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon id="Path-21"
                                                         fill="#000000"
                                                         opacity="0.099999994"
                                                         points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon id="Path-3"
                                                         fill="url(#linearGradient-2)"
                                                         opacity="0.099999994"
                                                         points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span>

          <h2 class="brand-text mb-0">Quản lý</h2>
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
            $submissions = webform_get_submissions(array('nid'=> 26686), null,5);
            array_multisort($submissions,SORT_DESC);
            foreach ($submissions as $submission){
              print ' <a class="d-flex" href="/ket-qua">
            <div class="list-item d-flex align-items-start">
              <div class="me-1">
                <div class="avatar bg-light-warning">
                  <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                </div>
              </div>
              <div class="list-item-body flex-grow-1">
                <p class="media-heading">
                  <span class="fw-bolder">'.$submission->data[1][0].' </span>
                </p>
                <small class="notification-text">'.date("d/m/y H:i",$submission->submitted).'</small>
                <small class="notification-text text-over" style="margin-bottom:0 ">'.$submission->data[1][0].'</small>
              </div>
            </div>
          </a>';
            }
            ?>
          </li>
          <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="/ket-qua">Xem tất cả</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder"><?= $user->uid == 0 ? 'Khách vãng lai' : $user->name; ?></span>
            <span class="user-status"><?= $user->uid == 0 ? '' : array_values($user->roles)[0] ?></span>
          </div>
          <span class="avatar">
            <img class="round"
                 src="<?= drupal_get_path('theme', 'frontend') ?>/app-assets//images/portrait/small/avatar-s-11.jpg"
                 alt="avatar" height="40" width="40">
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
          <?php
          global $user;
          if (!isset($user->roles[8])):
            ?>
            <a class="dropdown-item" href="/ho-so-ca-nhan">
              <i class="me-50" data-feather="user"></i> Hồ sơ cá nhân
            </a>
          <?php endif;?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= url('user/logout') ?>">
            <i class="me-50" data-feather="power"></i> Đăng xuất
          </a>
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
            <span class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                                        y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                                        x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary" id="Path"
                                                      d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                      style="fill:currentColor"></path>
                                                <path id="Path1"
                                                      d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                      fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                                         points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                                         points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                                         points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span>
            <h2 class="brand-text mb-0">VAI TRÒ</h2>
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

<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>

  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="hidden">
        <?php print $messages; ?>
      </div>
      <?php if ($tabs): ?>
        <div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php if (user_access('vai_tro_permission')): ?>
      <?php
      $where = "";
      if (isset($_GET['name'])) {
        $where .= " and name like'%" . $_GET['name'] . "%'";
      }
      $sql = 'SELECT rid,name FROM {role} Where rid>3  ' . $where . 'order by rid desc';
      $roles = db_query($sql)->fetchAll();

      ?>
      <?php include_once(__DIR__ . '/_form_vai_tro.php') ?>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header row">
              <?php include_once(__DIR__ . '/_form_tim_kiem_vai_tro.php') ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header row">
            <div class="content-header-left col-md-9 col-12">
              <div class="row breadcrumbs-top">
                <div class="col-12">
                  <h4 class="card-title text-vai-tro">Danh sách vai trò</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive overflow-x-unset">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th width="1%">TT</th>
                <th>Vai trò</th>
                <th width="1%">Sửa</th>
                <th width="1%">Xóa</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($roles as $index => $item): ?>
                <tr>
                  <td>
                    <?= $index + 1 ?>
                  </td>
                  <td>
                    <?= $item->name ?>
                  </td>
                  <td class="text-center">
                    <a href="#" class="text-success btn-sua-vai-tro" data-value="<?= $item->rid ?>">
                      <i data-feather='edit'></i>
                  </td>
                  <td class="text-center">
                    <a href="#" class="text-danger btn-xoa-vai-tro" data-value="<?= $item->rid ?>">
                      <i data-feather='delete'></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!--        <nav aria-label="Page navigation ">-->
          <!--          <ul class="pagination justify-content-center ">-->
          <!--            <ul class="pagination mt-2">-->
          <!--              <li class="page-item prev"><a class="page-link" href="#">Prev</a></li>-->
          <!--              <li class="page-item"><a class="page-link" href="#">1</a></li>-->
          <!--              <li class="page-item"><a class="page-link" href="#">2</a></li>-->
          <!--              <li class="page-item active"><a class="page-link" href="#">3</a></li>-->
          <!--              <li class="page-item"><a class="page-link" href="#">4</a></li>-->
          <!--              <li class="page-item"><a class="page-link" href="#">5</a></li>-->
          <!--              <li class="page-item next"><a class="page-link" href="#">Next</a></li>-->
          <!--            </ul>-->
          <!--          </ul>-->
          <!--        </nav>-->
        </div>
      </div>
    </div>

    <?php else: ?>
      Bạn không có quyền truy cập vào trang này
    <?php endif; ?>

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
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script
  src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app-menu.js"></script>
<script src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

