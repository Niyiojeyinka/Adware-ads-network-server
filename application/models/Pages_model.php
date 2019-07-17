<?php

class Pages_model extends CI_Model {


/***
 * Name:     Custch
 * Package:    Pages_model.php
 * About:        A model class that handle gettew's blogging model operation
 * Copyright:  (C) 2017,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();

}

public function get_pages($slug)
{
    
    
$query = $this->db->get_where('pages',array("slug" => $slug));
  return $query->row_array();


    
    
}



public function get_page_id($id)
{


$query = $this->db->get_where('pages',array("id" => $id));
  return $query->row_array();


}


public function get_pages_id($id)
{
    
    
$query = $this->db->get_where('pages',array("id" => $id));
  return $query->row_array();

 
}
public function get_how_it_works()
{
	$query= $this->db->get_where('pages',array('slug'=> 'How_it_Works'));
	return $query->row_array()['text'];
}

public function get_terms()
{
	$query= $this->db->get_where('pages',array('slug'=> 'terms'));
	return $query->row_array()['text'];
}

public function get_pagelist($offset,$limit)
{
 
 $res = $this->db->get("pages",$limit,$offset);
$result = $res->result_array();
return $result;
    
 }



public function get_pages_draft($offset,$limit)
{
$query = $this->db->get_where('pages',array("status" => "draft"),$limit,$offset);
  return $query->result_array();

    
    
    
    
    
}




public function edit_page($idkey)
{

//edit means to update



 $page = array(

'title' => $this->input->post('title'),
'keywords' => $this->input->post('keywords'),
'description' => $this->input->post('desc'),
'text' => $this->input->post('contents')
);


 if($this->db->update("pages",$page,array("id" => $idkey)))
 {

return true;

}
return false;
}




public function insert_click($account_type)
{

 $datab = array(
 
'referral_id' => $_SESSION['referral_id'],
'account_type' => $account_type,
'time' => time()
);
 $this->db->insert('affilate_clicks',$datab);
}


public function insert_contact()
{


 $contact = array(
 
'name' => $this->input->post('name'),
'title' => $this->input->post('title'),
'email' => $this->input->post('email'),
'phone' => $this->input->post('phone'),
'message' => $this->input->post('message'),
'status' => 'unread',
'solved' => 'no',
'time' => time()
);



 if( $this->db->insert('cmessages',$contact))
 {


return true;

}else {
return false;
}




}



}