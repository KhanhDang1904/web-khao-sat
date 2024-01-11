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
?>
<div class="hidden">
  <?php if($page['content']) print render($page['content'])?>
</div>

<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
          <!-- Brand logo-->
          <a class="brand-logo" href="<?= $front_page ?>">
            <?php $node = node_load(26604); ?>
            <span>
            <img src="https://<?= $_SERVER['SERVER_NAME'] ?>/<?= $node->field_ghi_chu['und'][0]['value'] ?>"/>
          </span>
            <h2 class="brand-text text-primary ms-1"> CSTAKA </h2>
          </a>
          <!-- /Brand logo-->
          <!-- Left Text-->
          <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/images/pages/register-v2.svg" alt="Register V2" /></div>
          </div>
          <!-- /Left Text-->
          <!-- Register-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5 zindex-1">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto mt-lg-1">
              <h2 class="card-title fw-bold mb-1">Đăng kí 🚀</h2>
              <p class="card-text mb-2">Vui lòng điền thông tin để đăng kí!</p>
              <div class="">
                <?php print $messages; ?>
              </div>
              <form class="auth-register-form mt-2" action="/user/register" method="POST">
                <div class="mb-1">
                  <label class="form-label" for="register-name">Họ tên</label>
                  <input class="form-control" id="register-name" type="text" name="register-name" placeholder="Họ tên" aria-describedby="register-name" autofocus="" tabindex="1" />
                </div>
                <div class="mb-1">
                  <label class="form-label" for="login-country">Đất nước</label>
                  <div class="position-relative">
                    <select class="select2" id="register-country">
                      <option value="">--Chọn--</option>
                      <?php $country = getCountry();
                      if (count($country) > 0): ?>
                        <?php foreach ($country as $item): ?>
                          <option value="<?=$item->country?>"><?=$item->country?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="register-email">Email</label>
                  <input class="form-control" id="register-email" type="text" name="register-email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2" />
                </div>
                <div class="mb-1">
                  <label class="form-label" for="register-password">Password</label>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge" id="register-password" type="password" name="register-password" placeholder="············" aria-describedby="register-password" tabindex="3" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                </div>

<!--                <div class="mb-1">-->
<!--                  <div class="form-check">-->
<!--                    <input class="form-check-input" id="register-privacy-policy" type="checkbox" tabindex="4" />-->
<!--                    <label class="form-check-label" for="register-privacy-policy">Tôi đồng ý với <a href="#">chính sách và điều khoản bảo mật</a></label>-->
<!--                  </div>-->
<!--                </div>-->
                <button class="btn btn-primary w-100 btn-dang-ky" type="button" tabindex="5">Đăng kí</button>
              </form>
              <p class="text-center mt-2"><span>Quay lại?</span><a href="/user/login"><span>&nbsp;Đăng nhập</span></a></p>
              </div>
          </div>
          <!-- /Register-->
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('.form-password-toggle .input-group-text').on('click', function (e) {
    e.preventDefault();
    var $this = $(this),
      inputGroupText = $this.closest('.form-password-toggle'),
      formPasswordToggleIcon = $this,
      formPasswordToggleInput = inputGroupText.find('input');

    if (formPasswordToggleInput.attr('type') === 'text') {
      formPasswordToggleInput.attr('type', 'password');
      if (feather) {
        formPasswordToggleIcon.find('svg').replaceWith(feather.icons['eye'].toSvg({ class: 'font-small-4' }));
      }
    } else if (formPasswordToggleInput.attr('type') === 'password') {
      formPasswordToggleInput.attr('type', 'text');
      if (feather) {
        formPasswordToggleIcon.find('svg').replaceWith(feather.icons['eye-off'].toSvg({ class: 'font-small-4' }));
      }
    }
  });
</script>
<!-- END: Content-->
