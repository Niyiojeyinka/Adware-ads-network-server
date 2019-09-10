<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_blog extends CI_Controller {

public function __construct()
{
     parent::__construct();

     $this->load->model(array('pages_model','admin_blog_model','admin_model','user_model',
     'blog_model','advertiser_model'));
     $this->load->helper(array('url','form_helper','blog_helper','page_helper'));
     $this->load->library(array('form_validation','session'));

  if (!isset($this->session->admin_name) || !isset($this->session->admin_logged_in))
 {
       show_page("ch_admin");
 }

  $this->siteName = $this->advertiser_model->get_system_variable("site_name");
   $this->author = $this->advertiser_model->get_system_variable("author");
   $this->keywords = $this->advertiser_model->get_system_variable("keywords");
   $this->description= $this->advertiser_model->get_system_variable("description");
   $this->noindex = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
   $this->tagLine =$this->advertiser_model->get_system_variable("tagline");



}
  public function add_post()
  {
    //check login for admin here later



     $this->form_validation->set_rules("title","Post Title","required");
     $this->form_validation->set_rules("contents","Post Contents","required");
     $this->form_validation->set_rules("keywords","Post Keywords","required");
     $this->form_validation->set_rules("desc","Post Descriptions","required");




  $config['upload_path'] = "assets/media/images";
  $config['allowed_types'] = 'gif|jpg|png|jpeg';
   $config['max_size'] = '500';

 $this->load->library('upload', $config);

if($this->upload->do_upload('fimg'))
{
$up = 1;

}
  if($this->form_validation->run() == FALSE)
  {
$data =[];
  //show error

      //check login for admin here later
  //check_admin_login();


$data['title'] ="AdNetwork | Add Post";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

    $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

      $this->load->view('admin/blog/add_post_view',$data);
    $this->load->view('admin/footer_view');




  }else{
  //show next:input to db
  if($this->admin_blog_model->insert_post('post',$this->upload->data("file_name")))
  {

  //sucesspage
    $_SESSION['action_status_report'] = "<span class='w3-text-green'>Post Added successfully
  </span>";
$this->session->mark_as_flash('action_status_report');
  show_page("admin_blog/add_post");

  }else{
  //error page
    $_SESSION['action_status_report'] = "<span class='w3-text-red'>Error Occurred
  </span>";
  $this->session->mark_as_flash('action_status_report');

    show_page("admin_blog/add_post");

  }
  }
 }
  public function add_page()
  {
     $this->form_validation->set_rules("title","Post Title","required");
     $this->form_validation->set_rules("contents","Post Contents","required");
     $this->form_validation->set_rules("keywords","Post Keywords","required");
     $this->form_validation->set_rules("desc","Post Descriptions","required");

  if($this->form_validation->run() == FALSE)
  {
$data =[];
  //show error


$data['title'] ="AdNetwork | Add Page";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

    $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/pages/add_page_view',$data);
    $this->load->view('admin/footer_view');




  }else{
  //show next:input to db

  $this->admin_blog_model->insert_post("pages",NULL);
  //sucesspage
  $_SESSION['err_reports'] = "<span class='w3-text-green'>Page Added successfully
  </span>";
  $this->session->mark_as_flash('err_reports');
  show_page("admin_blog/add_page");
  }


}
public function edit_page($id =NULL,$err=NULL)
	{



//get post content from db here



       $data['item'] = $this->pages_model->get_page_id($id);


        $data['title'] = $data['item']['title'];
        $data['author'] = $data['item']['author'];
        $data['content'] = $data['item']['text'];
       $data['description'] = $data['item']['description'];
        $data['keywords'] = $data['item']['keywords'];
              $idkey = $id;

              $this->form_validation->set_rules("title","Post Title","required");


if($this->form_validation->run() == FALSE){

		$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/pages/edit_page_view',$data);
		$this->load->view('admin/footer_view');

}
else{


	//show next:input to db

	if($this->pages_model->edit_page($idkey))
	{
	//sucesspage
  $_SESSION['err_reports'] = "<span class='w3-text-green'>Page Edited successfully
  </span>";
  $this->session->mark_as_flash('err_reports');

	show_page("admin_blog/edit_page/".$idkey);

	}else{
	//error page

  $_SESSION['err_reports'] = "<span class='w3-text-green'>Unknown error occurred</span>";
  $this->session->mark_as_flash('err_reports');

		show_page("admin_blog/edit_page/".$idkey);

	}

}

	}

  public function edit_post($id =NULL,$err=NULL)
  {


//get post content from db here


        $data['item'] = $this->blog_model->get_post_id($id);

        $data['title'] = $data['item']['title'];
        $data['author'] = $data['item']['author'];
        $data['time'] = $data['item']['time'];
        $data['img_url'] = $data['item']['img_url'];
        $data['contents'] = $data['item']['text'];
       $data['description'] = $data['item']['description'];
        $data['keywords'] = $data['item']['keywords'];
        $idkey = $id;


        $this->form_validation->set_rules("title","Post Title","required");
  $config['upload_path'] = "assets/media/images";
  $config['allowed_types'] = 'gif|jpg|png|jpeg';
   $config['max_size'] = '500';

 $this->load->library('upload', $config);

if($this->upload->do_upload('fimg'))
{
$up = 1;

}


if($this->form_validation->run() == FALSE){

    $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/blog/edit_post_view',$data);
    $this->load->view('admin/footer_view');

}
else{

if(!empty($this->upload->data("file_name")))
{
$img_url = $this->upload->data("file_name");


}else{


  $img_url = $data['img_url'];
}




  if($this->admin_blog_model->edit_post($idkey,$img_url))
  {
  //sucesspage
    //sucesspage
  $_SESSION['err_reports'] = "<span class='w3-text-green'>Page Edited successfully
  </span>";
  $this->session->mark_as_flash('err_reports');


  show_page("admin_blog/edit_post/".$idkey);

  }else{
  //error page
    //sucesspage
  $_SESSION['err_reports'] = "<span class='w3-text-red'>An Error occurred
  </span>";
  $this->session->mark_as_flash('err_reports');


    show_page("admin_blog/edit_post/".$idkey);

  }

}



  }
  public function articles($offset=0)
  {

  //  $err = $this->uri->segment(3, 0);
  $limit = 6;
    $this->load->library('pagination');
     $data['items'] = $this->blog_model->get_articles($offset,$limit);
  $config['base_url'] = site_url("admin_blog/articles");

$config['total_rows'] = count( $this->blog_model->get_articles(null,null));

  $config['per_page'] = $limit;

 //$config['uri_segment'] = 4;
$config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
$config['first_tag_close'] = '</span>';
$config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
$config['last_tag_close'] = '</span>';
$config['first_link'] = 'First';
$config['prev_link'] = 'Prev';
$config['next_link'] = 'Next';
$config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
$config['next_tag_close'] = '</span><br>';
$config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
$config['prev_tag_close'] = '</span>';
$config['last_link'] = 'Last';
$config['display_pages'] = false;

     $this->pagination->initialize($config);
$data['pagination'] = $this->pagination->create_links();


    $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

            $this->load->view('admin/articles_view',$data);
    $this->load->view('admin/footer_view');
  }

	public function pages($err="no",$offset=0)
	{

 	//	$err = $this->uri->segment(3, 0);
	$limit = 4;
		$this->load->library('pagination');
     $data['items'] = $this->pages_model->get_pagelist($offset,$limit);
	$config['base_url'] = site_url("admin_blog/pages/no");

$config['total_rows'] = count($this->pages_model->get_pagelist(null,null));
//$config['total_rows'] = $this->db->count_all('pages');

	$config['per_page'] = $limit;

 //$config['uri_segment'] = 4;
$config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
$config['first_tag_close'] = '</span>';
$config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
$config['last_tag_close'] = '</span>';
$config['first_link'] = 'First';
$config['prev_link'] = 'Prev';
$config['next_link'] = 'Next';
$config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
$config['next_tag_close'] = '</span><br>';
$config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
$config['prev_tag_close'] = '</span>';
$config['last_link'] = 'Last';
$config['display_pages'] = false;

	   $this->pagination->initialize($config);
$data['pagination'] = $this->pagination->create_links();



$data['title'] ="AdNetwork | Pages";
$data['description'] ="Admin Dashboard";

$data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

		$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/pages/pagelist_view',$data);
		$this->load->view('admin/footer_view');
	}



  public function posts($offset=0)
  {

  $limit = 4;
    $this->load->library('pagination');
      $data['items'] = $this->blog_model->get_postlist($offset,$limit);

  $config['base_url'] = site_url("admin_blog/posts");
 $config['total_rows'] = count($this->blog_model->get_postlist(null,null));
//$config['total_rows'] = $this->db->count_all('pages');

  $config['per_page'] = $limit;

 //$config['uri_segment'] = 4;
$config['first_tag_open'] = '<span class="w3-btn w3-blue w3-text-white">';
$config['first_tag_close'] = '</span>';
$config['last_tag_open'] = '<br><span class="w3-btn w3-blue w3-text-white">';
$config['last_tag_close'] = '</span>';
$config['first_link'] = 'First';
$config['prev_link'] = 'Prev';
$config['next_link'] = 'Next';
$config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-blue w3-text-white">';
$config['next_tag_close'] = '</span><br>';
$config['prev_tag_open'] = '<span style="" class="w3-btn w3-blue w3-text-white">';
$config['prev_tag_close'] = '</span>';
$config['last_link'] = 'Last';
$config['display_pages'] = false;

     $this->pagination->initialize($config);
$data['pagination'] = $this->pagination->create_links();


    $this->load->view('/admin/header_view',$data);

    $this->load->view('admin/sidebar_view',$data);

    $this->load->view('admin/blog/postlist_view',$data);
    $this->load->view('admin/footer_view');
  }



	public function delete_page($id)
	{

	$this->admin_blog_model->delete_item('page',$id);

    $_SESSION['err_reports'] = "<span class='w3-text-green'>Page Deleted successfully
      </span>";
      $this->session->mark_as_flash('err_reports');

	show_page("admin_blog/pages");
	}


	public function move($id=NULL,$type=NULL)
	{
   $data['item'] = $this->blog_model->get_post_id($id);
 $status = $data['item']['status'];

	$type = "page";
	$this->blog_model->move_item($id,$status);

      $_SESSION['err_reports'] = "<span class='w3-text-green'>Page Moved successfully
        </span>";
        $this->session->mark_as_flash('err_reports');

show_page('admin_blog/posts');

	}


  public function article_action($id=NULL)
  {
  $data['item'] = $this->blog_model->get_post_id($id);
   $user = $this->user_model->get_user_by_its_id($data['item']['author_id']);
 $status = $data['item']['status'];

  $this->blog_model->articles_action($id,$status,$user);

      $_SESSION['action_status_report'] = "<span class='w3-text-green'> Action Done successfully
        </span>";
        $this->session->mark_as_flash('action_status_report');

show_page('admin_blog/articles');
  }


	public function draft($err= null)
	{


//pagination for post start here
//get post content from db here


      $data['items'] = $this->blog_model->get_posts_draft(null,null);

		$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/blog/draft_view',$data);
		$this->load->view('admin/footer_view');
	}

  public function delete_post($id=NULL)
  {
  if($this->admin_model->delete_item('post',$id))
  {

 $_SESSION['action_status_report'] = "<span class='w3-text-green'>Post Deleted
       successfully from Frontpage
        </span>";
        $this->session->mark_as_flash('action_status_report');

  show_page("admin_blog/posts/");


  }else{

$_SESSION['action_status_report'] = "<span class='w3-text-red'>Post Deleted
       successfully from Frontpage
        </span>";
        $this->session->mark_as_flash('action_status_report');

  show_page("admin_blog/posts/");



  }





  }







	}
