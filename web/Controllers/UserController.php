<?php

namespace Controllers;
use Models\User;
use Models\UserFocal;
use Models\Token;
// use Models\UserActivity;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use PHPMailer\PHPMailer\PHPMailer;


define('ACC_LVL_1', 1);
define('ACC_LVL_2', 2);
define('ACC_LVL_3', 3);

class UserController {
  public static function getUserById($id) {
    return User::find($id);
  }

  public static function getUserByUserCode($usercode) {
    return User::where('usercode', $usercode)->first();
  }

  public static function getUserByEmail($email){
    return User::where('email', $email)->first();
  }

  public static function login($email, $password) {
    $user = User::where('email', $email)->first();
    if(!$user) {
      throw new Exception('Login failed, email or password is incorrect');
    }

    if (!$user->active) {
      throw new Exception('Account has not been activated');
    }

    $pass = $user->password()->first();

    if(!isset($pass) || $pass['focal'] == NULL) {
      //user hasn't set a password yet, send out email to setup password
      if($pass == NULL){
        $password = new UserFocal(['focal'=>'']);
        $user->password()->save($password);
      }

      $token = $user->token()->save(new Token(['requestingIP' => $_SERVER['REMOTE_ADDR']]));
      static::sendAccountEmail($user, 'activateAccount', $token->token);

      throw new Exception('You have not setup a password for your account yet.
        Please check your email to set your password.'
      );
    }
    elseif(!$pass->checkPassword($password)){
      throw new Exception('Login failed, email or password is incorrect');
    }

    $_SESSION['userCode'] = $user->usercode;
    $_SESSION['userId'] = $user->id;
    $_SESSION['userLevel'] = $user->access;
  }

  public static function registerUser($data){
    DB::beginTransaction();

    try {
      $data['access'] = ACC_LVL_3;

      $email = $data['email'];
      $existing = User::where('email', $email)->get();

      if(sizeOf($existing) > 0) {
        throw new Exception('This email is already in use');
      }
      // create the new user
      $data['level'] = 1;
      $user = User::create($data);
      // create password and activatation token for this user
      $password = new UserFocal(['focal'=>'']);
      $user->password()->save($password);

      $token = $user->token()->save(new Token(['requestingIP' => $_SERVER['REMOTE_ADDR']]));

      DB::commit();
    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    // send activation email
    static::sendAccountEmail($user, 'activateAccount', $token->token);

    return $user;
  }

  static function resetPassword($email) {
    $user = User::where('email', $email)->first();
    if(!$user) {
      throw new Exception('The email entered is not registered');
    }

    if(!$user->active) {
      throw new Exception('Your account has not been activated yet');
    }

    $token = $user->token()->save(new Token(['requestingIP' => $_SERVER['REMOTE_ADDR']]));

    static::sendAccountEmail($user, 'passwordResetRequest', $token->token);

    return true;
  }

  static function adminResetPassword($email) {
    $user = User::where('email', $email)->first();
    if(!$user) {
      throw new Exception('The email entered is not registered');
    }

    if(!$user->active) {
      throw new Exception('Your account has not been activated yet');
    }

    $token = $user->token()->save(new Token(['requestingIP' => $_SERVER['REMOTE_ADDR']]));

    static::sendAccountEmail($user, 'adminPasswordResetRequest', $token->token);

    $data = [
      'user_id'       => $user->id,
      'activity_desc' => 'Requested Password Reset',
      'icon'          => 'fa-question-circle',
      'link'          => '/edit-admin/'.$user->usercode,
      'link_title'    => $user->firstname.' '.$user->lastname,
    ];
    // static::addUserActivity($data);

    return true;
  }


  static function checkUserToken($activationToken) {
    $token = Token::where('token', $activationToken)->first();
    if(!$token) {
      return false;
    }
    $user = $token->user()->first();

    if($token->active) {
      return false;
    }

    return true;
  }

  static function checkUserResetToken($activationToken) {
    $token = Token::where('token', $activationToken)->first();
    if(!$token) {
      return false;
    }
    $user = $token->user()->first();

    if($token->active || !$user->active) {
      return false;
    }

    return true;
  }

  static function activateAccount($activationToken, $password) {
    DB::beginTransaction();
    try {
      $token = Token::where('token', $activationToken)->first();
      $user = $token->user()->first();
      $token->active = true;
      $token->save();

      $userfocal = $user->password()->first();
      $userfocal->focal = $password;
      $userfocal->save();

      $user->active = true;
      $user->save();
      DB::commit();
    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    return $user;
  }

  static function sendAccountEmail($user, $emailType, $token){
    $config = parse_ini_file('../assets/php/config.ini');

    //retrieve email parts
    $emailsString = file_get_contents("../assets/locale/activationEmails.json");
    $activationEmails = json_decode($emailsString, true);
    $email = $activationEmails[$emailType];

    $link = (empty($_SERVER['HTTPS']) ? 'http' : 'https' ).'://'.$_SERVER['HTTP_HOST'].$email["link"].$token;
    $emailbody = '
      <p>Hello '.$user->firstname.',</p>
      '.$email['body'].'
      <a href="'.$link.'">Activate Account</a>
    ';

    try{
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->SMTPAuth = true;
      $mail->Host = $config['smtp_host'];
      $mail->Username = $config['smtp_user'];
      $mail->Password = $config['smtp_pass'];
      $mail->SMTPSecure = $config['smtp_secure'];
      $mail->Port = $config['smtp_port'];
      $mail->setFrom($config['smtp_user'], $config['display_name']);
      $mail->addAddress($user->email);
      $mail->addCC($config['smtp_user']);

      $mail->isHTML(true);
      $mail->Subject = $email["subject"];
      $mail->Body    = $emailbody;
      $mail->AltBody = $emailbody;

      if (!$mail->send()) {
        throw new Exception('Email not sent! '.$mail->ErrorInfo);
      }
    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  static function updateUserPassword($resetToken, $password){
    DB::beginTransaction();
    try {
      $token = Token::where('token', $resetToken)->first();
      $user = User::where('id', $token->user_id)->first();
      $userfocal = UserFocal::where('user_id', $user->id)->first();
      $userfocal->focal = $password;
      $userfocal->save();

      $token->active = false;
      $token->save();
      //updateactivity($businesscode,5,0,$connection);
      DB::commit();

    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    return $user;
  }

  static function getAllActiveAdminUsers($activeAdminUsers = NULL){
    $users = User::where('active', 1)->where('level', '>', 1)->get();
    return $users;
  }

  static function getAllUsers($users = NULL){
    $users = User::where('level', 1)->get();
    return $users;
  }

  static function getAllAdminUsers($users = NULL){
    $users = User::where('level', '>', 1)->get();
    return $users;
  }

  static function getUserByCode($usercode){
    $user = User::where('usercode', $usercode)->first();
    return $user;
  }

  static function updateUser($data){
    DB::beginTransaction();
    try{
      $user = User::where('usercode',$data['usercode'])->first();
      $user->firstname = $data['firstname'];
      $user->lastname = $data['lastname'];
      $user->email = $data['email'];
      $user->save();
      DB::commit();
    }catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
    return $user;
  }

  static function updateAdmin($data){
    DB::beginTransaction();
    try{
      $user = User::where('usercode',$data['usercode'])->first();
      $user->firstname = $data['firstname'];
      $user->lastname = $data['lastname'];
      $user->email = $data['email'];
      $user->level = $data['level'];
      $user->link = $data['link'];
      $user->save();
      DB::commit();
    }catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
    return $user;
  }

  public static function registerAdmin($data){
    DB::beginTransaction();

    try {
      $email = $data['email'];
      $existing = User::where('email', $email)->get();

      if(sizeOf($existing) > 0) {
        throw new Exception('This email is already in use');
      }
      // create the new user
      $user = User::create($data);
      // create password and activatation token for this user
      $password = new UserFocal(['focal'=>'']);
      $user->password()->save($password);

      $token = $user->token()->save(new Token(['requestingIP' => $_SERVER['REMOTE_ADDR']]));

      DB::commit();
    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    // send activation email
    static::sendAccountEmail($user, 'adminActivateAccount', $token->token);

    return $user;
  }



}

 ?>
