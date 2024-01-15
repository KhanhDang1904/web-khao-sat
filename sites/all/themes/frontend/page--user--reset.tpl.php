<div class="hidden">
  <?php if ($page['content']) print render($page['content']) ?>
</div>
<div class="app-content content p-0" style="padding: 0!important;">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
          <a class="brand-logo " href="<?= $front_page ?>"style="left: 0">
            <?php $node = node_load(26604); ?>
            <span>
            <img src="https://<?= $_SERVER['SERVER_NAME'] ?>/<?= $node->field_ghi_chu['und'][0]['value'] ?>"/>
          </span>
            <h2 class="brand-text text-primary ms-1"> CSTAKA </h2>
          </a>
          <!-- /Brand logo-->
          <!-- Left Text-->
          <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="https://<?=$_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/images/pages/reset-password-v2.svg" alt="Register V2" /></div>
          </div>
          <!-- /Left Text-->
          <!-- Reset password-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              <h2 class="card-title fw-bold mb-1">Đặt lại mật khẩu 🔒</h2>
              <p class="card-text mb-2">Mật khẩu mới của bạn phải khác với mật khẩu đã sử dụng trước đó</p>
              <div class="">
                <?php print $messages; ?>
              </div>
              <form class="auth-reset-password-form mt-2" action="" method="POST">
                <div class="mb-1">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="reset-password-new">Mật khẩu mới</label>
                  </div>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge" id="reset-password-new" type="password" name="reset-password-new" placeholder="············" aria-describedby="reset-password-new" autofocus="" tabindex="1" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                </div>
                <div class="mb-1">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="reset-password-confirm">Xác nhận mật khẩu</label>
                  </div>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge" id="reset-password-confirm" type="password" name="reset-password-confirm" placeholder="············" aria-describedby="reset-password-confirm" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                </div>
                <a class="btn btn-primary w-100 btn-reset-pass" tabindex="3">Đặt mật khẩu mới</a>
              </form>
              <p class="text-center mt-2"><a href="/user/login"><i data-feather="chevron-left"></i> Quay lại đăng nhập</a></p>
            </div>
          </div>
          <!-- /Reset password-->
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
