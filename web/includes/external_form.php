<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';

$pagetitle = 'Login';
$inputSize = NULL;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  ## LOGIN ##
  if(!empty($_POST['login-submit'])){

    if (empty($_POST['email']) || empty($_POST['password'])){
  		$message = '<div class="alert alert-warning text-center">You must include both an email and a password.</div>';

    }else{
      $query = "SELECT uf.focal, u.usercode, u.active, u.access
  			FROM userfocal uf
  			RIGHT JOIN user u ON uf.usercode = u.usercode
  			WHERE u.email =  ?
  			LIMIT 1";

    	$stmt = $connection->prepare($query);
    	$stmt->bind_param("s", $_POST['email']);
    	$stmt->execute();
    	$stmt->bind_result($focal,$usercode,$active,$access);
    	$stmt->fetch();
      $stmt->close();

  		if (empty($usercode)){
  			$message = '<div class="alert alert-warning text-center">The email address you have entered does not appear in the system. If you need a profile contact a system Administrator.</div>';

      }elseif ($active != 1){
  			$message = '<div class="alert alert-warning text-center">This account is currently inactive. If you need to activate this account, please contact the System Administrator.</div>';

      }elseif (empty($focal)){
  			$message = '<div class="alert alert-info text-center">It appears that your password has not been set. Please click on the \'Forgot Your Password?\' link below and follow the instructions to set or reset your password.</div>';

      }	elseif (password_verify($_POST['password'], $focal)){
  			updateactivity($usercode,'1',$usercode,'',$connection);
  			$_SESSION['userCode'] = $usercode;
  			$_SESSION['userLevel'] = $access;

  			header('Location: /home/');

      }else{
        $test = password_verify($_POST['password'], $focal);
  			$message = '<div class="alert alert-warning text-center">The password you have provided is incorrect.</div>';
  		}
  	}
  }

  ## RECOVERY ##
  else if(!empty($_POST['recovery-submit']))
  {
    $error = (empty($_POST['inputRecEmail'])) ? 'You must provide your Email<br>' : NULL;
    if ($error != NULL)
    {
  		$message = '<div class="alert alert-warning text-center">'.$error.'</div>';
    }
    else
    {
      ## check email is registered to an account
      $email = $_POST['inputRecEmail'];
      //check email is unique
      $query = "SELECT active FROM user WHERE email = ?";
      $stmt = $connection->prepare($query);
      $stmt->bind_param("s",$email);
      $stmt->execute();
      $stmt->bind_result($accountActive);
      $stmt->fetch();
      $stmt->close();

      if($accountActive == NULL)
      {
        $message = '<div class="alert alert-warning">The email you entered is not registered.</div>';
      }
      else if($accountActive == 0)
      {
        $message = '<div class="alert alert-warning">Your account has not been activated yet.</div>';
      }
      else
      {
        ##send recovery email
        sendAdminPortalNotification($email,5,$connection);
        $message = '<div class="alert alert-success">A recovery link has been sent to your email.</div>';
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
          <div class="ms-hero-bg-primary ms-hero-img-mountain">
            <h2 class="text-center no-m pt-4 pb-4 color-white index-1">Activate Account</h2>
          </div>
          <ul class="nav nav-tabs nav-tabs-full nav-tabs-3 nav-tabs-transparent indicator-primary" role="tablist">
            <li class="nav-item" role="presentation"><a href="#ms-login-tab" aria-controls="ms-login-tab" role="tab" data-toggle="tab" class="nav-link withoutripple active"><i class="zmdi zmdi-account"></i> Activate</a></li>

          </ul>
          <div class="card-body">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active show" id="ms-login-tab">
                <form name="login" method="post">
                  <?=$message?>
                  <fieldset>
                    <?php
                      for($row = 0; $row < sizeof($form); $row++){
                        $inputSize = isset($form[$row]['inputSize']) ? $form[$row]['inputSize'] : '9';
                        $label = ($form[$row]['label'] != NULL ) ? '  <label class="control-label">'.$form[$row]['label'].'</label>' : NULL;
                        echo '
                        <div class="form-group label-floating">
                          <div class="input-group">
                          '.$label.'
                              '.$form[$row]['input'].'
                          </div>
                        </div>';
                      }
                      ?>
                      <div class="row mt-2">
                        <?php
                          if(sizeof($form)>0){
                            echo '<button type="submit" class="btn btn-raised btn-primary btn-block">'.$submitBtnText.'</button>';
                            if (isset($extraContentAfterSubmitBtn)) {
                                echo $extraContentAfterSubmitBtn;
                            }
                          }
                        ?>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center animated fadeInUp animation-delay-7">
          <a href="/" class="btn btn-white btn-raised"><i class="zmdi zmdi-home"></i> Return To Main Site</a>
        </div>
      </div>
    </div>
    <script src="/web/assets/js/plugins.min.js"></script>
    <script src="/web/assets/js/app.min.js"></script>
  </body>
</html>
