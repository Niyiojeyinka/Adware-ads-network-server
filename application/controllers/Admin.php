<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct()
{
    parent::__construct();

    $this->load->model(array('admin_model','blog_model','publisher_model',
    'campaign_model','advertiser_model','pages_model','user_model'));
    $this->load->helper(array('url','form_helper','blog_helper','page_helper'));
    $this->load->library(array('form_validation','session'));

 if ((!isset($this->session->admin_name)) ||(!isset($this->session->admin_logged_in)))
 {
   show_page("ch_admin");
 }
    $this->siteName = $this->advertiser_model->get_system_variable("site_name");
      $this->author = $this->advertiser_model->get_system_variable("author");
      $this->keywords = $this->advertiser_model->get_system_variable("keywords");
      $this->description= $this->advertiser_model->get_system_variable("description");
      $this->noindex = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
      $this->tagLine =$this->advertiser_model->get_system_variable("tagline");

}





//callback function
public function index() {



      $data["title"] =$this->siteName." | Admin Dashboard";
      $data["keywords"] = $this->keywords;
      $data["author"] = $this->author;
     $data["description"] = $this->description;

$data["noindex"] = $this->noindex;
$data['num_of_publishers_24'] = count($this->user_model->count_publishers_reg_at_time(86400));
$data['num_of_advertisers_24'] = count($this->user_model->count_advertisers_reg_at_time(86400));
$data['num_of_publishers_7d'] = count($this->user_model->count_publishers_reg_at_time(86400*7));
$data['num_of_advertisers_7d'] = count($this->user_model->count_advertisers_reg_at_time(86400*7));
$data['num_of_publishers_30d'] = count($this->user_model->count_publishers_reg_at_time(2592000));
$data['num_of_advertisers_30d'] = count($this->user_model->count_advertisers_reg_at_time(2592000));

//users online within a period of time
$data['num_of_advertisers_online_24'] = count($this->user_model->count_advertisers_online_at_time(86400));
$data['num_of_advertisers_online_30d'] = count($this->user_model->count_advertisers_online_at_time(2592000));
$data['num_of_publishers_online_24'] = count($this->user_model->count_publishers_online_at_time(86400));
$data['num_of_publishers_online_30d'] = count($this->user_model->count_publishers_online_at_time(2592000));
$data['no_spaces'] = count($this->user_model->get_no_spaces());
$data['no_campaigns'] = count($this->user_model->get_no_campaigns());



$data['num_of_spaces_24'] = count($this->user_model->count_spaces_at_time(86400));
$data['num_of_spaces_7d'] = count($this->user_model->count_spaces_at_time(86400 *7));
$data['num_of_spaces_30d'] = count($this->user_model->count_spaces_at_time(2592000));

$data['num_of_campaigns_24'] = count($this->user_model->count_campaigns_at_time(86400));
$data['num_of_campaigns_7d'] = count($this->user_model->count_campaigns_at_time(86400*7));
$data['num_of_campaigns_30d'] = count($this->user_model->count_campaigns_at_time(2592000));
//exchange rate naira
$data['naira_rate'] = $this->publisher_model->get_naira_xrate();
//other block here
$data['num_of_views_24'] = count($this->admin_model->count_views_at_time(86400));
$data['num_of_views_7d'] = count($this->admin_model->count_views_at_time(86400 *7));
$data['num_of_views_30d'] = count($this->admin_model->count_views_at_time(2592000));

$data['num_of_clicks_24'] = count($this->admin_model->count_clicks_at_time(86400));
$data['num_of_clicks_7d'] = count($this->admin_model->count_clicks_at_time(86400*7));
$data['num_of_clicks_30d'] = count($this->admin_model->count_clicks_at_time(2592000));


$data['num_total_clicks'] = count($this->admin_model->count_total_clicks());
$data['num_total_views'] = count($this->admin_model->count_total_views());




//add pagination here later
$data['pending_campaigns'] = $this->admin_model->get_pending_campaigns();
$data['no_publishers'] = count($this->publisher_model->get_publishers());
	$data['no_advertisers'] = count($this->advertiser_model->get_advertisers());

//$data['countries'] = $this->admin_model->get_supported_countries();
  $this->load->view('/admin/header_view',$data);
	$this->load->view('admin/sidebar_view',$data);
	$this->load->view('admin/first_view',$data);
	$this->load->view('admin/footer_view');




}
public function pending_account_profile($id= NULL)
{


$data['title'] =$this->siteName." | User Profile";
$data['description'] ="Admin Dashboard";

$data["noindex"] = $this->noindex;
$limit = NULL;
$data['user'] = $this->user_model->get_user_by_its_id($id,"publishers");


  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/pending_publisher_profile_view',$data);
  $this->load->view('admin/footer_view');

}

public function pending_publishers_list($offset = 0)
{


    $limit = 8;
      $this->load->library('pagination');

        $data['items'] = $this->user_model->get_pending_publishers($offset,$limit);




    $config['base_url'] = site_url("admin/pending_publishers_list");

  $config['total_rows'] = count($this->user_model->get_pending_publishers(null,null));
  //$config['total_rows'] = $this->db->count_all('pages');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';

  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();

$data['title'] = "Pending Publishers List | Admin Area";

$this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);
      $this->load->view('admin/pending_userslist_view',$data);
      $this->load->view('admin/footer_view');



}

public function publishers_list($offset = 0) {


  	$limit = 8;
  		$this->load->library('pagination');




        $data['items'] = $this->user_model->get_publishers($offset,$limit);




  	$config['base_url'] = site_url("admin/publishers_list");



  $config['total_rows'] = count($this->user_model->get_publishers(null,null));
  //$config['total_rows'] = $this->db->count_all('pages');

  	$config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

$data["noindex"] = $this->noindex;

  	   $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();

$data['title'] = "Publishers List | Admin Area";

$this->load->view('/admin/header_view',$data);

  		$this->load->view('admin/sidebar_view',$data);

  		$this->load->view('admin/publishers_list_view',$data);
  		$this->load->view('admin/footer_view');



}



public function advertisers_list($offset = 0) {


    $limit = 8;
      $this->load->library('pagination');




        $data['items'] = $this->user_model->get_advertisers($offset,$limit);




    $config['base_url'] = site_url("admin/advertisers_list");



  $config['total_rows'] = count($this->user_model->get_advertisers(null,null));
  //$config['total_rows'] = $this->db->count_all('pages');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();

$data["noindex"] = $this->noindex;

$data['title'] = "Advertisers List | Admin Area";


$this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

      $this->load->view('admin/advertisers_list_view',$data);
      $this->load->view('admin/footer_view');



}



  public function withdrawal($offset = NULL)
{



    $limit = 8;
      $this->load->library('pagination');
$cond =array(

"status" => "pending"

);
$data['items'] = $this->admin_model->get_withdrawal($cond,$offset,$limit);
  $config['base_url'] = site_url("admin/withdrawal");
  $config['total_rows'] = count( $this->admin_model->get_withdrawal($cond,null,null));
  //$config['total_rows'] = $this->db->count_all('pages');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();


$data['title'] =$this->siteName." | Admin Payment Page";
$data['description'] = $this->description;
$data["noindex"] = $this->noindex;
$limit = NULL;
$data['payment_items'] = $this->user_model->get_payment_items($offset,$limit);
$cond = array(
"status" => "pending"


);






  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/admin_withdrawal_view',$data);
  $this->load->view('admin/footer_view');

}



  public function credit($table_type = NULL,$id = NULL)
{



$user = $this->user_model->get_user_by_its_id($id,$table_type);

$this->form_validation->set_rules('credit',"Amount","required");

if($this->form_validation->run())
{

//credit account




$user['account_bal'] = $user['account_bal'] + $this->input->post('credit');

//insert to db


$dat =array('account_bal' => $user['account_bal']);
$this->admin_model->update_user($table_type,$dat,$id);
$_SESSION['action_status_report'] = "ACcount Credited N".$this->input->post('credit')." successfully";
$this->session->mark_as_flash('action_status_report');
if($table_type =="advertisers")
{
show_page('admin/advertiser_profile_details/'.$id);

}else{
show_page('admin/publisher_profile_details/'.$id);
}
}
}






  public function disapprove_pending_publisher($id = NULL)
{

$user = $this->user_model->get_user_by_its_id($id,"publishers");

$this->admin_model->update_user("publishers",array("account_status" => "Disapproved"),$id);
$_SESSION['action_status_report'] = "<span class='w3-text-red'>Account Disapproved</span>";
$this->session->mark_as_flash('action_status_report');
$this->admin_model->delete_user($id,"publishers");

//send email here


$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from('support@Custch.com', 'System');
$this->email->to($user['email']);

$this->email->subject('Custch | Quality Advertising for Africa');

$this->email->message('Unfortunately,we coudn"t accept Your website/Blog/App Please read our acceptable websites guidelines here /n '.site_url('documentation/pub_guidlines').'\n NOTE: You can always re-register whenever you think you"ve meet our basic Publisher requirement \n thank you');

$this->email->send();





show_page('admin/pending_publishers_list');
}

  public function approve_pending_publisher($id = NULL)
{

$user = $this->user_model->get_user_by_its_id($id,"publishers");


$this->admin_model->update_user("publishers",array("account_status" => "active"),$id);
$_SESSION['action_status_report'] = "<span class='w3-text-red'>Account Approved</span>";

//send email here


$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from('support@Custch.com', 'System');
$this->email->to($user['email']);

$this->email->subject('Custch | Quality Advertising for Africa');
$this->email->message('Congratulations,Your Custch Publisher Account has been Approved \n You can login to your account using the link below '.site_url('login'));
$this->email->send();

$this->session->mark_as_flash('action_status_report');
show_page('admin/pending_publishers_list');
}


  public function debit($table_type,$id = NULL)
{

$user = $this->user_model->get_user_by_its_id($id,$table_type);

$this->form_validation->set_rules('debit',"Amount","required");

if($this->form_validation->run())
{

//credit account




$user['account_bal'] = $user['account_bal'] - $this->input->post('debit');

//insert to db


$dat =  array('account_bal' => $user['account_bal'] );
$this->admin_model->update_user($table_type,$dat,$id);
$_SESSION['action_status_report'] = "ACcount Debited ".$this->input->post('debit')." successfully";
$this->session->mark_as_flash('action_status_report');
if($table_type =="advertisers")
{
show_page('admin/advertiser_profile_details/'.$id);

}else{
show_page('admin/publisher_profile_details/'.$id);
}
}

}

public function process_withdrawal($id = NULL,$user_id)
{
$user = $this->user_model->get_user_by_its_id($user_id,"publishers");
//add to total withdrawn

$new_e_bal = $user['total_earning'] + $user['pending_bal'];

$this->user_model->edit_user_details(array(

"total_earning" => $new_e_bal,
"pending_bal" => 0.00

),$user_id,'publishers');


//change withdrawal status to proccessed

$this->admin_model->edit_withdrawal_single(array(

"status" => "processed"
),$id);

  //update neccessary details including history

  $this->admin_model->insert_new_history(array(
"user_id" => $user_id,
"action" => "w_process",
'time' => time(),
"details" => "Your Withdrawal Request Had been Processed",
"account_type" => "publisher"
),$user_id);




$_SESSION['action_status_report'] ="<span class='w3-text-green'>processed successfully</span>";
$this->session->mark_as_flash('action_status_report');
  show_page('/admin/withdrawal');

}


public function email($table_type,$id = NULL)
{




$data['title'] =$this->siteName." | Send Email to user";
$data['description'] ="Admin Dashboard";

$data["noindex"] = $this->noindex;
$limit = NULL;


$this->form_validation->set_rules('title','
  Message Title', 'required');

$this->form_validation->set_rules('contents','
  Message Contents', 'required');





if(!$this->form_validation->run())
{
  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/send_email_view',$data);
  $this->load->view('admin/footer_view');
}else{


$user = $this->user_model->get_user_by_its_id($this->uri->segment(4),$this->uri->segment(3));
$theemail = $user['email'];
  //db


//send email here

$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from('support@Custch.com.ng', 'System');
$this->email->to($theemail);

$this->email->subject('Custch | '.$this->input->post('title'));
$this->email->message($this->input->post('contents'));

$this->email->send();



  //sucesspage
    $_SESSION['action_status_report'] ='<span class="w3-text-green">The
     Email  has been sent successfully</span>';
    $this->session->mark_as_flash('action_status_report');
    show_page("admin/send_msg/".$this->uri->segment(3));








}



}

public function view_campaign_details($ref_id = NULL)
{




      $data["title"] =$this->siteName." | Admin Dashboard";
      $data["keywords"] = $this->keywords;
      $data["author"] = $this->author;
     $data["description"] = $this->description;

$data["noindex"] = $this->noindex;
$data['campaign'] = $this->admin_model->get_campaign_by_ref_id($ref_id);

 $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/campaign_details_view',$data);
  $this->load->view('admin/footer_view');
}



public function view_space_details($ref_id = NULL)
{




      $data["title"] =$this->siteName." | Admin Dashboard";
      $data["keywords"] = $this->keywords;
      $data["author"] = $this->author;
     $data["description"] = $this->description;

$data["noindex"] = $this->noindex;
$data['space'] = $this->admin_model->get_space_by_ref_id($ref_id);

 $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/space_details_view',$data);
  $this->load->view('admin/footer_view');
}



public function campaign_action($action,$ref_id)
{
if($action == "approve")
{
//approve here
$this->campaign_model->edit_campaign(array('approval' => "true","status" => "active"),$ref_id);

}elseif($action == "disapprove")
{//disapprove


  $this->campaign_model->edit_campaign(array('approval' => "false","status" => "inactive"),$ref_id);
//credit advertiser back its balance
  $campaign = $this->admin_model->get_campaign_by_ref_id($ref_id);
  $advertiser = $this->advertiser_model->get_advertiser_by_its_id($campaign['user_id']);
  $advertiser_new_balance = $advertiser['account_bal'] + $campaign['balance'];

  $this->user_model->edit_user_details(array("account_bal" => $advertiser_new_balance),$campaign['user_id'],"advertisers");

}elseif($action == "pause")
{//pause
  $this->campaign_model->edit_campaign(array('status' => "inactive"),$ref_id);

}elseif($action == "start")
{
//start again
    $this->campaign_model->edit_campaign(array('status' => "active"),$ref_id);


}

$_SESSION['action_status_report'] ="<span class='w3-text-green'>Campaign ".$action." successfully</span>";
$this->session->mark_as_flash("action_status_report");
show_page('admin/view_campaign_details/'.$ref_id);

}



public function space_action($action,$ref_id)
{
if($action == "pause")
{//pause
  $this->campaign_model->edit_space(array('status' => "inactive"),$ref_id);

}elseif($action == "start")
{
//start again
    $this->campaign_model->edit_space(array('status' => "active"),$ref_id);


}

$_SESSION['action_status_report'] ="<span class='w3-text-green'>Space ".$action." successfully</span>";
$this->session->mark_as_flash("action_status_report");
show_page('admin/view_space_details/'.$ref_id);

}

public function login_to_user_account($account_type = NULL,$id = NULL)
{
if($account_type == "advertiser")
  {

$_SESSION["id"] = $id;
 $_SESSION["accounttype"] ="Advertiser";
 $_SESSION['account_status'] = $this->user_model->get_user_by_its_id($id,"publishers")['account_status'];
$_SESSION["logged_in"] = true;

show_page("advertiser_dashboard");

  }else{

$_SESSION["id"] = $id;
 $_SESSION["accounttype"] ="Publisher";
  $_SESSION['account_status'] = $this->user_model->get_user_by_its_id($id,"advertisers")['account_status'];

$_SESSION["logged_in"] = true;

show_page("publisher_dashboard");


  }

}

public function suspend($table_type = NULL,$id = NULL)
{

$new_user_details = array('account_status' => "suspended" );

$this->admin_model->update_user($table_type,$new_user_details,$id);
$_SESSION['action_status_report'] = "<span class='w3-text-green'>ACcount
Suspended successfully</span>";
$this->session->mark_as_flash('action_status_report');

if($table_type == "advertisers")
{
$slug = "admin/advertiser_profile_details/".$id;
}else{
$slug = "admin/publisher_profile_details/".$id;

}
show_page($slug);


}



public function resume($table_type = NULL,$id = NULL)
{

$new_user_details = array('account_status' => "active" );

$this->admin_model->update_user($table_type,$new_user_details,$id);
$_SESSION['action_status_report'] = "<span class='w3-text-green'>ACcount
Resumed/Reactivated successfully</span>";
$this->session->mark_as_flash('action_status_report');

if($table_type == "advertisers")
{
$slug = "admin/advertiser_profile_details/".$id;
}else{
$slug = "admin/publisher_profile_details/".$id;

}
show_page($slug);


}



  public function publisher_profile_details($id = NULL)
  {

$data['title'] =$this->siteName." | Publisher Profile";
$data['description'] ="Admin Dashboard";

$data["noindex"] = $this->noindex;
$limit = NULL;
$data['user'] = $this->user_model->get_user_by_its_id($id,"publishers");


  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/publisher_profile_view',$data);
  $this->load->view('admin/footer_view');

}



  public function advertiser_profile_details($id = NULL)
  {

$data['title'] =$this->siteName." | Advertiser Profile";
$data['description'] ="Admin Dashboard";

$data["noindex"] = $this->noindex;
$limit = NULL;
$data['user'] = $this->user_model->get_user_by_its_id($id,"advertisers");


  $this->load->view('/admin/header_view',$data);

  $this->load->view('admin/sidebar_view',$data);

  $this->load->view('admin/advertiser_profile_view',$data);
  $this->load->view('admin/footer_view');

}



  public function search_users($offset = NULL)
  {

  //    $limit = 10;
      $limit = 8;

    $data['items']= $this->admin_model->search_users($limit,$offset);
      $this->load->library('pagination');

    $config['base_url'] = site_url("admin/search_users");

$config['total_rows'] = count($this->admin_model->search_users(NULL,NULL));
    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';

  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();







      $this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

              $this->load->view('admin/user_search_view',$data);
      $this->load->view('admin/footer_view');





  }

public function Campaigns($offset=0)
{

  //    $limit = 10;
      $limit = 8;


    $data['campaigns']= $this->admin_model->get_campaigns($limit,$offset);
      $this->load->library('pagination');

    $config['base_url'] = site_url("admin/Campaigns");



  $config['total_rows'] = $this->db->count_all('adv_story');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();






        //check login for admin here later

      $data["title"] =$this->siteName." | Admin Dashboard";
      $data["keywords"] = $this->keywords;
      $data["author"] = $this->author;
     $data["description"] = $this->description;

$data["noindex"] = $this->noindex;
      $this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

              $this->load->view('admin/campaigns_view',$data);
      $this->load->view('admin/footer_view');

}


public function spaces($offset=0)
{
      $limit = 8;


    $data['spaces']= $this->admin_model->get_spaces($limit,$offset);
      $this->load->library('pagination');

    $config['base_url'] = site_url("admin/spaces");



  $config['total_rows'] = $this->db->count_all('pub_story');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();






        //check login for admin here later

      $data["title"] =$this->siteName." | Admin Dashboard";
      $data["keywords"] = $this->keywords;
      $data["author"] = $this->author;
     $data["description"] = $this->description;

$data["noindex"] = $this->noindex;
      $this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

              $this->load->view('admin/spaces_view',$data);
      $this->load->view('admin/footer_view');

}

  public function messages($offset=0)
  {







  //    $limit = 10;
      $limit = 8;


    $data['items']= $this->admin_model->messages($limit,$offset);
      $this->load->library('pagination');

    $config['base_url'] = site_url("admin/messages");



  $config['total_rows'] = $this->db->count_all('cmessages');

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';



  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();
 //check login for admin here later

      $this->load->view('/admin/header_view',$data);

      $this->load->view('admin/sidebar_view',$data);

              $this->load->view('admin/messages_view',$data);
      $this->load->view('admin/footer_view');



  }
  public function site_settings(){

if (!isset($_POST['submit'])) {
 
$data['title'] =$this->siteName." | Site Settings";
$data['description'] ="Admin Dashboard";

$data["noindex"] = $this->noindex;

$data['site_name']= $this->siteName;
$data['site_keywords']=$this->keywords;
$data['site_author']=$this->author;
$data['site_tagline']=$this->tagLine;
$data['site_descriptions']= $this->description;
  $this->load->view('/admin/header_view',$data);
  $this->load->view('admin/sidebar_view',$data);
  $this->load->view('admin/site_settings_view',$data);
  $this->load->view('admin/footer_view');
}else{
//submit btn is clicked
    if ($this->admin_model->edit_site_details()){
      
$_SESSION['action_status_report']="<span class='w3-text-green'>Changes Saved</span>";
    $this->session->mark_as_flash("action_status_report");


    }else{
    $_SESSION['action_status_report']="<span class='w3-text-red'>Unknown Error Occurred</span>";
    $this->session->mark_as_flash("action_status_report");

    }

    show_page("admin/site_settings");
}


  }

public function business_settings(){

if (!isset($_POST['submit'])) {
 
$data['title'] =$this->siteName." | Site Settings";
$data['description'] ="Admin Dashboard";

$data["noindex"] = $this->noindex;
  $data['settings'] = $this->admin_model->get_business_settings();

  $this->load->view('/admin/header_view',$data);
  $this->load->view('admin/sidebar_view',$data);
  $this->load->view('admin/business_settings_view',$data);
  $this->load->view('admin/footer_view');
}else{
//submit btn is clicked
    if ($this->admin_model->set_business_settings()){
      
$_SESSION['action_status_report']="<span class='w3-text-green'>Changes Saved</span>";
    $this->session->mark_as_flash("action_status_report");


    }else{
    $_SESSION['action_status_report']="<span class='w3-text-red'>Unknown Error Occurred</span>";
    $this->session->mark_as_flash("action_status_report");

    }

    show_page("admin/business_settings");
}


  }


  public function view_message($id = null)
  {



          $data['item'] = $this->admin_model->get_message($id);



  		$this->load->view('/admin/header_view',$data);

  		$this->load->view('admin/sidebar_view',$data);

  						$this->load->view('admin/message_view',$data);
  		$this->load->view('admin/footer_view');






  }

}
