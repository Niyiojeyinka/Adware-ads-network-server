<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/***
 * Name:      AdNetwork
 * Package:   Campaign_delivery.php
 * About:    A controller that handles campaign delivery api operation
 * Copyright:  (C) 2018,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/


class Campaign_delivery extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(array('blog_model','campaign_model','advertiser_model','publisher_model','user_model'));
    $this->load->library(array('session','form_validation','user_agent'));
     $this->load->helper(array('url','form','page_helper'));
   
}
/*
public function delivery()
{
  
header("Access-Control-Allow-Origin: *");
echo json_encode(array(
    'field' => 'value'
));

  
}
*/
public function deliver_text_js($space_id = NULL)
{
$space = $this->campaign_model->get_space_by_ref_id($space_id);
$space_categories =[];
$publisher = $this->publisher_model->get_publisher_by_its_id($space['user_id']);

for ($i=0; $i < count(json_decode($space['category'])) ; $i++) { 
  
if(!empty($hold = $this->campaign_model->get_campaign_by_category_text(json_decode($space['category'])[$i],$publisher['country'])
))
{
array_push($space_categories, $hold[mt_rand(0,count($hold)-1)]['category']);
unset($hold);
}
}

//var_dump($space_categories);
if(empty($space_categories))
{
  array_push($space_categories,"AdNetwork");
  //set ads category to show if publisher category is unavailable
}

$campaign_to_render = NULL;
//targetting variable
 $client_browser = $this->agent->browser();
 $client_os = explode(" ", $this->agent->platform())[0];
$count = 0;

do {
$count++;
$category = $space_categories[mt_rand(0,count($space_categories)-1)];
//var_dump($category);

$resulted_campaigns = $this->campaign_model->get_campaign_by_category_text($category,$publisher['country']);
//note the singularity
$resulted_campaign = $resulted_campaigns[mt_rand(0,count($resulted_campaigns)-1)];

if($resulted_campaign['targeting'] == 'false')
{
//if general or targetting option is skipped by advertiser
$campaign_to_render = $resulted_campaign;
}else{

$arr = array('tplatform','tbrowser');
$index_from_random = mt_rand(0,count($arr)-1);
$target_to_use = $arr[$index_from_random];
if ($target_to_use == "tplatform")
{
  foreach (json_decode($resulted_campaign['tplatform'] ) as $target_platform) {
  	
  	if (strtolower($client_os) == strtolower($target_platform))
  	{
       $campaign_to_render = $resulted_campaign;
  		break;
  	}
  
}

}elseif($target_to_use == "tbrowser"){
foreach (json_decode($resulted_campaign['tbrowser'] ) as $target_browser) {
  	
  	if (strtolower($client_browser) == strtolower($target_browser))
  	{
       $campaign_to_render = $resulted_campaign;
  		break;
  	}
  
}

}

}
if($count == 5)
{
	break;
}
}while(empty($campaign_to_render));

//add base url to the array
$campaign_to_render['click_url'] = site_url('Campaign_delivery/click/');
//get both campaign and space here and record its view accordingly
//deduct for view and credit accordingly and check for duplicate //view deducting and creditng
$publisher_id = $space['user_id'];
$advertiser_id = $campaign_to_render['user_id'];

//check for duplicate view on same ads

if(empty($this->campaign_model->get_campaign_view(array('ip' => get_client_ip(),'story_id' => $campaign_to_render['ref_id'],'story_pid' => $publisher['id']))))
{
$publisher_details = $this->publisher_model->get_publisher_by_its_id($publisher_id);
//cpm here is the cost per view for advertiser


//bill advertiser
if($campaign_to_render['balance'] < 0)
{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$campaign_to_render['ref_id']);
}

if($campaign_to_render['balance'] >= $campaign_to_render['per_view'])
{

$campaign_new_balance = $campaign_to_render['balance'] - $campaign_to_render['per_view'];
$this->campaign_model->insert_new_balance($campaign_new_balance,$campaign_to_render['ref_id']);
//credit publisher
$publisher_new_balance = $publisher_details['account_bal'] + ((70/100) * $campaign_to_render['per_view']);

  $dat_admin =  array(
        'time' => time(),
        'year' => getdate()['year'],
        'weekday' => getdate()['weekday'],
        'month' => getdate()['month'],
        'earning_type' => "view",
        'type' => "text",
        'amount' => ((30/100) * $campaign_to_render['per_view'])
         );
    
    $this->user_model->insert_admin_noti($dat_admin);

$this->publisher_model->insert_new_balance($publisher_new_balance,$publisher_id);
}else{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$campaign_to_render['ref_id']);
}


}

//insert view here
$this->campaign_model->insert_view(array("story_pid" => $publisher_id,"story_aid" => $advertiser_id ,"space_id" => $space_id,"browser" => $this->agent->browser(),"story_id" => $campaign_to_render['ref_id'],"ip" => get_client_ip(),"platform" => $this->agent->platform(),"time" => time(),"is_mobile" => $this->agent->is_mobile()));


Header("content-type: application/x-javascript");
if(!empty($campaign_to_render))
{
//paint border blue
  $text_style = 'class="w3-card w3-border w3-border-blue w3-padding w3-center"';
//make_object_unique
  $mou = mt_rand(0,10);
}else{
//dont
  $text_style =NULL;

}
echo "var gotten".$mou." = ".json_encode($campaign_to_render).";";
echo "$(document).ready(function() {
 $('#".$space['div_id']."').html('<div ".$text_style."><a href=\''+gotten".$mou."['click_url']+gotten".$mou."['ref_id']+'/".$space_id."\'><div><span class=\'w3-text-blue\'>'+gotten".$mou."['text_title']+'</span><div class=\'w3-container w3-small\'>'+gotten".$mou."['text_content']+'</div><span class=\'w3-text-blue\'>'+gotten".$mou."['disp_link']+'</span> <span class=\'w3-text-blue w3-tiny\'>Powered by <a  class=\'w3-text-indigo w3-small w3-serif\' href=\'http://www.AdNetwork.com\'><b>AdNetwork</b></a></span></div></a></div>');
  }
    );";


}
//start here



public function deliver_banner_js($space_id = NULL,$size_type)
{
  /*
box:Box /style ads
rec: Rectangular image ads style
sta: Standing ads type
  */
if($size_type == "box")
{
  $size_to_get = "300X250";
}elseif($size_type == "rec") {
  $size_to_get = "720X90";
}elseif($size_type == "sta") {
  $size_to_get = "160X600";
}

$space = $this->campaign_model->get_space_by_ref_id($space_id);
$space_categories =[];
$publisher = $this->publisher_model->get_publisher_by_its_id($space['user_id']);

for ($i=0; $i < count(json_decode($space['category'])) ; $i++) { 
  
if(!empty($hold = $this->campaign_model->get_campaign_by_category_banner(json_decode($space['category'])[$i],$publisher['country'],$size_to_get)
))
{
array_push($space_categories, $hold[mt_rand(0,count($hold)-1)]['category']);
unset($hold);
}
}

//var_dump($space_categories);
if(empty($space_categories))
{
  array_push($space_categories,"AdNetwork");
  //set ads category to show if publisher category is unavailable
}

$campaign_to_render = NULL;
//targetting variable
 $client_browser = $this->agent->browser();
 $client_os = explode(" ", $this->agent->platform())[0];
$count = 0;

do {
$count++;
$category = $space_categories[mt_rand(0,count($space_categories)-1)];
//var_dump($category);

$resulted_campaigns = $this->campaign_model->get_campaign_by_category_banner($category,$publisher['country'],$size_to_get);
//note the singularity
$resulted_campaign = $resulted_campaigns[mt_rand(0,count($resulted_campaigns)-1)];

if($resulted_campaign['targeting'] == 'false')
{
//if general or targetting option is skipped by advertiser
$campaign_to_render = $resulted_campaign;
}else{

$arr = array('tplatform','tbrowser');
$index_from_random = mt_rand(0,count($arr)-1);
$target_to_use = $arr[$index_from_random];
if ($target_to_use == "tplatform")
{
  foreach (json_decode($resulted_campaign['tplatform'] ) as $target_platform) {
    
    if (strtolower($client_os) == strtolower($target_platform))
    {
       $campaign_to_render = $resulted_campaign;
      break;
    }
  
}

}elseif($target_to_use == "tbrowser"){
foreach (json_decode($resulted_campaign['tbrowser'] ) as $target_browser) {
    
    if (strtolower($client_browser) == strtolower($target_browser))
    {
       $campaign_to_render = $resulted_campaign;
      break;
    }
  
}

}

}
if($count == 5)
{
  break;
}
}while(empty($campaign_to_render));

//add base url to the array
$campaign_to_render['click_url'] = site_url('Campaign_delivery/click/');
//banner url
$campaign_to_render['banner_url'] = base_url('assets/campaigns/'.$campaign_to_render['img_link']);

//get both campaign and space here and record its view accordingly
//deduct for view and credit accordingly and check for duplicate //view deducting and creditng
$publisher_id = $space['user_id'];
$advertiser_id = $campaign_to_render['user_id'];
//check for duplicate view on same ads

if(empty($this->campaign_model->get_campaign_view(array('ip' => get_client_ip(),'story_id' => $campaign_to_render['ref_id'],'story_pid' => $publisher['id']))))
{

$publisher_details = $this->publisher_model->get_publisher_by_its_id($publisher_id);
//cpm here is the cost per view for advertiser


//bill advertiser
if($campaign_to_render['balance'] < 0)
{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$campaign_to_render['ref_id']);
}
if($campaign_to_render['balance'] >= $campaign_to_render['per_view'])
{

$campaign_new_balance = $campaign_to_render['balance'] - $campaign_to_render['per_view'];
$this->campaign_model->insert_new_balance($campaign_new_balance,$campaign_to_render['ref_id']);
//credit publisher
$publisher_new_balance = $publisher_details['account_bal'] + ((70/100) * $campaign_to_render['per_view']);

  $dat_admin =  array(
        'time' => time(),
        'year' => getdate()['year'],
        'weekday' => getdate()['weekday'],
        'month' => getdate()['month'],
        'earning_type' => "view",
        'type' => "banner",
        'amount' => ((30/100) * $campaign_to_render['per_view'])
         );
    
    $this->user_model->insert_admin_noti($dat_admin);

$this->publisher_model->insert_new_balance($publisher_new_balance,$publisher_id);
}else{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$campaign_to_render['ref_id']);
}


}
//insert view here
$this->campaign_model->insert_view(array("story_pid" => $publisher_id,"story_aid" => $advertiser_id ,"space_id" => $space_id,"browser" => $this->agent->browser(),"story_id" => $campaign_to_render['ref_id'],"ip" => get_client_ip(),"platform" => $this->agent->platform(),"time" => time(),"is_mobile" => $this->agent->is_mobile()));
$size =  explode('X', $space['size']);


Header("content-type: application/x-javascript");
//make_object_unique
  $mou = mt_rand(0,10);
echo "var imggotten".$mou." = ".json_encode($campaign_to_render).";";

//image ads here
echo "$(document).ready(function() {
 $('#".$space['div_id']."').html('<div style=\'max-width:".$size[0]."px;height:".$size[1]."px;\' class=\'w3-display-container\'><a href=\''+imggotten".$mou."['click_url']+imggotten".$mou."['ref_id']+'/".$space_id."\'><img class=\'\' style=\'display:block;width:100%;\' src=\''+imggotten".$mou."['banner_url']+'\'/></a><div class=\'w3-display-topright w3-text-blue w3-tiny w3-serif w3-border w3-border-blue\'><b><a href=\'http://www.AdNetwork.com\'>AdNetwork Ads</a></b></div></div>');
  }
    );";

}




//end here


public function deliver_recommendation_js($space_id,$no_reco)
{
//recommendation

$space = $this->campaign_model->get_space_by_ref_id($space_id);
$space_categories =[];
 $client_browser = $this->agent->browser();
 $client_os = explode(" ", $this->agent->platform())[0];
$publisher = $this->publisher_model->get_publisher_by_its_id($space['user_id']);
//ads gotten using country and category campaign_cc_targeting
$campaigns_cc_targeting_ids =  $this->campaign_model->get_campaigns_ref_id_for_reco(json_decode($space['category']),$publisher['country']);
//echo var_dump($campaigns_cc_targeting_ids);

$campaigns_rendable = [];
foreach ($campaigns_cc_targeting_ids as $campaign_ref_id) {
//get each campaign by its ref_id
  $each_campaign = $this->campaign_model->get_campaign_by_ref_id($campaign_ref_id);

  //check for browser targeting here & Desktop targeting
  //note the singularity

if($each_campaign['targeting'] == 'false')
{
//if general or targetting option is skipped by advertiser
array_push($campaigns_rendable,$each_campaign);
}else{

$arr = array('tplatform','tbrowser');
$index_from_random = mt_rand(0,count($arr)-1);
$target_to_use = $arr[$index_from_random];
if ($target_to_use == "tplatform")
{
  foreach (json_decode($each_campaign['tplatform'] ) as $target_platform) {
    
    if (strtolower($client_os) == strtolower($target_platform))
    {
array_push($campaigns_rendable,$each_campaign);
      break;
    }
  
}

}elseif($target_to_use == "tbrowser"){
foreach (json_decode($each_campaign['tbrowser'] ) as $target_browser) {
    
    if (strtolower($client_browser) == strtolower($target_browser))
    {
array_push($campaigns_rendable,$each_campaign);
      break;
    }
  
}

}

}
}

if (count($campaigns_rendable) > $no_reco) {
  //then limit to no recommendation
  //first come first serve basis here
  $campaigns_rendable = array_slice($campaigns_rendable, 0,$no_reco);
}

  $publisher_id = $space['user_id'];

for($i = 0;$i<count($campaigns_rendable);$i++){
 //add base url

  $campaigns_rendable[$i]['click_url'] = site_url('Campaign_delivery/click/');

  $campaigns_rendable[$i]['banner_url'] = base_url('assets/campaigns/'.$campaigns_rendable[$i]['img_link']);
$advertiser_id = $campaigns_rendable[$i]['user_id'];

//get both campaign and space here and record its view accordingly
//deduct for view and credit accordingly and check for duplicate //view deducting and crediting
  //insert stats

//check for duplicate view on same ads

if(empty($this->campaign_model->get_campaign_view(array('ip' => get_client_ip(),'story_id' => $campaigns_rendable[$i]['ref_id'],'story_pid' => $publisher['id']))))
{

$publisher_details = $this->publisher_model->get_publisher_by_its_id($publisher_id);
//cpm here is the cost per view for advertiser


//bill advertiser
if($campaigns_rendable[$i]['balance'] < 0)
{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$ref_id);
}
if($campaigns_rendable[$i]['balance'] >= $campaigns_rendable[$i]['per_view'])
{

$campaign_new_balance = $campaigns_rendable[$i]['balance'] - $campaigns_rendable[$i]['per_view'];
$this->campaign_model->insert_new_balance($campaign_new_balance,$campaigns_rendable[$i]['ref_id']);
//credit publisher
$publisher_new_balance = $publisher_details['account_bal'] + ((70/100) * $campaigns_rendable[$i]['per_view']);

  $dat_admin =  array(
        'time' => time(),
        'year' => getdate()['year'],
        'weekday' => getdate()['weekday'],
        'month' => getdate()['month'],
        'earning_type' => "view",
        'type' => "recommendation",
        'amount' => ((30/100) * $campaigns_rendable[$i]['per_view'])
         );
    
    $this->user_model->insert_admin_noti($dat_admin);

$this->publisher_model->insert_new_balance($publisher_new_balance,$publisher_id);
}else{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$campaigns_rendable[$i]['ref_id']);
}


}

//insert view here
$this->campaign_model->insert_view(array("story_pid" => $publisher_id,"story_aid" => $advertiser_id ,"space_id" => $space_id,"browser" => $this->agent->browser(),"story_id" => $campaigns_rendable[$i]['ref_id'],"ip" => get_client_ip(),"platform" => $this->agent->platform(),"time" => time(),"is_mobile" => $this->agent->is_mobile()));
}




Header("content-type: application/x-javascript");
//make_object_unique
$campaigns_rendable_html="";
$count =1;
foreach ($campaigns_rendable as $campaign_rendable) {
  //to ensure uniqueness
$mou = $count."".mt_rand(0,60);
//mou = each ads id
echo "var imggotten".$mou." = ".json_encode($campaign_rendable).";";

$hold = "<a href=\''+imggotten".$mou."['click_url']+imggotten".$mou."['ref_id']+'/".$space_id."\'><div class=\'w3-container w3-row w3-border w3-margin-bottom w3-padding w3-center w3-col s12 m6 l4\'><div class=\'w3-col s4 m12 w3-padding\'><img class=\'w3-image w3-margin-top\' src=\''+imggotten".$mou."['banner_url']+'\'/></div><div id=\'text\' class=\'w3-col s8 m12 w3-padding-bottom\' ><span class=\'w3-large\' id=\'text\'><b>'+imggotten".$mou."['text_title']+'</b></span></div></div></a>";
$campaigns_rendable_html= $campaigns_rendable_html."".$hold;
$count++;

unset($hold);
}

 //display here 
echo "$(document).ready(function() {
 $('#".$space['div_id']."').html('<br><div class=\'w3-container w3-display-container w3-padding\'><style type=\'text/css\'>@media screen and (max-width: 500px){#text{text-align: justify;}}@media screen and (min-width: 500px){#text{text-align: center;}</style>".$campaigns_rendable_html."<div class=\'w3-display-topright w3-text-blue w3-tiny w3-serif w3-border w3-border-blue w3-margin-right\'><b><a href=\'http://www.AdNetwork.com\'>Recommendation by AdNetwork</a></b></div></div>');
  }
    );";


}



public function click($ref_id,$space_id)
{

$space = $this->campaign_model->get_space_by_ref_id($space_id);
$publisher = $this->publisher_model->get_publisher_by_its_id($space['user_id']);

//get details
//check for valid click
//credit publisher
//debit advertiser
//record accordingly
//if debit unsuccessful end campaign

//get both campaign and space here and record its view accordingly
//deduct for view and credit accordingly and check for duplicate //view deducting and creditng
$campaign_rendered = $this->campaign_model->get_campaign_by_ref_id($ref_id);
$publisher_id = $space['user_id'];
$advertiser_id = $campaign_rendered['user_id'];
//check for duplicate view on same ads


if(empty($this->campaign_model->get_campaign_click(array('ip' => get_client_ip(),'story_id' => $campaign_rendered['ref_id'],'story_pid' => $publisher['id']))))
{
$publisher_details = $this->publisher_model->get_publisher_by_its_id($publisher_id);


//bill advertiser
if($campaign_rendered['balance'] < 0)
{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$campaign_rendered['ref_id']);
}
if($campaign_rendered['balance'] >= $campaign_rendered['per_click'])
{

$campaign_new_balance = $campaign_rendered['balance'] - $campaign_rendered['per_click'];
$this->campaign_model->insert_new_balance($campaign_new_balance,$campaign_rendered['ref_id']);
//credit publisher
$publisher_new_balance = $publisher_details['account_bal'] + ((70/100) * $campaign_rendered['per_click']);
$dat_admin =  array(
        'time' => time(),
        'year' => getdate()['year'],
        'weekday' => getdate()['weekday'],
        'month' => getdate()['month'],
        'earning_type' => "click",
        'type' =>$campaign_rendered['type'],
        'amount' => ((30/100) * $campaign_to_render['per_click'])
         );
    
    $this->user_model->insert_admin_noti($dat_admin);

$this->publisher_model->insert_new_balance($publisher_new_balance,$publisher_id);

}else{
//mark as inactive
  $this->campaign_model->edit_campaign(array("status" => "inactive"),$campaign_rendered['ref_id']);
}

}

//insert click here
$this->campaign_model->insert_click(array("story_pid" => $publisher_id,"story_aid" => $advertiser_id ,"space_id" => $space_id,"browser" => $this->agent->browser(),"story_id" => $ref_id,"ip" => get_client_ip(),"platform" => $this->agent->platform(),"time" => time(),"is_mobile" => $this->agent->is_mobile()));

if(empty($campaign_rendered['cpa_id']))
{
  //if not cpa
//redirect to destination url
header('Location: http://'.$campaign_rendered['dest_link']);
}else{
  //get cpa slug here
  $cpa = $this->advertiser_model->get_cpa_form_by_ref_id($campaign_rendered['cpa_id']);

  show_page('cpa_form/index/'.$cpa['form_slug'].'/'.$ref_id.'/'.$space_id);
}


}



}