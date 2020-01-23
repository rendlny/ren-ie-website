<?php
include $_SERVER['DOCUMENT_ROOT'].'/web/start.php';

$pagetitle = 'Activate Account';
$formTitle = 'Activate Account';
$formText = 'Enter a password';
$submitBtnText = 'Activate';
$form = [];

use Controllers\UserController;

$checkToken = $_GET['tcode'];
$message = NULL;


if ($checkToken == NULL){
	$message = '<div class="alert alert-warning text-center">It appears that you are trying to activate your account without an activation key. Please check your email for details of your key.</div>';

} else {
  if(!UserController::checkUserToken($checkToken)) {
    $message = '<div class="alert alert-warning">Unable to activate an account. The token may be invalid or the account may have already been activated</div>';
  } else {

    #FORM STRUCTURE#################################################################
    $form[0]['label'] = 'Password';
    $form[0]['input'] = '<input type="password" class="form-control" id="password" name="password">';

    $form[1]['label'] = 'Re-enter Password';
    $form[1]['input'] = '<input type="password" class="form-control" id="cpassword" name="cpassword">';
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (empty($_POST['password']) || empty($_POST['cpassword'])) {
    $message = '<div class="alert alert-warning text-center">You must enter a new password and confirm your password.</div>';

  } elseif ($_POST['password'] != $_POST['cpassword']) {
		$message = '<div class="alert alert-warning text-center">Passwords did not match, please try enter a new password and confirm your password again.</div>';

  } elseif ( !preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['password']) ) {
		$message =  '<div class="alert alert-warning text-center">Your chosen password does not match the password security requirements: You must include one capital letter, one lower case letter and one number</div>';
  } else {
    try {
		  $user = UserController::activateAccount($checkToken, $_POST['password']);
		  $form = [];
		  // TODO: Setup user activity
		  // updateactivity($usercode,5,0,$connection);

			$_SESSION['userId'] = $user->id;
		  $_SESSION['userCode'] = $user->usercode;
		  $_SESSION['userLevel'] = $user->level;

		  $message = '<div class="alert alert-success text-center">Your have successfully activated your account!</div> <a class="btn btn-primary btn-block" href="/profile">Go to my account</a>';
    } catch (Exception $e) {
      $message =  '<div class="alert alert-danger text-center">Your account could not be activated. Please try again. If the problem persists, please contact the System Administrator.</div>';
    }
  }
}


include $_SERVER['DOCUMENT_ROOT'].'/web/includes/external_form.php';
?>
