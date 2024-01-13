<link rel="stylesheet" type="text/css" href="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/css/pages/page-misc.css">
<div class="app-content content p-1">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <!-- Error page-->
      <div class="misc-wrapper">
        <a class="brand-logo" href="<?= $front_page ?>">
          <?php $node = node_load(26604); ?>
          <span>
            <img src="https://<?= $_SERVER['SERVER_NAME'] ?>/<?= $node->field_ghi_chu['und'][0]['value'] ?>"/>
          </span>
          <h2 class="brand-text text-primary ms-1">CSTAKA </h2>
        </a>
        <div class="misc-inner p-2 p-sm-3">
          <div class="w-100 text-center">
            <h2 class="mb-1">Page Not Found 🕵🏻‍♀️</h2>
            <p class="mb-2">Oops! 😖 The requested URL was not found on this server.</p>
            <a class="btn btn-primary mb-2 btn-sm-block" href="<?= $front_page ?>">Back to home</a>
            <img class="img-fluid" src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/images/pages/error.svg" alt="Error page" />
          </div>
        </div>
      </div>
      <!-- / Error page-->
    </div>
  </div>
</div>
