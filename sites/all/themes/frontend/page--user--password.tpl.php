<div class="hidden">
  <?php if ($page['content']) print render($page['content']) ?>
</div>
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
          <a class="brand-logo" href="<?= $front_page ?>">
            <?php $node = node_load(26604); ?>
            <span>
            <img src="https://<?= $_SERVER['SERVER_NAME'] ?>/<?= $node->field_ghi_chu['und'][0]['value'] ?>"/>
          </span>
            <h2 class="brand-text text-primary ms-1">CSTAKA </h2>
          </a>
          <!-- /Brand logo-->
          <!-- Left Text-->
          <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="https://<?= $_SERVER['SERVER_NAME'] ?>/sites/all/themes/frontend/app-assets/images/illustration/verify-email-illustration.svg" alt="two steps verification" /></div>
          </div>
          <!-- /Left Text-->
          <!-- verify email v2-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              <h2 class="card-title fw-bold mb-1">Quên mật khẩu? 🔒</h2>
              <p class="card-text mb-2">Nhập email của bạn và chúng tôi sẽ gửi cho bạn hướng dẫn để đặt lại mật khẩu của bạn</p>
              <div class="">
                <?php print $messages; ?>
              </div>
              <form class="auth-forgot-password-form mt-2" method="POST">
                <div class="mb-1">
                  <label class="form-label" for="forgot-password-email">Email</label>
                  <input class="form-control" id="forgot-password-email" type="text"  placeholder="john@example.com"  />
                </div>
                <a class="btn btn-primary w-100 btn-forgot-pass" tabindex="2">Gửi</a>
              </form>
              <p class="text-center mt-2"><a href="/user/login"><i data-feather="chevron-left"></i> Quay lại đăng nhập</a></p>
            </div>
          </div>
          <!-- verify email-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- BEGIN: Content-->

