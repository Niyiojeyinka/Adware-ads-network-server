<?php

class Blog_model extends CI_Model {


/***
 * Name:        CUSTCH model
 * Package:    blog_model.php
 * About:        A model class that handle cUSTCH blogging model operation
 * Copyright:  (C) 2018,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();

}

public function get_posts($slug)
{ if ( $slug != FALSE && $slug != NULL)
    {


$query = $this->db->get_where('blog',array("slug" => $slug));
  return $query->row_array();
}




    else
    {


    $this->db->order_by("id","DESC");


    $query = $this->db->get('blog',8,0);
  return $query->result_array();




    }

}

public function get_post_id($id)
{ if ( $id != FALSE && $id != NULL)
    {


$query = $this->db->get_where('blog',array("id" => $id));
  return $query->row_array();
}




    else
    {

    $this->db->order_by("id","DESC");


    $query = $this->db->get('blog');
  return $query->result_array();




    }

}





public function get_posts_draft($offset,$limit)
{


    $this->db->order_by("id","DESC");


$query = $this->db->get_where('blog',array("status" => "draft"),$limit,$offset);
  return $query->result_array();






}

public function get_posts_pag($offset,$limit)
{
/*if( $offset > 0)
{

$offset = ($offset-1) * $limit;


}*/

    $this->db->order_by("id","DESC");


$res = $this->db->get_where("blog",array("status" => "published"),$limit,$offset);
$result = $res->result_array();
return $result;
}

public function count_results()
{

$res2 = $this->db->get_where("blog",array("status" => "published"));
$result2 = count($res2->result_array());
return $result2;



}


public function get_postlist($offset,$limit)
{

    $this->db->order_by("id","DESC");
$res = $this->db->get_where("blog", array('status' => "published" ),$limit,$offset);
return $res->result_array();
}



public function get_posts_admin($offset,$limit)
{
/*if( $offset > 0)
{

$offset = ($offset-1) * $limit;


}*/

    $this->db->order_by("id","DESC");


$res = $this->db->get("blog",$limit,$offset);
$result = $res->result_array();
return $result;
}

public function get_common($position)
{
//position option :pre_content,post_content,mid_content


$query = $this->db->get_where('common_tab',array("position" => $position));
  return $query->result_array();

}

public function delete_common($id)
{
//position option :pre_content,post_content,mid_content


$query = $this->db->delete('common_tab',array("id" => $id));

 return true;
}



public function get_commons()
{

   // $this->db->order_by("id","DESC");


$res = $this->db->get("common_tab");
$result = $res->result_array();
return $result;
}

public function edit_common($id)
{

$temp = array(

'content' => $this->input->post('content'),
'position' => $this->input->post('position'),
'short_det' => $this->input->post('name')



);

$this->db->update("common_tab",$temp,array('id' => $id));

return true;
}


public function insert_common()
{

$cmm = array(

'content' => $this->input->post('content'),
'position' => $this->input->post('position'),
'short_det' => $this->input->post('name')



);

if( $this->db->insert('common_tab',$cmm))
{


return true;

}
return false;





}




public function get_common_id($id)
{


$query = $this->db->get_where('common_tab',array("id" => $id));
  return $query->row_array();


}







}
