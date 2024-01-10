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
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="<?php print $front_page ?>">
          <?php $node= node_load(26604);?>
          <span class="brand-logo">
            <img src="<?=$node->field_ghi_chu['und'][0]['value']?>"/>
          </span>
          <h2 class=" text-primary ms-1" ><strong>STRINGING LIST</strong></h2>
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
    <div class="nav navbar-nav align-items-center ms-auto">
      <h1 class=""><?=date("l, jS \of F Y")?></h1>
    </div>
    <ul class="nav navbar-nav align-items-center ms-auto">
      <li>
        <h1 class="block-time text-primary font-weight-600"> <?=intval(date('i'))<10?date("H:0i"):date("H:i")?></h1>
      </li>
    </ul>
  </div>
</nav>

<div class="app-content content p-5" >
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="hidden">
        <?php print $messages; ?>
      </div>
      <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php if($page['content']) print render($page['content']); ?>
    </div>
  </div>

</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
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
<script src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/js/scripts/jquery.PrintArea.js"></script>
<!-- END: Theme JS-->
