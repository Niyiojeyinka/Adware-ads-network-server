
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***
 * Name:      AdNetwork
 * Package:     Page.php
 * About:        A controller that handles blogging operation
 * Copyright:  (C) 2017,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/





class Blog extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(['blog_model','advertiser_model']);
     $this->load->helper(array('url','form','blog_helper'));
         $this->load->library(array('form_validation','user_agent'));

           $this->siteName = $this->advertiser_model->get_system_variable("site_name");
      $this->author = $this->advertiser_model->get_system_variable("author");
      $this->keywords = $this->advertiser_model->get_system_variable("keywords");
      $this->description= $this->advertiser_model->get_system_variable("description");
      $this->noindex = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
      $this->user =  $this->advertiser_model->get_advertiser_by_id();

}

	public function index($offset = 0)
	{
$limit = 6;
    $data['items'] = $this->blog_model->get_posts_pag($offset,$limit);

	
	$this->load->library('pagination');

	$config['base_url'] = site_url("blog/index");



$config['total_rows'] = $this->blog_model->count_results();
//  $config['total_rows'] = 10;
	$config['per_page'] = $limit;

//$config['uri_segment'] = 3;
$config['first_tag_open'] = '<span class="w3-button w3-indigo w3-text-white">';
$config['first_tag_close'] = '</span>';
$config['last_tag_open'] = '<span class="w3-button w3-indigo w3-text-white">';
$config['last_tag_open'] = '</span>';
$config['first_link'] = 'First';



$config['prev_link'] = 'Previous';
$config['next_link'] = 'Read More';
$config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-indigo w3-text-white">';
$config['next_tag_close'] = '</span><br>';
$config['prev_tag_open'] = '<span style="" class="w3-btn w3-indigo w3-text-white">';
$config['prev_tag_close'] = '</span>';
$config['last_link'] = 'Last';
$config['display_pages'] = false;

	   $this->pagination->initialize($config);
$data['pagination'] = $this->pagination->create_links();



	    $data['title'] = $this->siteName." | Official Blog";
      $data['author'] =  $this->author;
      $data['keywords'] =  $this->keywords;
      $data['description'] =  $this->description;
    $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/bloglist_view',$data);
    $this->load->view('common/footer_view');	
		
	}





public function view($slug = NULL)
{
        $data['item'] = $this->blog_model->get_posts($slug);
$statu = $data['item']['status'];
        if (empty($data['item']) || $statu == "draft")
        {
                show_404();
        }
        $data['title'] =  "AdNetwork's Official Blog | ".$data['item']['title'];
      $data['author'] = "Olaniyi Ojeyinka";
$data['items'] = $this->blog_model->get_posts_pag(0,7);
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform for africa.";

  
    $this->load->view('/common/header_view',$data);
$this->load->view('/common/blog_header_view',$data);
 $this->load->view('public/blog_view',$data);
      //$this->load->view('common/blog_sidebar_view',$data);
    $this->load->view('common/footer_view');  

}

}
