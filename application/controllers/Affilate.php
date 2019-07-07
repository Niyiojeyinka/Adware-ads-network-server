<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***
 * Name:      Custch
 * Package:     Affilate.php
 * About:        A controller that handles advertiser operation
 * Copyright:  (C) 2018,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/





class Affilate extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(array('blog_model','pages_model','advertiser_model'));
         $this->load->library(array('session','form_validation','user_agent'));
     $this->load->helper(array('url','form','page_helper','blog_helper'));
    // session_start();
    /* if($_SESSION["accounttype"] != "Advertiser")
      {
        show_page('page/logout');
      }
*/
}
public function index()
{


      $data['title'] = "Custch | Advertiser Dashboard";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";
      $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
$data['user'] = $this->advertiser_model->get_advertiser_by_id();

		$this->load->view('/common/header_view',$data);
$this->load->view('/common/other_header_plate_view',$data);
						$this->load->view('public/affilate_index_view',$data);
		$this->load->view('common/footer_view');
	}

public function pub($id = NULL)
{
$_SESSION["expected"] = "Publisher";
echo $_SESSION["referral_id"] = str_replace("656dj", "", $id);
$this->pages_model->insert_click("publisher");
show_page('register');

}


public function adv($id = NULL)
{


$_SESSION["expected"] = "Advertiser";
echo $_SESSION["referral_id"] = str_replace("656dj", "", $id);
$this->pages_model->insert_click("advertiser");

show_page('register');

}

}