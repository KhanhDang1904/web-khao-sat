<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any.
 *
 * @ingroup views_templates
 */
?>

<?php include_once ('_from.php'); ?>
<?php include_once ('_xem_don_hang.php'); ?>
<?php include_once ('_form_trang_thai.php'); ?>
<?php include_once ('_form_trang_thai_thanh_toan.php'); ?>
<div class="print-block hidden">

</div>
<div class="<?php print $classes; ?>">
  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>
  <div class="row hidden">
    <div class="col-12">
      <div class="card">
        <div class="card-header row">
          <?php include_once(__DIR__ . '/_form_tim_kiem.php') ?>
        </div>
      </div>
    </div>
  </div>
  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>


