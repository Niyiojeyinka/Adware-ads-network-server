<?php

class Media_model extends CI_Model {


/***
 * Name:      Plugpress
 * Package:    Team_model.php
 * About:        A model class that handle plugpress Team  model operation
 * Copyright:  (C) 2017,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();

}








public function save_image()
{
   $_time =  date('d-m-y')." ".date('g:i:sA');





     $datab2 = array(
'type' => 'image',
'link' => $this->upload->data("file_name"),
'time' => time()
);







  $this->db->insert('media',$datab2);



 return true;





}



public function get_media_img($offset,$limit)
{
/*if( $offset > 0)
{

$offset = ($offset-1) * $limit;


}*/


    $this->db->order_by("id","DESC");


$res = $this->db->get("media",$limit,$offset);
$result = $res->result_array();
return $result;
}





}
