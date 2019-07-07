<?php

class Publisher_model extends CI_Model {


/***
 * Name:       Custch
 * Package:    publisher_model.php
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


//new
public function get_publisher_by_id()
{


    $query = $this->db->get_where('publishers',array("id" => $_SESSION["id"]));
  return $query->row_array();
}

public function get_publishers()
{

  $query = $this->db->get('publishers');
  return $query->result_array();
}


//new
public function get_publisher_by_its_id($id)
{


    $query = $this->db->get_where('publishers',array("id" => $id));
  return $query->row_array();
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

//new
public function get_space($ref_id)
{
    $query = $this->db->get_where('pub_story',array("ref_id" =>$ref_id));
  return $query->row_array();
}

public function get_naira_xrate()
{

  $query = $this->db->get_where("system_var",array("variable_name" => "naira_rate"));
  return $query->row_array()['variable_value'];
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

   if ($this->db->update("publishers",$dab,array("id" => $_SESSION["id"])))
   {


    return true;

   }
    return false;


}

public function insert_new_balance($publisher_new_balance,$publisher_id)
{

$this->db->update("publishers", array("account_bal" => $publisher_new_balance), array("id" => $publisher_id));
}
//New
public function insert_new_email()
{

$dab = array(

"email" => $this->input->post("new_email")

)  ;

   if ($this->db->update("publishers",$dab,array("id" => $_SESSION["id"])))
   {
 return true;

   }
    return false;


}
public function insert_space($ref_id){

  $ch = array('a','A','B','b','C','c','D','d','E','e');
    $div_id =   $ch[mt_rand(0,9)].''.$ch[mt_rand(0,9)].''.mt_rand(0,10);
  if($this->input->post('type') == 'text')
  {
    
    $code = '<script src="'.site_url('campaign_delivery/deliver_text_js/'.$ref_id).'"></script>
<center><div class="w3-margin" id="'.$div_id.'" style="max-width: 70%;" class="">
</div></center>
';
}elseif($this->input->post('type') == 'banner'){
  if(in_array($this->input->post('size'),array('250X250','300X250'))){
$size_to_get = 'box';
  }elseif(in_array($this->input->post('size'),array('720X90','468X60'))){
$size_to_get = 'rec';
  }else{
    $size_to_get = 'sta';

  }


  $code = '<script src="'.site_url('campaign_delivery/deliver_banner_js/'.$ref_id).'/'.$size_to_get.'"></script>
<center><div  class="w3-margin"  id="'.$div_id.'">
</div></center>';

}elseif($this->input->post('type') == "recommendation")
{
 $code = '<script src="'.site_url('campaign_delivery/deliver_recommendation_js/'.$ref_id.'/'.$this->input->post('no_post')).'"></script>
<div  class="w3-margin"  style="" id="'.$div_id.'">
</div>';

}
/*elseif($this->input->post('type') == "banner_text")
{
 $code = '
<link rel="stylesheet"  href="'.base_url('assets/cj/w3.css').'">
<script src="'.base_url('assets/js/jquery.js').'"></script>
<script src="'.site_url('campaign_delivery/deliver_article_style_js/'.$ref_id).'"></script>
<center><div  class="w3-margin"  style="max-width: 500px;" id="'.$div_id.'">
</div></center>';

}*/

$datab = array(
'name' => $this->input->post("space_name"),
'category' => json_encode($this->input->post("category")),
'website' => $this->input->post("website_url"),
'type' => $this->input->post("type"),
'size' => $this->input->post("size"),
'ref_id' => $ref_id,
'user_id' => $_SESSION['id'],
'clicks' => 0,
'div_id' => $div_id,
'code' => $code,
'views' => 0,
"status" => "active",
'time' => time()
);

$this->db->insert('pub_story',$datab);

}

public function update_payment_details()
{

if($_POST['payment_type'] == "bank")
{

$datab = array(
"bank_name" => $_POST['bank_name'],
"bank_acct" => $_POST['account_number'],
"bank_det" => $_POST['account_name'], 
"bank_no" => $_POST['swift_code'], 
"payment_type" =>  $_POST['payment_type']
);


}elseif($_POST['payment_type'] == "paypal")
{

$datab = array(
"bank_acct" => $_POST['paypal_email'],
"payment_type" =>  $_POST['payment_type']
);

  
}elseif($_POST['payment_type'] == "western_union")
{
$datab = array(
"bank_acct" => $_POST['address'],
"payment_type" =>  $_POST['payment_type']
);
}

$this->db->update("publishers",$datab,array('id' => $_SESSION['id']));
}

public function spaces($offset,$limit)
{

    $this->db->order_by("id","DESC");

$query = $this->db->get_where("pub_story",array('user_id' => $_SESSION['id']),$limit,$offset);
return $query->result_array();


}

public function count_advertisers_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id']));
return count($query->result_array());


}


public function get_space_by_id($ref_id)
{


$query = $this->db->get_where("pub_story",array('ref_id' =>$ref_id));
return $query->row_array();


}

public function count_publishers_spaces()
{


$query = $this->db->get_where("pub_story",array('user_id' => $_SESSION['id']));
return count($query->result_array());


}


public function count_publisher_pending_spaces()
{


$query = $this->db->get_where("pub_story",array('user_id' => $_SESSION['id'],'status' => 'pending'));
return count($query->result_array());


}


public function count_publisher_blocked_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id'],'approval' => 'unapproved'));
return count($query->result_array());


}

public function count_publisher_active_campaigns()
{


$query = $this->db->get_where("adv_story",array('user_id' => $_SESSION['id'],'status' => 'active'));
return count($query->result_array());


}

public function count_publisher_inactive_campaigns()
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

    $query = $this->db->query('SELECT * FROM views WHERE time >= '.($today - $time_interval).' AND time <= '.$today.' AND space_id = "'.$ref_id.'";');

 return count($query->result_array());

}

public function get_campaign_at_all_time_views($ref_id)
{

  $query = $this->db->get_where('views',array("space_id" => $ref_id));
 return count($query->result_array());

}

public function get_campaign_at_all_time_clicks($ref_id)
{

  $query = $this->db->get_where('clicks',array("space_id" => $ref_id));
 return count($query->result_array());

}

public function get_campaign_at_time_clicks($ref_id,$today,$time_interval)
{
$time_interval  = $time_interval * 60 * 60;
  $query = $this->db->query('SELECT * FROM clicks WHERE time >= '.($today - $time_interval).' AND time <= '.$today.' AND space_id = "'.$ref_id.'";');

 return count($query->result_array());

}
public function get_campaign_views($ref_id,$today)
{

   

    $query = $this->db->query('SELECT * FROM views WHERE time >= '.$today.' AND space_id = "'.$ref_id.'";');

 return count($query->result_array());

}

public function get_campaign_clicks($ref_id,$today)
{

    $query = $this->db->query('SELECT * FROM clicks WHERE time >= '.$today.' AND space_id = "'.$ref_id.'";');

 return count($query->result_array());

}
}
