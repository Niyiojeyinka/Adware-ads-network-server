<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***
 * Name:      AdNetwork
 * Package:  payment.php
 * About:        A controller that handles advertiser operation
 * Copyright:  (C) 2018
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/





class Payments extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(array('advertiser_model','campaign_model','admin_model'));
    $this->load->library(array('session','form_validation','user_agent'));
     $this->load->helper(array('url','form','page_helper'));

     if($_SESSION["accounttype"] != "Advertiser")
      {
        show_page('page/logout');
      }

      $this->siteName = $this->advertiser_model->get_system_variable("site_name");
      $this->author = $this->advertiser_model->get_system_variable("author");
      $this->keywords = $this->advertiser_model->get_system_variable("keywords");
      $this->description= $this->advertiser_model->get_system_variable("description");
      $this->noindex = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
      $this->user =  $this->advertiser_model->get_advertiser_by_id();

}


public function payment()
{
$data['general_details']= $this->admin_model->get_business_settings();

$this->form_validation->set_rules('amount','Amount','required');
if(!$this->form_validation->run())
{
  $data['title'] = $this->siteName." | Advertiser Affilate";
      $data['author'] =  $this->author;
      $data['keywords'] =  $this->keywords;
      $data['description'] =  $this->description;
      $data["noindex"] =  $this->noindex;
$data['user'] =$this->user;


$data["count_campaigns"] = $this->advertiser_model->count_advertisers_campaigns();
$data["count_cpa"] = $this->advertiser_model->count_advertisers_cpa();



    $this->load->view('/common/advertiser_header_view',$data);
      $this->load->view('/common/advertiser_top_tiles',$data);
   $this->load->view('/user/advertiser/payment_view',$data);
     $this->load->view('/common/users_footer_view',$data);

}else{

  $data['title'] = $this->siteName." | Advertiser Affilate";
      $data['author'] =  $this->author;
      $data['keywords'] =  $this->keywords;
      $data['description'] =  $this->description;
      $data["noindex"] =  $this->noindex;
$data['user'] =$this->user;



$data["count_campaigns"] = $this->advertiser_model->count_advertisers_campaigns();
$data["count_cpa"] = $this->advertiser_model->count_advertisers_cpa();
//when we get usd account we rewrite this logic
$data['amount'] = $this->input->post('amount');
$data['currency_code'] = $this->input->post('currency');

    $this->load->view('/common/advertiser_header_view',$data);
      $this->load->view('/common/advertiser_top_tiles',$data);
   $this->load->view('/user/advertiser/pre_pay_view',$data);
     $this->load->view('/common/users_footer_view',$data);



}



}


public function confirm_pay_payment()
{

 /* $_SESSION['hold'] = array('ref' => $ref,'amount'=>$amount,'currency_code'=>$currency_code); as saved from frontend*/

  if(!isset($_SESSION['hold']['ref']))
  {

$_SESSION['action_status_report'] ="<span class='w3-text-red'>Unknown Error Occurred</span>";
$this->session->mark_as_flash('action_status_report');
show_page("advertiser/payment");
  }

    if (isset($_SESSION['hold']['ref'])) {
        $ref = $_SESSION['hold']['ref'];
        $amount = $_SESSION['hold']['amount']; //Correct Amount from Server
        $currency = $_SESSION['hold']['currency_code'];
        //Correct Currency from Server

        $query = array(
            "SECKEY" => "secret key here",
            "txref" => $ref
        );
         /* $query = array(
            "SECKEY" => "FLWSECK-cc257ca2f7854658a8d5ab2880253f3d-X",
            "txref" => $ref
        );//test*/

        $data_string = json_encode($query);

         $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify ');
        /*$ch = curl_init("https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify"); test */
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
          //Give Value and return to Success page
//get exchange rate by currency code returned
//divided the returned amount by the xchange rate
//unset ref,$_SESSION['ref']
          //redirect to home
          //later send email
$exchange_rate = $this->advertiser_model->get_currency_det_by_shortcode($chargeCurrency)['xchange_rate'];
//get previous balance
$user=$this->advertiser_model->get_advertiser_by_id($_SESSION['id']);
$previous_bal = $user['account_bal'];
$new_bal = ($chargeAmount/$exchange_rate)+$previous_bal;
//credit user account
$this->advertiser_model->credit_balance(array('account_bal' =>$new_bal ));
//alert admin about payment

$this->advertiser_model->insert_to_payment_record(array('method'=>'flutterwave','payment_type'=>'deposit','amount'=> ($chargeAmount/$exchange_rate),'user_type'=>'advertiser','user_id' => $_SESSION['id'], 'time'=>time()));
unset($ref);
//unset session variable here
unset($_SESSION['hold']);
$_SESSION['action_status_report'] ="<span class='w3-text-green'>Payment Successfully Processed</span>";
$this->session->mark_as_flash('action_status_report');
show_page("advertiser/payment");
        } else {
            //Dont Give Value and return to Failure page
          $_SESSION['action_status_report'] ="<span class='w3-text-red'>Payment Failed</span>";
$this->session->mark_as_flash('action_status_report');
show_page("advertiser/payment");
        }
    }



}
}