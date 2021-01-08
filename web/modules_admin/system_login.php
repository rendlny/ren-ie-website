<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';
use Controllers\UserController;

$web_data = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/website_data.ini', true);
$pagetitle = 'Login';
$message = $error = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  ## LOGIN ##
  if(!empty($_POST['login-submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])){
	  $message = '<div class="alert alert-warning text-center">You must include both an email and a password.</div>';
    } else {
      try {
        UserController::login($_POST['email'], $_POST['password']);
      } catch(Exception $e) {
        $message = '<div class="alert alert-warning text-center">'.$e->getMessage().'</div>';
      }

      // redirect on success
      if(!$message) {
        header('Location: /admin/home/');
      }
  	}
  }

  ## REGISTER ##
  else if(!empty($_POST['register-submit'])){
    try {
      $data = [
        'firstname' => $_POST['inputName'],
        'lastname' => $_POST['inputLast'],
        'email' => $_POST['inputEmail'],
      ];
      //$newUser = UserController::registerUser($data);
    } catch (Exception $e) {
      $error = $e->getMessage();
    }

    if ($error != NULL){
      $message = '<div class="alert alert-warning text-center">'.$error.'</div>';
    } else {
      $message = '<div class="alert alert-success">You have successfully registered. An email will be sent to '.$_POST['inputEmail'].' for you to activate your account.</div>';
    }
 }


  ## RECOVERY ##
  else if(!empty($_POST['recovery-submit'])){
    $error = (empty($_POST['inputRecEmail'])) ? 'You must provide your Email<br>' : NULL;
    if ($error != NULL){
      $message = '<div class="alert alert-warning text-center">'.$error.'</div>';
    } else {
      try {
        UserController::resetPassword($_POST['inputRecEmail']);
        $message = '<div class="alert alert-success">A recovery link has been sent to your email.</div>';
      } catch(Exception $e) {
        $message = '<div class="alert alert-warning">'.$e->getMessage().'</div>';
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <?php include $_SERVER['DOCUMENT_ROOT'].'/web/assets/php/head.php'; ?>
  <body>
    <div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>
    <div class="bg-full-page ms-hero-bg-light ms-hero-img-airplane back-fixed">
      <div class="mw-500 absolute-center">
        <div class="card color-dark shadow-6dp animated fadeIn animation-delay-7">
          <div class="ms-hero-bg-info ms-hero-img-forest">
            <h2 class="text-center no-m pt-4 pb-4 color-white index-1"><?=$web_data["admin_site"]["title"]?> Login</h2>
          </div>
          <ul class="nav nav-tabs nav-tabs-full nav-tabs-3 nav-tabs-transparent indicator-primary" role="tablist">
            <li class="nav-item" role="presentation"><a href="#ms-login-tab" aria-controls="ms-login-tab" role="tab" data-toggle="tab" class="nav-link withoutripple active"><i class="zmdi zmdi-account"></i> Login</a></li>
            <!--<li class="nav-item" role="presentation"><a href="#ms-register-tab" aria-controls="ms-register-tab" role="tab" data-toggle="tab" class="nav-link withoutripple"><i class="zmdi zmdi-account-add"></i> Register</a></li>-->
            <li class="nav-item" role="presentation"><a href="#ms-recovery-tab" aria-controls="ms-recovery-tab" role="tab" data-toggle="tab" class="nav-link withoutripple"><i class="zmdi zmdi-key"></i> Recovery</a></li>
          </ul>
          <div class="card-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active show" id="ms-login-tab">
                <form name="login" method="post">
                  <?=$message?>
                  <fieldset>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <label class="control-label" for="ms-form-user">Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                      </div>
                    </div>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                        <label class="control-label" for="ms-form-pass">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                      </div>
                    </div>
                    <input type="submit" class="btn btn-raised btn-primary btn-block" name="login-submit" value="Login"/>
                  </fieldset>
                </form>
              </div>
              <!--
              <div role="tabpanel" class="tab-pane fade" id="ms-register-tab">
                <form name="register" method="post">
                  <fieldset>

                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <label class="control-label" for="ms-form-user-r">First Name</label>
                        <input type="text" id="ms-form-user-r" class="form-control" name="inputName">
                      </div>
                    </div>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <label class="control-label" for="ms-form-user-r">Surname</label>
                        <input type="text" id="ms-form-user-r" class="form-control" name="inputLast">
                      </div>
                    </div>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                        <label class="control-label" for="ms-form-email-r">Email</label>
                        <input type="email" id="ms-form-email-r" class="form-control" name="inputEmail">
                      </div>
                    </div>

                    <input type="submit" name="register-submit" class="btn btn-raised btn-block btn-primary" value="Register"/>
                  </fieldset>
                </form>
              </div>
            -->
              <div role="tabpanel" class="tab-pane fade" id="ms-recovery-tab">
                <form name="recovery" method="post">
                <fieldset>
                  <div class="form-group label-floating">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                      <label class="control-label" for="ms-form-email-recovery">Email</label>
                      <input type="email" id="ms-form-email-recovery" class="form-control" name="inputRecEmail">
                    </div>
                  </div>
                  <input type="submit" class="btn btn-raised btn-block btn-primary" name="recovery-submit" value="Send Recovery Email"/>
                </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center animated fadeInUp animation-delay-7">
          <a href="/" class="btn btn-white btn-raised"><i class="zmdi zmdi-home"></i> Return to Main Site</a>
        </div>
      </div>
    </div>
    <script src="/web/assets/js/plugins.min.js"></script>
    <script src="/web/assets/js/app.min.js"></script>
  </body>
</html>
