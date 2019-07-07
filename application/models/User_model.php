<?php

class User_model extends CI_Model {


/***
 * Name:     Custch
 * Package:    User_model.php
 * About:        A model class that handle plugpress user  model operation
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
public function register_advertiser()
{



     $reg = array(

'firstname' =>  $_SESSION['first_details']['firstname'],
'lastname' =>  $_SESSION['first_details']['lastname'],
'password' =>  md5(md5($_SESSION['first_details']['password'])),
'phone' => $_SESSION['first_details']['phone'],
'email' => $_SESSION['first_details']['email'],
"account_status" => "active",
"country" => $this->input->post("country"),
"websites" => json_encode(array($this->input->post('website'))),
"total_spent" => "0.00",
"account_bal" => "0.00",
"referral_id" => $_SESSION["referral_id"],
'time' => time()

);

$this->db->insert('advertisers',$reg);



 return true;






}
//new
public function select_with_password($pass)
{

  $query = $this->db->get_where(strtolower($_SESSION['reg_account_type']).'s',array('password' => $pass));
  return $query->row_array();
}

//new
public function insert_new_password_forg($account_type,$id)
{
$dab = array(

"password" => md5(md5($this->input->post("npass")))
)  ;

if ($this->db->update($account_type."s",$dab,array("id" => $id)))
   {
    return true;
   }
    return false;
}

public function get_user_by_vcode($code,$account_type)
{

$query = $this->db->get_where($account_type.'s',array('email_vc' => $code));
return $query->row_array();
}


//new
public function register_publisher()
{



       $reg = array(

'firstname' =>  $_SESSION['first_details']['firstname'],
'lastname' =>  $_SESSION['first_details']['lastname'],
'password' =>  md5(md5($_SESSION['first_details']['password'])),
'phone' => $_SESSION['first_details']['phone'],
'email' => $_SESSION['first_details']['email'],
"account_status" => "pending",
"country" => $this->input->post("country"),
"total_earned" => "0.00",
"pending_bal" => "0.00",
"account_bal" => "0.00",
"referral_id" => $_SESSION["referral_id"],
"websites" => json_encode(array($this->input->post('website'))),
 'time' => time()

);

$this->db->insert('publishers',$reg);



 return true;






}
//new
public function login_check()
{

$query = $this->db->get_where(strtolower($this->input->post('accounttype').'s'),array("email" => $this->input->post("email"),"password" => md5(md5($this->input->post('password')))))->row_array();

if(!empty($query))
{
$datab  = array('lastlog' => time() );
$this->db->update(strtolower($this->input->post('accounttype').'s'),$datab,array('email' => $this->input->post("email")));
  return true;
}else
   {
   return false;
   }


}


//new
public function get_user_id_by_email($email,$acct_type)
{

if(strtolower($acct_type) == "advertiser")
{
 $query = $this->db->get_where("advertisers",array("email" => $email));
}elseif(strtolower($acct_type) == "publisher")
{
    $query = $this->db->get_where("publishers",array("email" => $email));

}
  return $query->row_array()['id'];

}

//new
public function get_user_by_id()
{


    $query = $this->db->get_where('users',array("id" => $_SESSION["id"]));
  return $query->row_array();




}

public function insert_login_time($user_table)
{
  $this->db->update(strtolower($user_table)."s",array('lastlog' => time()),array('id' => $_SESSION['id']));
}

public function get_no_spaces()
{
$query = $this->db->get("pub_story");
return $query->result_array();
}

public function get_no_campaigns()
{
$query = $this->db->get("adv_story");
return $query->result_array();
}
public function count_publishers_online_at_time($time)
{


    $query = $this->db->query('SELECT * FROM publishers WHERE lastlog >= '.(time()-$time).';');
  return $query->result_array();
}

public function get_publishers($offset,$limit)
{
    $this->db->order_by("lastlog","DESC");
    $query = $this->db->get('publishers',$limit,$offset);
  return $query->result_array();
}
public function get_pending_publishers($offset,$limit)
{
    $this->db->order_by("lastlog","DESC");
    $query = $this->db->get_where('publishers',array("account_status" => "pending"),$limit,$offset);
  return $query->result_array();
}
public function get_advertisers($offset,$limit)
{
  $this->db->order_by("lastlog","DESC");
    $query = $this->db->get('advertisers',$limit,$offset);
  return $query->result_array();
}


public function get_payment_items($offset,$limit)
{
$query = $this->db->get('payments',$limit,$offset);

return $query->result_array();
}

//new
public function get_user_by_its_id($id,$table_name)
{
   $query = $this->db->get_where($table_name,array("id" => $id));
  return $query->row_array();
}
public function count_spaces_at_time($time)
{


    $query = $this->db->query('SELECT * FROM pub_story WHERE time >= '.(time()-$time).';');
  return $query->result_array();
}

public function insert_admin_noti($not)
{
   $this->db->insert('admin_earning',$not);
}
public function count_campaigns_at_time($time)
{


    $query = $this->db->query('SELECT * FROM adv_story WHERE time >= '.(time()-$time).';');
  return $query->result_array();
}

public function count_advertisers_online_at_time($time)
{


    $query = $this->db->query('SELECT * FROM advertisers WHERE lastlog >= '.(time()-$time).';');
  return $query->result_array();




}
public function count_advertisers_reg_at_time($time)
{


    $query = $this->db->query('SELECT * FROM advertisers WHERE time >= '.(time()-$time).';');
  return $query->result_array();




}


public function count_publishers_reg_at_time($time)
{


    $query = $this->db->query('SELECT * FROM publishers WHERE time >= '.(time()-$time).';');
  return $query->result_array();




}
public function set_maillist()
{


 $reg_mail = array(
 
'name' => $this->input->post('name'),
'email' => $this->input->post('email'),
'status' => "unverified"
);

$this->db->insert("newsletter",$reg_mail);
return true;

}

/*public function login_check()
{




$this->db->select('password');
$query = $this->db->get_where('users',array("email" => $this->input->post("email")));
$_pass = $this->input->post('pass');
if (in_array($_pass,$query->row_array()))
{ return true;
}
   else
   {
   return false;
   }






}*/


public function insert_vcode($account_type,$vcode,$email)
{


$datab = array(
"email_vc" => $vcode,
);
$this->db->update($account_type."s",$datab,array("email" => $email));


}


public function forg($account_type)
{

$this->db->select('email');
$query = $this->db->get_where($account_type.'s',array("email" => $this->input->post("email")));
 if(!empty($query->row_array()["email"]))
{
return $query->row_array()["email"];

}else{

return FALSE;

}


}


public function insert_to_with_req($value)
{



   $this->db->insert('withdrawal',$value);



}


public function insert_to_history($value)
{



   $this->db->insert('history',$value);



}


public function edit_user_details($dab,$id,$table_name)
{

$this->db->update($table_name,$dab,array("id" => $id));

}



}