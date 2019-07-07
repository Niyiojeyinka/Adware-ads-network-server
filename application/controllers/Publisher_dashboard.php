<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***
 * Name:      Custch
 * Package:     publisher_dashboard.php
 * About:        A controller that handles publisher operation
 * Copyright:  (C) 2018,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/





class Publisher_dashboard extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(array('blog_model','publisher_model','advertiser_model','user_model'));
    $this->load->library(array('session','form_validation','user_agent'));
     $this->load->helper(array('url','form','page_helper','blog_helper'));

    // session_start();
      if($_SESSION["accounttype"] != "Publisher")
      {
        show_page('page/logout');
      }
      //check for account approval
      if($_SESSION['account_status'] == "pending")
      {
        show_page('page/pending_account_alert');
      }

      //check for account approval
      if($_SESSION['account_status'] == "suspended")
      {
        show_page('page/suspended_account_alert');
      }


}
public function index()
{


      $data['title'] = "Custch | Publisher Dashboard";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';


$data['user'] = $this->publisher_model->get_publisher_by_id();

$data['country_details'] = $this->advertiser_model->get_country_details($data['user']['country']);
$data['general_details'] = $this->advertiser_model->get_general_details();

$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();
$data["pending_campaigns"] = $this->publisher_model->count_publisher_pending_spaces();
$data["blocked_campaigns"] = $this->publisher_model->count_publisher_blocked_campaigns();
$data["active_campaigns"] = $this->publisher_model->count_publisher_active_campaigns();
$data["inactive_campaigns"] = $this->publisher_model->count_publisher_inactive_campaigns();
$data['no_clicks'] = $this->publisher_model->get_no_affilate_clicks("publisher");
$data['no_reg'] = $this->publisher_model->get_no_affilate_reg("publisher");


    $this->load->view('/common/publisher_header_view',$data);
      $this->load->view('/common/publisher_top_tiles',$data);

    $this->load->view('/user/publisher/dashboard_view',$data);
     $this->load->view('/common/users_footer_view',$data);


}

public function settings()
{



      $data['title'] = "Custch | Publisher Settings";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();

    $this->load->view('/common/publisher_header_view',$data);
      $this->load->view('/common/publisher_top_tiles',$data);

    $this->load->view('/user/publisher/settings_view',$data);
     $this->load->view('/common/users_footer_view',$data);




}



 public function change_password($slug = null)
 {
       $this->form_validation->set_rules("current_password","Current Password","trim|required");
    $this->form_validation->set_rules("new_password","New Password","trim|required|is_unique[publishers.password]");
    $this->form_validation->set_rules("confirm_password","Confirm New Password","trim|required|matches[new_password]");


    if ($this->form_validation->run() ==  FALSE)
   {


      $data['title'] = "Custch | Publisher Settings";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();

    $this->load->view('/common/publisher_header_view',$data);
      $this->load->view('/common/publisher_top_tiles',$data);
    $this->load->view('/user/publisher/settings_view',$data);
     $this->load->view('/common/users_footer_view',$data);



}else{

//change here



     $user_det =   $this->publisher_model->get_publisher_by_id();

       if ($user_det['password'] == md5(md5(trim($this->input->post('current_password')))))
       {

        //change password
          if( $this->publisher_model->insert_new_password())
          {
             //show suc message

            $_SESSION['action_status_report'] = '<b class="w3-text-green">Password changed successfully</b><br>';
              $this->session->mark_as_flash('action_status_report');
              show_page("publisher_dashboard/settings");
          }else{

              //show err message

             $_SESSION['action_status_report'] = '<b class="w3-text-red">uknown error occurred</b>';
              $this->session->mark_as_flash('action_status_report');
              show_page("publisher_dashboard/settings");


          }

       }else{


                   //incorrect password  error page


             $_SESSION["action_status_report"] = '<b class="w3-text-red">The Current Account
             Password you entered is incorrect</b><br>';
              $this->session->mark_as_flash('action_status_report');
              show_page("publisher_dashboard/settings");



       }
}
 }


//functions ends here
public function payment()
{

$this->form_validation->set_rules("payment_type","Payment Type","required");
if($this->form_validation->run())
{

$this->publisher_model->update_payment_details();
    

   $_SESSION["action_status_report"] = '<b class="w3-text-green">Payment 
         details Updated successfully</b><br>';
   $this->session->mark_as_flash('action_status_report');
   show_page("publisher_dashboard/payment");

}else{




      $data['title'] = "Custch | Publisher Payment Settings";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();

    $this->load->view('/common/publisher_header_view',$data);
    $this->load->view('/common/publisher_top_tiles',$data);
    $this->load->view('/user/publisher/payment_view',$data);
     $this->load->view('/common/users_footer_view',$data);


}

}






  public function req_withdrawal()
  {
//later check here for new guidelines also
$data['user'] = $this->publisher_model->get_publisher_by_id();
    //check if account details is set
    if (empty($data['user']['bank_acct']))
    {
//redirect
      show_page('publisher_dashboard/payment');
    }


$data['general_details'] = $this->advertiser_model->get_general_details();


//check if balance is ok
   
    if($data['user']['account_bal'] >= $data['general_details']['minimum_payout'])
    {

//check if there is previous pending balance
if($data['user']['pending_bal'] > 0)
{

//please there is already pending balance

       $_SESSION['err_msg'] = "<script>alert('Please there is already a pending balance');</script>";
        $this->session->mark_as_flash('err_msg');
        show_page("publisher_dashboard");


}
else{
    //insert  balance to pending
$ref = ((time()-456788)*9);


$new_pending = $data['user']['account_bal'] +
$data['user']['pending_bal'];
      $w_dat =  array('pending_bal' => $new_pending );


      $this->user_model->edit_user_details($w_dat,$data['user']['id'],'publishers');
      //insert to wildrawal

$w_dat =  array(
        'amount' => $data['user']['account_bal'],
        'user_id' => $_SESSION['id'],
        'approval' => "pending",
        'status' => "pending",
        'email' => $data['user']['email'],
        'phone' => $data['user']['phone'],
        'ref'  => $ref,
        'time' => time()
         );

      $this->user_model->insert_to_with_req($w_dat);
     
      //insert to history
$details = "You make a withdrawal Request of 
".$data['user']['account_bal']." with reference ".$ref;
      $h_dat =  array(
        'details' => $details,
        'action' => 'w_request' ,
        'user_id' => $_SESSION['id'],
        'account_type' => "publisher",
        'time' => time()
         );


      $this->user_model->insert_to_history($h_dat);
     //send email here
      
      //insert 00.00 to account bal


      $w_dat =  array('account_bal' => 0.00 );

      $this->user_model->edit_user_details($w_dat,$data['user']['id'],'publishers');



             $_SESSION['err_msg'] = "<script>alert('Your withdrawal Request has been submitted successfully');</script>";
              $this->session->mark_as_flash('err_msg');
              show_page("Publisher_dashboard");

}

//echo success

    }else{
             $_SESSION['err_msg'] = "<script>alert('Insufficient Balance');</script>";
              $this->session->mark_as_flash('err_msg');
              show_page("Publisher_dashboard");
    }
 }






public function view_details($ref_id)
{




      $data['title'] = "Custch | Publisher Space Reporting";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();
$data['item'] = $this->publisher_model->get_space_by_id($ref_id);
$data['item']['clicks'] =$this->publisher_model->get_campaign_at_all_time_clicks($ref_id);
$data['item']['views'] =$this->publisher_model->get_campaign_at_all_time_views($ref_id);




$data['yesterday_views'] = $this->publisher_model->get_campaign_at_time_views($ref_id,strtotime(date("y-m-d")),24);
$data['two_days_ago_views'] = $this->publisher_model->get_campaign_at_time_views($ref_id,(strtotime(date("y-m-d"))-(24*60*60)),48);
$data['three_days_ago_views'] = $this->publisher_model->get_campaign_at_time_views($ref_id,(strtotime(date("y-m-d"))-(48*60*60)),72);
$data['four_days_ago_views'] = $this->publisher_model->get_campaign_at_time_views($ref_id,(strtotime(date("y-m-d"))-(72*60*60)),96);
$data['today_views'] = $this->publisher_model->get_campaign_views($ref_id,strtotime(date("y-m-d")));


$data['yesterday_clicks'] = $this->publisher_model->get_campaign_at_time_clicks($ref_id,strtotime(date("y-m-d")),24);
$data['two_days_ago_clicks'] = $this->publisher_model->get_campaign_at_time_clicks($ref_id,(strtotime(date("y-m-d"))-(24*60*60)),48);
$data['three_days_ago_clicks'] = $this->publisher_model->get_campaign_at_time_clicks($ref_id,(strtotime(date("y-m-d"))-(48*60*60)),72);
$data['four_days_ago_clicks'] = $this->publisher_model->get_campaign_at_time_clicks($ref_id,(strtotime(date("y-m-d"))-(72*60*60)),96);
$data['today_clicks'] = $this->publisher_model->get_campaign_clicks($ref_id,strtotime(date("y-m-d")));
    $this->load->view('/common/publisher_header_view',$data);
    $this->load->view('/common/publisher_top_tiles',$data);
    $this->load->view('/user/publisher/details_view',$data);
     $this->load->view('/common/users_footer_view',$data);



}
public function affilate()
{



      $data['title'] = "Custch | Publisher Affilate";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();


    $this->load->view('/common/publisher_header_view',$data);
      $this->load->view('/common/publisher_top_tiles',$data);
   $this->load->view('/user/publisher/affilate_view',$data);
     $this->load->view('/common/users_footer_view',$data);



}



 public function spaces($offset = 0)
 {



    $limit = 5;
      $this->load->library('pagination');

        $data['items'] =  $this->publisher_model->spaces($offset,$limit);
    $config['base_url'] = site_url("publisher_dashboard/spaces");
  $config['total_rows'] = count($this->publisher_model->spaces(null,null));
  //$config['total_rows'] = $this->db->count_all('pages');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-indigo w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-indigo w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-indigo w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-indigo w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();




      $data['title'] = "Custch | Publisher Campaign";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();

 

    $this->load->view('/common/publisher_header_view',$data);
    $this->load->view('/common/publisher_top_tiles',$data);
    $this->load->view('/user/publisher/spaces_view',$data);
     $this->load->view('/common/users_footer_view',$data);


 }


 public function add_space($ref_id = null)
 {
      $this->form_validation->set_rules("space_name","Space Name","trim|required");
    $this->form_validation->set_rules("website_url","Website URL","trim|required");
     //$this->form_validation->set_rules("category","category","trim|required");


    if ($this->form_validation->run() ==  FALSE)
   {


      $data['title'] = "Custch | Add ADs Space";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();
$data["code"] = $this->publisher_model->get_space($ref_id)['code'];
    $this->load->view('/common/publisher_header_view',$data);
      $this->load->view('/common/publisher_top_tiles',$data);
    $this->load->view('/user/publisher/add_space_view',$data);
     $this->load->view('/common/users_footer_view',$data);



}else{

$ref_id = substr(md5(time()), 8);

$this->publisher_model->insert_space($ref_id);


  $_SESSION['action_status_report'] = '<b class="w3-text-green">Ads Space Generated successfully<br> Copy The Integration Code in the box below</b><br>';
    $this->session->mark_as_flash('action_status_report');
    show_page("publisher_dashboard/add_space/".$ref_id);
}



 }
//function ends here

 public function change_email($slug = null)
 {
      $this->form_validation->set_rules("current_password","Password","trim|required");
    $this->form_validation->set_rules("new_email","New Email","trim|required|is_unique[publishers.email]");
    $this->form_validation->set_rules("confirm_email","Confirm New Email","trim|required|matches[new_email]");



    if ($this->form_validation->run() ==  FALSE)
   {


         

      $data['title'] = "Custch | Publisher Settings";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->publisher_model->get_publisher_by_id();
$data["count_spaces"] = $this->publisher_model->count_publishers_spaces();

    $this->load->view('/common/publisher_header_view',$data);
      $this->load->view('/common/publisher_top_tiles',$data);
    $this->load->view('/user/publisher/settings_view',$data);
     $this->load->view('/common/users_footer_view',$data);


}else{


//change here



     $user_det =   $this->publisher_model->get_publisher_by_id();

       if ($user_det['password'] == md5(md5(trim($this->input->post('current_password')))))
       {

        //change Email
          if( $this->publisher_model->insert_new_email())
          {
             //show suc message

            $_SESSION['action_status_report'] = '<b class="w3-text-green">Email changed successfully</b><br>';
              $this->session->mark_as_flash('action_status_report');
              show_page("publisher_dashboard/settings");
          }else{

              //show err message

             $_SESSION['action_status_report'] = '<b class="w3-text-red">uknown error occurred</b>';
              $this->session->mark_as_flash('action_status_report');
              show_page("publisher_dashboard/settings");


          }

       }else{


                   //incorrect password  error page


             $_SESSION["action_status_report"] = '<b class="w3-text-red">The Current Account
             Email you entered is incorrect</b><br>';
              $this->session->mark_as_flash('action_status_report');
              show_page("publisher_dashboard/settings");



       }

}

 }

//function ends here

}