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
<div class="row">
  <div class="col-md-12">

    <div class="row">
      <?php
      $strDienThoai = [];
      foreach (getDanhMucs(26770) as $item) {
        $strDienThoai[] = '<a href="tel:' . $item . '">' . $item . '</a>';
      }
      $strEmail = [];
      foreach (getDanhMucs(26771) as $item) {
        $strEmail[] = '<a href="mailto:' . $item . '">' . $item . '</a>';
      }
      $strZalo = [];
      foreach (getDanhMucs(26773) as $item) {
        $strZalo[] = '<a href="' . $item . '">' . $item . '</a>';
      }
      ?>
      <div class="offset-md-3 col-md-6">
        <div class="card">
          <div class="card-body">
            <p><strong>THÔNG TIN LIÊN HỆ</strong></p>
            <div class="d-flex ">
              <div> <a href="tel:<?=getDanhMucs(26770)[0]?>"><img src="/images/phone.png" width="50px" class="phone-icon"></a></div>
              <div  class="ml-10"> <a href="mailto:<?=getDanhMucs(26771)[0]?>"><img src="/images/email.png" width="50px" class="email-icon"></a></div>
              <div class="ml-10"> <a href="<?= isset(getDanhMucs(26772)[1]) ? getDanhMucs(26772)[1] : "https://www.facebook.com/caulongvnbadminton/" ?>"><img src="/images/facebook.png" width="50px" class="facebook-icon"></a></div>
              <div class="ml-10"> <a href="mailto:<?=getDanhMucs(26773)[0]?>"><img src="/images/zalo.png" width="50px" class="zalo-icon"></a></div>
            </div>
            <p class="mt-1"><strong>GÓP Ý</strong></p>
            <?php $node = node_load(26686);
            webform_node_view($node, 'full');
            print theme_webform_view($node->content); ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $(".webform-submit").addClass("btn btn-success")
  })
</script>
