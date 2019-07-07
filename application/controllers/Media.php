<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

public function __construct()
{
     parent::__construct();
     $this->load->model(array('user_model','blog_model','media_model'));
     $this->load->helper(array('url','form','blog_helper','time_helper','page_helper'));
     $this->load->library(array('form_validation','session'));
     session_start();
     if ((!isset($this->session->admin_name)) ||(!isset($this->session->admin_logged_in)))
 {


    header('Location: '.site_url('ch_admin'));



 }
}



	public function index($offset = 0)
	{


	//	$err = $this->uri->segment(3, 0);
	$limit = 4;
		$this->load->library('pagination');




      $data['items'] = $this->media_model->get_media_img($offset,$limit);




	$config['base_url'] = site_url("media/index");



//$config['total_rows'] = count($this->pages_model->get_pagelist(null,null));

$config['total_rows'] = $this->db->count_all('media');

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







			//check login for admin here later

		$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/media_view',$data);
		$this->load->view('admin/footer_view');





	}




	public function upload_image()
	{

 

	$config['upload_path'] = './assets/media/images';
   $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = '1024';
   /* $config['max_width'] = '1024';
     $config['max_height'] = '768';*/

 $this->load->library('upload', $config);

	 if ( ! $this->upload->do_upload('userfile'))
{
 $error = array('error' => $this->upload->display_errors());

			//check login for admin here later
			$data['title'] = "Upload Image to media";
//			$data[''] = "";

		$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/add_image_view',$error);
		$this->load->view('admin/footer_view');


 }
 else
 {
   $this->media_model->save_image();

 $msg_show ="<span class='w3-text-green'>New Image Uploaded Successfully</span>";
 $data = array('upload_data' => $this->upload->data(),'err_reports' => $msg_show);


 	$data['title'] = "Upload Image to media";
			$data['image'] = base_url("assets/media/images/".$this->upload->data("file_name"));


			//check login for admin here later


		$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/add_image_view',$data);
		$this->load->view('admin/footer_view');







 }

	}

	public function add_image()
	{




			//check login for admin here later

		$this->load->view('/admin/header_view',$data);

		$this->load->view('admin/sidebar_view',$data);

						$this->load->view('admin/add_image_view',$data);
		$this->load->view('admin/footer_view');






	}





}
