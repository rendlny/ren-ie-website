<?php

namespace Controllers;
use Models\Sale;
use Models\Item;
use Models\User;
use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class SaleController {
  public static function getSaleById($id) {
    return Sale::find($id);
  }

  public static function getSaleByCode($code) {
    return Sale::where('code', $code)->first();
  }

  public static function getSaleByCodeAndUser($code) {
    $sale = Sale::where('code', $code)->first();
    $user = User::where('usercode', $_SESSION['userCode'])->first();
    $item = Item::where('id', $sale->item_id)->first();

    if($item->user_id == $user->id){
      return $sale;
    }
  }

  static function updateSale($data){
    DB::beginTransaction();
    try{
      $sale = Sale::where('code',$data['code'])->first();
      $sale->code = $data['code'];
      $sale->item_id = $data['item_id'];
      $sale->quantity = $data['quantity'];
      $sale->total_price = $data['total_price'];
      $sale->customer_name = $data['customer_name'];
      $sale->shipping_address = $data['shipping_address'];
      $sale->trade_offer = $data['trade_offer'];
      $sale->comment = $data['comment'];
      $sale->charged = $data['charged'];
      $sale->tracking = $data['tracking'];
      $sale->shipped = $data['shipped'];
      $sale->cancelled = $data['cancelled'];
      $sale->refunded = $data['refunded'];
      $sale->contact_option = $data['contact_option'];
      $sale->contact_username = $data['contact_username'];
      $sale->save();
      DB::commit();
    }catch(Exception $e) {
      DB::rollback();
      throw $e;
    }
    return $sale;
  }

  public static function addSale($data){
    DB::beginTransaction();

    try {
      // create the new report
      $sale = Sale::create($data);

      DB::commit();

    // send notification email
    //  static::sendNotificationEmail('orderPlaced');
    } catch(Exception $e) {
      DB::rollback();
      throw $e;
    }

    return $sale;
  }

  public static function getUserSales(){
    $item = NULL;
    $userSales = array();

    $sales = Sale::where('cancelled', 0)->orderBy('created', 'DESC')->get();
    $user = User::where('usercode', $_SESSION['userCode'])->first();

    foreach ($sales as $sale) {
      $item = Item::withTrashed()->where('id', $sale->item_id)->first();
      if(isset($item->user_id) && $item->user_id == $user->id){
        array_push($userSales, $sale);
      }

    }
    return $userSales;
  }

  public static function getUsersSalesCount(){
    $salesCount = 0;
    $sales = Sale::where('cancelled', 0)->get();
    $user = User::where('usercode', $_SESSION['userCode'])->first();

    foreach ($sales as $sale) {
      $item = Item::withTrashed()->where('id', $sale->item_id)->first();
      if(isset($item->user_id) && $item->user_id == $user->id){
        $salesCount = $salesCount + $sale->quantity;
      }

    }
    return $salesCount;
  }

  static function getUsersShippedSaleCount(){
    $shippedSalesCount = 0;
    $sales = Sale::where('cancelled', 0)->where('shipped', 1)->get();
    $user = User::where('usercode', $_SESSION['userCode'])->first();
    foreach ($sales as $sale) {
      $item = Item::withTrashed()->where('id', $sale->item_id)->first();
      if($item->user_id == $user->id){
        $shippedSalesCount = $shippedSalesCount + 1;
      }
    }

    return $shippedSalesCount;
  }

  static function getUsersRecentSales(){
    $item = NULL;
    $userSales = array();

    $sales = Sale::where('cancelled', 0)->orderBy('created', 'DESC')->limit(10)->get();
    $user = User::where('usercode', $_SESSION['userCode'])->first();

    foreach ($sales as $sale) {
      $item = Item::where('id', $sale->item_id)->withTrashed()->first();
      if(isset($item->user_id) && $item->user_id == $user->id){
        array_push($userSales, $sale);
      }
    }
    return $userSales;
  }

  static function sendNotificationEmail($email, $subject, $body){
    require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
    $config = parse_ini_file('../assets/php/config.ini');

    try{
      $mail = new PHPMailer;
      $mail->isSMTP();
      //uncomment below to debug smtp issues
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->SMTPAuth = true;
      $mail->Host = $config['smtp_host'];
      $mail->Username = $config['smtp_user'];
      $mail->Password = $config['smtp_pass'];
      $mail->SMTPSecure = $config['smtp_secure'];
      $mail->Port = $config['smtp_port'];
      $mail->setFrom($config['smtp_user'], $config['display_name']);
      $mail->addAddress($email);
      $mail->addBCC($config['smtp_user']);

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $body;
      $mail->AltBody = $body;

      if (!$mail->send()) {
        throw new Exception('Email not sent! '.$mail->ErrorInfo);
      }else{
        return TRUE;
      }
    }catch(Exception $e){
      return $e->getMessage();
    }
  }

  static function recaptcha($recaptchaResponse){
    $config = parse_ini_file('../assets/php/config.ini');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $config['recaptcha_secret_key'], 'response' => $recaptchaResponse)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if(!$response) {
      return false;
    }

    $arrResponse = json_decode($response, true);

    return $arrResponse["success"] == '1'
      && $arrResponse["action"] == 'submit'
      && $arrResponse["score"] >= 0.5;
  }

  static function getUsersTotalProfits(){
    $profits = 0;
    $user = User::where('usercode', $_SESSION['userCode'])->first();
    $sales = Sale::where('cancelled', 0)->get();
    foreach ($sales as $sale) {
      $item = Item::where('id', $sale->item_id)->withTrashed()->first();
      if($item != NULL){
        $salePrice = $item->price * $sale->quantity;
        $paypalFee = (($salePrice / 100) * 3.4) + 35;
        $profits = $profits + ($salePrice - $paypalFee);
      }
    }
    return $profits;
  }

}

?>
