<?php

class Advertiser_model extends CI_Model {


/***
 * Name:       Custch
 * Package:    advertiser_model.php
 * About:        A model class that handle Custch's Advertiser model operation
 * Copyright:  (C) 2017,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();

}
public function insert_addon_details($ref_id)
{
$data_db= array(
'extra_data' => $this->input->post('contents'),
'extra_data_position' => $this->input->post('position'));

$this->db->update('cpa_forms',$data_db,array('ref_id' => $ref_id));
}
public function insert_cpa_form($form_makeup_data_string,$ref_id){
$data_db =array(

"name" => $this->input->post('form_name'),
"advertisers_id" => $_SESSION['id'],
"form_makeup_data" => $form_makeup_data_string,
"form_data" => "[]",
"access_type" => $this->input->post('access_type'),
"currency_code" => $this->input->post('currency'),
"price" => $this->input->post('product_price'),
"company_name" => $this->input->post('company_name'),
'ref_id' => $ref_id,
'form_slug' => url_title($this->input->post('form_name'),"dash",TRUE),
'time' => time()
); 

$this->db->insert('cpa_forms',$data_db);

}
public function get_cpa_form_by_slug($slug)
{


  $query= $this->db->get_where('cpa_forms',array('form_slug' => $slug));
  return $query->row_array();

}

public function update_form_data($arr,$slug)
{

$this->db->update('cpa_forms',array('form_data' =>json_encode($arr)),array('form_slug' => $slug));

}
public function edit_cpa_form($form_makeup_data_array,$ref_id){

$data_db =array(

"name" => $this->input->post('form_name'),
"advertisers_id" => $_SESSION['id'],
"form_makeup_data" => json_encode($form_makeup_data_array,true),
"currency_code" => $this->input->post('currency'),
"price" => $this->input->post('product_price'),
"company_name" => $this->input->post('company_name'),
'ref_id' => $ref_id,
'form_slug' => url_title($this->input->post('form_name'),"dash",TRUE),
'time' => time()
); 

$this->db->update('cpa_forms',$data_db,array('ref_id' => $ref_id));

}

public function edit_form_fields($form_makeup_data_array,$ref_id){

$data_db =array(


"form_makeup_data" => json_encode($form_makeup_data_array,true),
'time' => time()
); 

$this->db->update('cpa_forms',$data_db,array('ref_id' => $ref_id));

}

public function get_advertiser_by_id()
{


    $query = $this->db->get_where('advertisers',array("id" => $_SESSION["id"]));
  return $query->row_array();
}

//new
public function get_advertiser_by_its_id($id)
{


    $query = $this->db->get_where('advertisers',array("id" => $id));
  return $query->row_array();
}

public function get_minimum_value($type)
{

  $query = $this->db->get_where("system_var",array("variable_name" => "minimum_".$type));
  return $query->row_array()['variable_value'];
}

//new
public function insert_new_password()
{

$dab = array(

"password" => md5(md5($this->input->post("new_password")))




)  ;

   if ($this->db->update("advertisers",$dab,array("id" => $_SESSION["id"])))
   {


    return true;

   }
    return false;


}
public function get_advertisers()
{

  $query = $this->db->get('advertisers');
  return $query->result_array();
}

//new
public function get_no_affilate_clicks($account_type)
{


    $query = $this->db->get_where('affilate_clicks',array("referral_id" =>$_SESSION['id'],"account_type" => $account_type));
  return count($query->result_array());
}
//new
public function get_no_affilate_reg($account_type)
{
//no of user invited this session id

    $query = $this->db->get_where($account_type.'s',array("referral_id" => $_SESSION['id']));
  return count($query->result_array());
}


//New
public function insert_new_email()
{

$dab = array(

"email" => $this->input->post("new_email")

)  ;

   if ($this->db->update("advertisers",$dab,array("id" => $_SESSION["id"])))
   {
 return true;

   }
    return false;


}
public function credit_balance($arr)
{

  $this->db->update('advertisers',$arr,array("id" => $_SESSION['id']));
}

public function insert_to_payment_record($arr)
{
  $this->db->insert('payments',$arr);
}

public function insert_campaign_step_two($ref_id){
if(is_array($this->input->post("platform")))
{
$_tplatform = json_encode($this->input->post("platform"));

}else
{
$_tplatform = null;


}


if(is_array($this->input->post("browser")))
{
$_tbrowser = json_encode($this->input->post("browser"));

}else
{
$_tbrowser = null;


}


if(is_array($this->input->post("tcountry")))
{
$_tcountry = json_encode($this->input->post("tcountry"));

}else
{
$_tcountry = null;
}
if(is_array($this->input->post("tcategory")))
{
$_tcategory = json_encode($this->input->post("tcategory"));

}else
{
$_tcategory = null;
}
$datab2 = array(
'targeting' => "true",
'tcategory' => $_tcategory,
'tbrowser' => $_tbrowser,
'tcountry' => $_tcountry,
'tplatform' => $_tplatform,
 'cr_level' => "2"
);

$this->db->update('adv_story',$datab2, array("ref_id" => $ref_id,"user_id" => $_SESSION['id']));
}


public function insert_campaign_step_three($ref_id,$user){



if(($user['account_bal'] < $this->input->post('budget')) || ($this->input->post('budget') <=  $this->input->post('cpc'))){
//to handle case budget <5
$_SESSION['action_status_report'] ="<span class='w3-text-red'>Insufficient Budget:your balance is ".$user['account_bal']."</span>" ;
$this->session->mark_as_flash('action_status_report');

show_page("advertiser_dashboard/campaign_budget/".$ref_id);
}else
{
$new_acct_bal = $user['account_bal'] - $this->input->post('budget');

$databu = array('account_bal' => $new_acct_bal);
if($this->input->post('billing') == "cpc")
{
$cpc = 0.000;
  $cpm = $this->input->post('cpc');
  

}elseif($this->input->post('billing') == "ppc")
{
  $cpc = $this->input->post('cpc');
  $cpm = 0.000;
  
}elseif($this->input->post('billing') == "both")
{
  $cpc = $this->input->post('cpc');
  $cpm = $this->input->post('cpv');
  
}elseif($this->input->post('billing') == "cpa")
{
  $cpa = $this->input->post('cpa');
  $cpc = 0.000;
  $cpm = 0.000;
  
}

$datab2 = array(

'budget' => $this->input->post('budget'),
'per_click' => $cpc,
'per_view' => $cpm,
'per_action' => $cpa,
'start_time' =>   strtotime($this->input->post("sdate")),
'expire_time' => strtotime($this->input->post("edate")),
'status' => 'Pending',
'approval' => 'Pending',
"edit_status" => "complete",
'balance' =>  $this->input->post('budget'),
'time' => time(),
'cr_level' => "3"

);

if( $this->db->update('adv_story',$datab2, array("ref_id" => $ref_id,"user_id" => $_SESSION['id'])) && $this->db->update('advertisers',$databu, array("id" => $_SESSION['id'])))
{
$_SESSION['action_status_report'] ="Action successful" ;
$this->session->mark_as_flash('action_status_report');
show_page("advertiser_dashboard/campaign");

  //yes
}else{
$_SESSION['action_status_report'] ="unnown error occured" ;
$this->session->mark_as_flash('action_status_report');
show_page("advertiser_dashboard/campaign_budget/".$ref_id);

}
}
}

public function skip_targeting($ref_id){
//work here
$datab2 = array(
'targeting' => "false",
'tcategory' => NULL,
'tbrowser' => NULL,
'tcountry' => NULL,
'tplatform' =>NULL,
 'cr_level' => "2"
);

$this->db->update('adv_story',$datab2, array("ref_id" => $ref_id,"user_id" => $_SESSION['id']));
}
public function insert_campaign_step_one($banner,$ref_id ,$cpa_ref_id)
{

if($this->input->post('campaign_type') == "text")
{
$campaign_title = $this->input->post('campaign_title_text');

}else{

$campaign_title = $this->input->post('campaign_title');

}



$datab = array(
"user_id" => $_SESSION['id'],
"clicks" => "0",
"views" => "0",
"name" => $this->input->post('cpa_name')."-".$this->input->post('campaign_name'),
"size" => $this->input->post('campaign_size'),
"type" => $this->input->post('campaign_type'),
"category" => $this->input->post('category'),
"disp_link" => $this->input->post('display_link'),
"dest_link" => $this->input->post('destination_link'),
"text_content" => $this->input->post('campaign_content_text'),
"text_title" => $campaign_title,
"img_link" => $banner,
"ref_id" => $ref_id,
"cpa_id" => $cpa_ref_id,
"edit_status" => "incomplete",
"status" => "incomplete",
"spent" => "0.00",
"approval" => "false",
"cr_level" => "1",
"time" => time()
);

$this->db->insert("adv_story",$datab);
}

public function get_advertiser_campaigns($offset,$limit)
{

    $this->db->order_by("id","DESC");

$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id']),$limit,$offset);
return $query->result_array();


}
public function get_cpa_form_by_ref_id($ref_id)
{
  $query= $this->db->get_where('cpa_forms',array('ref_id' => $ref_id));
  return $query->row_array();
}

public function count_advertisers_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id']));
return count($query->result_array());


}
public function get_country_details($country)
{
  $query = $this->db->get_where('countries',array('select_value'=> $country));
  return $query->row_array();
}

public function get_general_details()
{
  $query = $this->db->get_where('countries',array('select_value'=> 'general'));
  return $query->row_array();
}
public function count_advertisers_cpa()
{

$query = $this->db->get_where("cpa_forms",array('advertisers_id' => $_SESSION['id']));

return count($query->result_array());


}
public function count_advertisers_cpas()
{

$query = $this->db->get_where("cpa_forms",array('advertisers_id' => $_SESSION['id']));

return $query->result_array();


}

public function get_currency_det_by_shortcode($shortcode)
{

$query = $this->db->get_where('countries',array('currency_code'=> $shortcode));
return $query->row_array();

}
public function get_advertisers_cpa($type,$offset,$limit)
{

    $this->db->order_by("id","DESC");
$query = $this->db->get_where($type,array('advertisers_id' => $_SESSION['id']),$limit,$offset);
return $query->result_array();

}


public function count_advertiser_pending_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id'],'status' => 'pending'));
return count($query->result_array());


}



public function get_campaign_at_all_time_views($ref_id)
{

  $query = $this->db->get_where('views',array("story_id" => $ref_id));
 return count($query->result_array());

}

public function get_campaign_at_all_time_clicks($ref_id)
{

  $query = $this->db->get_where('clicks',array("story_id" => $ref_id));
 return count($query->result_array());

}

public function count_advertiser_blocked_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id'],'approval' => 'disapproved'));
return count($query->result_array());


}

public function count_advertiser_active_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id'],'status' => 'active'));
return count($query->result_array());


}

public function count_advertiser_inactive_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id'],'approval' => 'inactive'));
return count($query->result_array());


}
public function get_campaign_ref_id($ref_id)
{
$query = $this->db->get_where("adv_story",array('ref_id' => $ref_id));
return $query->row_array();

}

/*keep
 $query = $this->db->query('SELECT * FROM admin_earning WHERE time >= '.(time()-$time).' AND story_id = '.$ref_id.' AND story_aid = '.$_SESSION['id'].' ;');


*/

public function get_campaign_at_time_views($ref_id,$today,$time_interval)
{

   $time_interval  = $time_interval * 60 * 60;

    $query = $this->db->query('SELECT * FROM views WHERE time >= '.($today - $time_interval).' AND time <= '.$today.' AND story_id = "'.$ref_id.'";');

 return count($query->result_array());

}

public function get_campaign_at_time_clicks($ref_id,$today,$time_interval)
{
$time_interval  = $time_interval * 60 * 60;
  $query = $this->db->query('SELECT * FROM clicks WHERE time >= '.($today - $time_interval).' AND time <= '.$today.' AND story_id = "'.$ref_id.'";');

 return count($query->result_array());

}
public function get_campaign_views($ref_id,$today)
{

    $query = $this->db->query('SELECT * FROM views WHERE time >= '.$today.' AND story_id = "'.$ref_id.'" AND story_aid = '.$_SESSION["id"].' ;');

 return count($query->result_array());

}

public function get_campaign_clicks($ref_id,$today)
{

    $query = $this->db->query('SELECT * FROM clicks WHERE time >= '.$today.' AND story_id = "'.$ref_id.'" AND story_aid = '.$_SESSION['id'].' ;');

 return count($query->result_array());

}
public function fund_campaign($ref_id,$user,$campaign)
{




if(($user['account_bal'] < $this->input->post('amount'))){
//to handle case budget <5
$_SESSION['action_status_report'] ="<span class='w3-text-red'>Insufficient Balance:your balance is ".$user['account_bal']."</span>" ;
$this->session->mark_as_flash('action_status_report');

  show_page('advertiser_dashboard/view_details/'.$ref_id);
}elseif ($this->input->post('amount') < 1) {
//to handle case negtive input
$_SESSION['action_status_report'] ="<span class='w3-text-red'>Insufficient input :your balance is ".$user['account_bal']."</span>" ;
$this->session->mark_as_flash('action_status_report');

  show_page('advertiser_dashboard/view_details/'.$ref_id);}else
{
$new_acct_bal = $user['account_bal'] - $this->input->post('amount');

$databu = array('account_bal' => $new_acct_bal);
 $new_campaign_bal = $campaign['balance'] + $this->input->post('amount');
$datab2 = array(
"edit_status" => "funded",
'balance' =>  $new_campaign_bal,
'budget' => $campaign['budget'] + $this->input->post('amount'),
'time' => time()
);

if( $this->db->update('adv_story',$datab2, array("ref_id" => $ref_id,"user_id" => $_SESSION['id'])) && $this->db->update('advertisers',$databu, array("id" => $_SESSION['id'])))
{
$_SESSION['action_status_report'] ="Campaign funded successfully" ;
$this->session->mark_as_flash('action_status_report');
  show_page('advertiser_dashboard/view_details/'.$ref_id);

  //yes
}else{
$_SESSION['action_status_report'] ="unnown error occured" ;
$this->session->mark_as_flash('action_status_report');
show_page("advertiser_dashboard/campaign_budget/".$ref_id);

}
}

}

}
