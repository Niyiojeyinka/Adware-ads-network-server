<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***
 * Name:      Custch
 * Package:  form.php
 * About:        A controller that handles advertiser operation
 * Copyright:  (C) 2018,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/





class Cpa_form extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(array('blog_model','advertiser_model','campaign_model','publisher_model'));
    $this->load->library(array('session','form_validation','user_agent'));
     $this->load->helper(array('url','form','page_helper','blog_helper'));
       //get details from db later (The web details)
      $this->siteName = "Ad Network";
      $this->author = "The author";
      $this->keywords = "The keywords here";
      $this->description= "the description";
      $this->noindex = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

   
}
//check for cookie/session for multiple form input

public function index($slug,$advert_id=NULL,$space_id=NULL)
{
      $data['cpa_form'] = $this->advertiser_model->get_cpa_form_by_slug($slug);
      $data['title'] = $data['cpa_form']['name']." powered by ".$this->siteName
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
      $data["noindex"] = $this->noindex;
      if (isset($_SESSION['prevent_multiple_sub'])) {
        
if (in_array($slug, $_SESSION['prevent_multiple_sub'])) {
  show_page('cpa_form/submitted_already/'.$slug);
}
}


    $this->load->view('/common/form_header_view',$data);
     
    $this->load->view('/public/form_contents_view',$data);
     $this->load->view('/common/footer_view',$data);


}


public function submit_form($slug,$advert_id=NULL,$space_id=NULL)
{
  if (isset($_POST['submit'])){
   
     $data['cpa_form'] = $this->advertiser_model->get_cpa_form_by_slug($slug);
      $data['title'] = $data['cpa_form']['name']." powered by ".$this->siteName
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
      $data["noindex"] = $this->noindex;
    $gotten_data = json_decode($data['cpa_form']['form_data']);

     unset($_POST['submit']);
    
     $_POST['time']= time();
array_push($gotten_data, $_POST);
$this->advertiser_model->update_form_data($gotten_data,$slug);
//var_dump($_POST);

  
  //prevent multiple submition
if (!isset($_SESSION['prevent_multiple_sub'])) {
  $_SESSION['prevent_multiple_sub'] = [];
}

if(!in_array($slug, $_SESSION['prevent_multiple_sub']))
{
  array_push($_SESSION['prevent_multiple_sub'], $slug);
}
//pay accordingly here
if (!empty($advert_id) && (!empty($space_id))) {
  
$space = $this->campaign_model->get_space_by_ref_id($space_id);
$publisher = $this->publisher_model->get_publisher_by_its_id($space['user_id']);
$campaign_rendered = $this->campaign_model->get_by_campaign_by_ref_id($advert_id);
$publisher_id = $space['user_id'];
$advertiser_id = $campaign_rendered['user_id'];
$ref_id = $advert_id;

//bill advertiser
if($campaign_rendered['balance'] < $campaign_rendered['per_action'])
{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$ref_id);
}
if($campaign_rendered['balance'] >= $campaign_rendered['per_action'])
{

$campaign_new_balance = $campaign_rendered['balance'] - $campaign_rendered['per_action'];
$this->campaign_model->insert_new_balance($campaign_new_balance,$campaign_rendered['ref_id']);
//credit publisher
$publisher_new_balance = $publisher['account_bal'] + ((70/100) * $campaign_rendered['per_action']);
$dat_admin =  array(
        'time' => time(),
        'year' => getdate()['year'],
        'weekday' => getdate()['weekday'],
        'month' => getdate()['month'],
        'earning_type' => "action",
        'type' =>$campaign_rendered['type'],
        'amount' => ((30/100) * $campaign_to_render['per_action'])
         );
    
    $this->user_model->insert_admin_noti($dat_admin);

$this->publisher_model->insert_new_balance($publisher_new_balance,$publisher_id);

}else{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$ref_id);
}

}
$this->load->view('/common/form_header_view',$data);
$this->load->view('/public/post_form_view',$data);
$this->load->view('/common/footer_view',$data);
}

}

public function submitted_already($slug)
{
     $data['cpa_form'] = $this->advertiser_model->get_cpa_form_by_slug($slug);
      $data['title'] = $data['cpa_form']['name']." powered by ".$this->siteName
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
      $data["noindex"] = $this->noindex;
   
$this->load->view('/common/form_header_view',$data);
$this->load->view('/public/form_submitted_already_view',$data);
$this->load->view('/common/footer_view',$data);


}




}