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
                  <?php $node = node_load(26604); ?>
                    <span class="brand-logo"><img src="<?= $node->field_ghi_chu['und'][0]['value'] ?>"/></span>
                    <h2 class="brand-text mb-0"></h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
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
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Xem tất cả</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder"><?=$user->uid == 0 ? 'Khách vãng lai' : $user->name; ?></span>
            <span class="user-status"><?=$user->uid == 0 ? '' : array_values($user->roles)[0]?></span>
          </div>
          <span class="avatar">
            <img class="round" src="<?=drupal_get_path('theme', 'frontend')?>/app-assets//images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
          <a class="dropdown-item" href="/ho-so-ca-nhan">
            <i class="me-50" data-feather="user"></i> Hồ sơ cá nhân
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?=url('user/logout')?>">
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
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border container-xxl"
         role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="#">
                      <?php $node = node_load(26604); ?>
                        <span class="brand-logo"><img src="<?= $node->field_ghi_chu['und'][0]['value'] ?>"/></span>
                        <h2 class="brand-text mb-0"></h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
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
      <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php if(user_access('ho_so_ca_nhan_permission')):?>
        <!-- BEGIN: Content-->
          <?php global $user?>
          <div class="content-overlay"></div>
          <div class="header-navbar-shadow"></div>
          <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
              <section class="app-user-view-account">
                <div class="row">
                  <!-- User Sidebar -->
                  <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card">
                      <div class="card-body">
                        <div class="user-avatar-section">
                          <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mt-3 mb-2" src="<?=drupal_get_path('theme', 'frontend')?>/app-assets//images/portrait/small/avatar-s-11.jpg" height="110" width="110" alt="User avatar" />
                            <div class="user-info text-center">
                              <h4><?=$user->uid == 0 ? 'Khách vãng lai' : $user->name; ?></h4>
                              <span class="badge bg-light-secondary"><?=$user->uid == 0 ? '' : array_values($user->roles)[0]?></span>
                            </div>
                          </div>
                        </div>
                        <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                        <div class="info-container">
                          <ul class="list-unstyled">
                            <li class="mb-75">
                              <span class="fw-bolder me-25">Tên đăng nhập: </span>
                              <span><?=$user->name?></span>
                            </li>
                            <li class="mb-75">
                              <span class="fw-bolder me-25">Email:</span>
                              <span><?=$user->mail?></span>
                            </li>
                            <li class="mb-75">
                              <span class="fw-bolder me-25">Status:</span>
                              <span class="badge bg-light-success"><?=$user->status==1?"Đang hoạt động":"Dừng hoạt động"?></span>
                            </li>
                            <li class="mb-75">
                              <span class="fw-bolder me-25">Vai trò:</span>
                              <span><?=$user->uid == 0 ? '' : array_values($user->roles)[0]?></span>
                            </li>
                          </ul>
<!--                          <div class="d-flex justify-content-center pt-2 hidden">-->
<!--                            <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">-->
<!--                              Edit-->
<!--                            </a>-->
<!--                            <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a>-->
<!--                          </div>-->
                        </div>
                      </div>
                    </div>
                    <!-- /User Card -->
                    <!-- Plan Card -->
                    <!-- /Plan Card -->
                  </div>
                  <!--/ User Sidebar -->

                  <!-- User Content -->
                  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1 ">
                    <!-- User Pills -->
                    <div class="card">
                      <div class="card-body">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#cap-nhat-logo" aria-controls="home" role="tab" aria-selected="true">Cập nhật logo</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " id="home-tab" data-bs-toggle="tab" href="#cap-nhat-info" aria-controls="home" role="tab" aria-selected="true">Cập nhật thông tin cá nhân</a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="cap-nhat-logo" aria-labelledby="home-tab" role="tabpanel">
                            <form id="cap-nhat-logo">
                              <div class="row">
                                <div class="col-12">

                                  <div class="file-upload">
                                    <div class="image-upload-wrap">
                                      <input class="file-upload-input" type='file'  onchange="readURL(this);" accept="image/*" />
                                      <div class="drag-text">
                                        <h3>Chọn ảnh</h3>
                                      </div>
                                    </div>
                                    <div class="file-upload-content">
                                      <img class="file-upload-image" src="#" alt="your image" />
                                      <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="btn btn-danger remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                        <a class="btn btn-success btn-save-logo">Lưu lại</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>

                          </div>
                          <div class="tab-pane " id="cap-nhat-info" aria-labelledby="home-tab" role="tabpanel">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--/ User Content -->
                </div>
              </section>
              <!-- Edit User Modal -->
              <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-header bg-transparent">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                      <div class="text-center mb-2">
                        <h1 class="mb-1">Edit User Information</h1>
                        <p>Updating user details will receive a privacy audit.</p>
                      </div>
                      <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">First Name</label>
                          <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" value="Gertrude" data-msg="Please enter your first name" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserLastName">Last Name</label>
                          <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" value="Barton" data-msg="Please enter your last name" />
                        </div>
                        <div class="col-12">
                          <label class="form-label" for="modalEditUserName">Username</label>
                          <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" value="gertrude.dev" placeholder="john.doe.007" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserEmail">Billing Email:</label>
                          <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" value="gertrude@gmail.com" placeholder="example@domain.com" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserStatus">Status</label>
                          <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select" aria-label="Default select example">
                            <option selected>Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Suspended</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditTaxID">Tax ID</label>
                          <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="Tax-8894" value="Tax-8894" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserPhone">Contact</label>
                          <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="+1 (609) 933-44-22" value="+1 (609) 933-44-22" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserLanguage">Language</label>
                          <select id="modalEditUserLanguage" name="modalEditUserLanguage" class="select2 form-select" multiple>
                            <option value="english">English</option>
                            <option value="spanish">Spanish</option>
                            <option value="french">French</option>
                            <option value="german">German</option>
                            <option value="dutch">Dutch</option>
                            <option value="hebrew">Hebrew</option>
                            <option value="sanskrit">Sanskrit</option>
                            <option value="hindi">Hindi</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserCountry">Country</label>
                          <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select">
                            <option value="">Select Value</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <div class="d-flex align-items-center mt-1">
                            <div class="form-check form-switch form-check-primary">
                              <input type="checkbox" class="form-check-input" id="customSwitch10" checked />
                              <label class="form-check-label" for="customSwitch10">
                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                              </label>
                            </div>
                            <label class="form-check-label fw-bolder" for="customSwitch10">Use as a billing address?</label>
                          </div>
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                          <button type="submit" class="btn btn-primary me-1">Submit</button>
                          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Edit User Modal -->
              <!-- upgrade your plan Modal -->
              <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-upgrade-plan">
                  <div class="modal-content">
                    <div class="modal-header bg-transparent">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5 pb-2">
                      <div class="text-center mb-2">
                        <h1 class="mb-1">Upgrade Plan</h1>
                        <p>Choose the best plan for user.</p>
                      </div>
                      <form id="upgradePlanForm" class="row pt-50" onsubmit="return false">
                        <div class="col-sm-8">
                          <label class="form-label" for="choosePlan">Choose Plan</label>
                          <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
                            <option selected>Choose Plan</option>
                            <option value="standard">Standard - $99/month</option>
                            <option value="exclusive">Exclusive - $249/month</option>
                            <option value="Enterprise">Enterprise - $499/month</option>
                          </select>
                        </div>
                        <div class="col-sm-4 text-sm-end">
                          <button type="submit" class="btn btn-primary mt-2">Upgrade</button>
                        </div>
                      </form>
                    </div>
                    <hr />
                    <div class="modal-body px-5 pb-3">
                      <h6>User current plan is standard plan</h6>
                      <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex justify-content-center me-1 mb-1">
                          <sup class="h5 pricing-currency pt-1 text-primary">$</sup>
                          <h1 class="fw-bolder display-4 mb-0 text-primary me-25">99</h1>
                          <sub class="pricing-duration font-small-4 mt-auto mb-2">/month</sub>
                        </div>
                        <button class="btn btn-outline-danger cancel-subscription mb-1">Cancel Subscription</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ upgrade your plan Modal -->
            </div>
          </div>
        <!-- END: Content-->
      <?php else:?>
        Bạn không có quyền truy cập vào trang này
      <?php endif;?>

    </div>
  </div>

</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
  <p class="clearfix mb-0">
    <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; <?=date("Y")?>
      <a class="ms-25" href="https://andin.io" target="_blank">
        ANDIN JSC
      </a>
      <span class="d-none d-sm-inline-block">, All rights Reserved</span>
    </span>
  </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      console.log(input.files[0])
      var reader = new FileReader();

      reader.onload = function(e) {
        $('.image-upload-wrap').hide();

        $('.file-upload-image').attr('src', e.target.result);
        $('.file-upload-content').show();

        $('.image-title').html(input.files[0].name);
      };

      reader.readAsDataURL(input.files[0]);

    } else {
      removeUpload();
    }
  }

  function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
  }
  $('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
  })
</script>

<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app-menu.js"></script>
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/core/app.js"></script>
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<!-- END: Theme JS-->
