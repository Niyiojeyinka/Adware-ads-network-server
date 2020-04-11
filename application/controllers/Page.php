<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

public function __construct()
{
     parent::__construct();


    $this->load->helper(array('url','form','blog_helper','page_helper'));
    $this->load->library(array('session','form_validation','user_agent'));
    $this->load->model(array('advertiser_model','blog_model','admin_model','pages_model','user_model'));
   

      $this->siteName = $this->advertiser_model->get_system_variable("site_name");
      $this->author = $this->advertiser_model->get_system_variable("author");
      $this->keywords = $this->advertiser_model->get_system_variable("keywords");
      $this->description= $this->advertiser_model->get_system_variable("description");
      $this->noindex = '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

    $this->tagLine =$this->advertiser_model->get_system_variable("tagline");

}


  public function index()
  {



      $data['title'] = $this->siteName." | ".$this->tagLine;
       $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;


  
    $this->load->view('public/common/header_view',$data);
    $this->load->view('public/home_view',$data);
    $this->load->view('public/common/footer_view');
 }
  
  
public function suspended_account_alert()
{

echo "<html><head><title>Account Suspended</title></head><body><script> alert('Hello,Your Account Has been suspended,This may be as a result of click fraud/invalid views/unsupported Traffics or any other offence.You can contact us at Support@AdNetwork.com if you think this is a mistake. Thank You'); 
setTimeout('redirect()',100);
function redirect()
{
  window.location.assign('".site_url('login')."');
}

 </script></body></html>";


}

public function pending_account_alert()
{



echo "<html><head><title>AdNetwork Pending Account</title></head><body><script> alert('Your Publisher Account Registration Application is currently Pending and it will be approved(less than 6hrs) after Website/Blog Quality review thank you for choosing AdNetwork AFRICA'); 
setTimeout('redirect()',100);
function redirect()
{
  window.location.assign('".site_url('login')."');
}

 </script></body></html>";


}
public function forget_password()
{


$this->form_validation->set_rules("email","Email Addresss","trim|required");

if ($this->form_validation->run() == FALSE)
{


    

      $data["title"] =$this->siteName." | Forgot Password";
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;

                 $this->load->view('common/header_view',$data);
                $this->load->view('/common/desktop_nav_view',$data);

             $this->load->view('public/forget_password_view',$data);
            $this->load->view('common/footer_view',$data);

       


}else
{


if($this->user_model->forg($this->input->post('account_type')) == FALSE)
{

//unknow data
$_SESSION['err_msg'] = 'The Email You Entered cannot be Found';
$this->session->mark_as_flash('err_msg');

show_page("page/forget_password");

}
else{

//success page
//generate code
  //insert code
  //send code
$theemail = $this->user_model->forg($this->input->post('account_type'));
  $code = substr(md5(md5(time())), 0,9);

$this->user_model->insert_vcode($this->input->post('account_type'),$code,$theemail);
$link = site_url('page/post_forg/'.$this->input->post('account_type').'/'.$code);
$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from('support@AdNetwork.com', 'System');
$this->email->to($theemail);

$this->email->subject('AdNetwork | Forgotten Password');
$this->email->message('Your Password recovery link is /n '.$link);

$this->email->send();


 $_SESSION["action_status_report"] = "<div class='w3-text-green'>Please Check Your Email For activation Link</div>";
$this->session->mark_as_flash("action_status_report");
show_page("login");



}
}}




 public function post_forg($account_type,$code)
{
//validate it
$data['code'] = $code;
$user = $this->user_model->get_user_by_vcode($code,$account_type);
  if(empty($user))
  {

//show err message

   $_SESSION['err_msg'] = '<b class="w3-text-red">Link is Invalid/ Expired Please click forgot Password to continue</b>';
    $this->session->mark_as_flash('err_msg');

    show_page('login');
  }



  
$this->form_validation->set_rules("npass","New Password","trim|required|is_unique[".$this->uri->segment(3)."s.password]",array('is_unique' => "Unfortunately,we can't accept that password please choose another password"));
    $this->form_validation->set_rules("cpass","Confirm New Password","trim|required|matches[npass]");


    if ($this->form_validation->run() ==  FALSE)
   {


  

      $data["title"] =$this->siteName." | Login";
       $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;

                 $this->load->view('common/header_view',$data);
             $this->load->view('public/change_pass_view',$data);
             $this->load->view('common/footer_view',$data);
}else{



//change password
          if( $this->user_model->insert_new_password_forg($this->uri->segment(3),$user['id']))
          {
             //show suc message
//-------------------------
//need to get things done quickly
  $datab = array(
"email_vc" => NULL
);
$this->db->update($this->uri->segment(3)."s",$datab,array('email_vc' => $code));
//-----------------------------

            $_SESSION['err_msg'] = '<b class="w3-text-blue">Password changed successfully</b><br>';
              $this->session->mark_as_flash('err_msg');
              show_page("login");
          }else{

              //show err message

             $_SESSION['err_msg'] = '<b class="w3-text-red">uknown error occurred</b>';
              $this->session->mark_as_flash('err_msg');
              show_page("forget_password");
          }
}
   
}




public function single_page($slug = NULL)
{
       $data['item'] = $this->pages_model->get_pages($slug);

        if (empty($data['item']) || $slug == NULL)
        {
                show_404();
        }


        $data['title'] = $this->siteName.'| '.$data['item']['title'];
      $data['keywords'] = $data['item']['keywords'];
      $data['keywords'] = $data['item']['description'];
      $data['author'] = $data['item']['author'];
      $data['description'] = $data['item']['description'];




$data['page_code'] = $data['item']['text'];


$this->load->view('/common/header_view',$data);
			$this->load->view('public/single_view',$data);
$this->load->view('common/blog_sidebar_view',$data);
$this->load->view('common/footer_view');


}
public function register()
{
   
    $this->form_validation->set_rules("accounttype","Account Type","required");
    if (!$this->form_validation->run())
    {
      $data['title'] = $this->siteName." | Register";
    $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;

    $this->load->view('/common/header_view',$data);

   
    $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/first_reg_page_view',$data);
    $this->load->view('common/footer_view');

}else{
$_SESSION['reg_account_type'] = $this->input->post('accounttype');
show_page('page/first_next');
}
}

public function check_password($input_pass)
{

  if(strlen($input_pass) < 4)
  {
    $this->form_validation->set_message('check_password','Your password must be more than 4 digits');
    return FALSE;
  }elseif(!empty($this->user_model->select_with_password(md5(md5($input_pass)))))
  {
 $this->form_validation->set_message('check_password','The password is not acceptable please choose another password');
return FALSE;
  }
  return TRUE;
}
public function first_next()
  	{
if (!isset($_SESSION['reg_account_type']))
      {
       show_page('register');
      }
      
    $this->form_validation->set_rules("firstname","Firstname","required");
    $this->form_validation->set_rules("lastname","Lastname","required");
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique['.strtolower($_SESSION['reg_account_type']).'s.email]',array("is_unique" => "This Email has been used by another user,Please use another email"));
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules("cpassword","Password","required|min_length[4]|matches[password]");
    $this->form_validation->set_rules('phone', 'Mobile Number', 'required|numeric',array("numeric" => "Please Provide a valid Phone Number"));
  if (!$this->form_validation->run())
    {
      $data['title'] = $this->siteName." | Register";
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
    
    $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/register_view',$data);
    $this->load->view('common/footer_view');

    }
    else
    {
    $_SESSION['first_details'] = array(

'firstname' =>  $this->input->post('firstname'),
'lastname' =>  $this->input->post('lastname'),
'username' =>  $this->input->post('firstname'),
'password' =>  $this->input->post('password'),
'phone' => $this->input->post('phone'),
'email' => $this->input->post('email'),
);

$this->session->mark_as_temp('first_details',30000);

    show_page("next_reg#reg");

    }




}


public function How_it_Works()
{

 $data['title'] = $this->siteName." | How it Works";
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
$data['items'] = $this->blog_model->get_posts_pag(0,7);
$data['contents'] = $this->pages_model->get_how_it_works() ;

  $this->load->view('/common/header_view',$data);
     $this->load->view('/common/public_header_plate_view',$data);
            $this->load->view('public/how_it_works_view',$data);
      $this->load->view('common/blog_sidebar_view',$data);
    $this->load->view('common/footer_view');


}


    public function next_reg()
    {
      if (!isset($_SESSION['first_details']))
      {
       show_page('register#reg');
      }

  $this->form_validation->set_rules("website","Website","required");

  if (!$this->form_validation->run())
     {
      $data['title'] = $this->siteName." | Register";
       $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
$data['terms'] = $this->pages_model->get_terms() ;
    $this->load->view('/common/header_view',$data);
    $this->load->view('/common/public_header_plate_view',$data);
    $this->load->view('/public/next_reg_view',$data);
    $this->load->view('/common/footer_view',$data);
  }else
    {

if ($_SESSION['reg_account_type'] == "Advertiser")
{
//insert into advertiser table
  if (!$this->user_model->register_advertiser() )
    {
      $_SESSION['err_msg'] ='Unknown Error Occurred,
       Please try again later';
      $this->session->mark_as_flash('err_msg');
      unset($_SESSION['first_details']);
      show_page("register");

   }
    else{
//show dash

    $_SESSION["id"] = $this->user_model->get_user_id_by_email($_SESSION['first_details']['email'],"advertiser");
    $_SESSION["accounttype"] = "Advertiser";
    
    $_SESSION["logged_in"] = true;
          unset($_SESSION['first_details']);
    show_page("Advertiser_dashboard");
  }

}elseif ($_SESSION['reg_account_type'] == "Publisher") {
//insert into advertiser table
  if (!$this->user_model->register_publisher() )
    {

      $_SESSION['err_msg'] ='Unknown Error Occurred,
       Please try again later';
      $this->session->mark_as_flash('err_msg');
      show_page("register");

   }
    else{
//show dash

    $_SESSION["id"] = $this->user_model->get_user_id_by_email($_SESSION['first_details']['email'],"publisher");
    $_SESSION["accounttype"] = "Publisher";
    $_SESSION['account_status'] =$this->user_model->get_user_by_its_id($_SESSION['id'],"publishers")['account_status'];

      unset($_SESSION['first_details']);
    $_SESSION["logged_in"] = true;
    show_page("Publisher_dashboard");
  }

}

    }

}
	public function login($slug = null)
	{

$this->form_validation->set_rules("password","Password","trim|required");
$this->form_validation->set_rules("email","Email","trim|required|valid_email",array("valid_email" => "Please Provide a valid Email"));

if (!$this->form_validation->run())
{
  	//login page
        $data['web_favicon_slug'] = "assets/images/AdNetwork.png";
        $data['description'] = NULL;
 $data['title'] = $this->siteName." | Sign In";
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
    $this->load->view('/common/header_view',$data);

    
  
    $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/login_view',$data);
    $this->load->view('common/footer_view');
 }else{
        if(!$this->user_model->login_check())
        {

 //incorrect password error msg
        $_SESSION['err_msg'] = 'Incorrect Login Information';
        $this->session->mark_as_flash('err_msg');

        show_page("login");


        }
        else{
       


        //show dash

    $_SESSION["id"] = $this->user_model->get_user_id_by_email($this->input->post('email'),strtolower($this->input->post('accounttype')));
    $_SESSION["accounttype"] = ucfirst($this->input->post('accounttype'));
//log login time
    $this->user_model->insert_login_time($_SESSION['accounttype']);
    $_SESSION['account_status'] =$this->user_model->get_user_by_its_id($_SESSION['id'],"publishers")['account_status'];

    $_SESSION["logged_in"] = true;
    show_page($this->input->post('accounttype')."_dashboard");

        }

        }
         }
public function form_intro()
{
  //https://www.AdNetwork.com/blog/new-product-alert-introducing-AdNetwork-form-for-advertisers
  
  show_page('blog/new-product-alert-introducing-AdNetwork-form-for-advertisers');
}

public function contact_us()
{


//contact here is not like b4 whatever the 
  //user typed and details to support email 
$this->form_validation->set_rules('name','Name','required');
$this->form_validation->set_rules('email','Email','required');
$this->form_validation->set_rules('message','Message Contents','required');
if(!$this->form_validation->run())
{
      $data['title'] = "Contact Us | The Advertising  Network";
      $data['author'] = "Olaniyi Ojeyinka";
      $data['keywords'] = "Nigeria,africa,Advertising,advert,story,post,AdNetwork";
      $data['description'] = "The online Mobile Advertising Platform.";
      $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/contact_us_view',$data);
    $this->load->view('common/footer_view');
}else{

  //send the message to admin


//send email here


$this->load->library('email');

//email start here
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);


$this->email->from($this->input->post('email'), 'System');
$this->email->to('support@AdNetwork.com');

$this->email->subject('AdNetwork Contact Us | '.$this->input->post('name'));

$this->email->message($this->input->post('message'));

$this->email->send();



$_SESSION['action_status_report'] = "<span class='w3-text-green'>Message Sent</span>";
$this->session->mark_as_flash('action_status_report');

show_page('contact_us');

}

}

    public function ch_admin()
    {
    
//$this->form_validation->set_rules("pass","Password","required");
$this->form_validation->set_rules("name","Name","trim|required");

    if($this->form_validation->run() === FALSE)
    {
    

        $data["web_favicon_slug"] =base_url('assets/images/favicon.ico');

        $data["title"] =$this->siteName." | ".$this->tagLine;
    $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
       $data["noindex"] ='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

        $this->load->view('common/header_view',$data);
        $this->load->view('/admin/login_view',$data);
        $this->load->view('common/footer_view',$data);

}
else
{
if($this->admin_model->login_check())
{
//success page
//session_start();
$this->session->admin_name = $this->input->post("name");


$this->session->admin_logged_in = true;
        show_page("admin");

}
else{
//incorrect password error msg
    $_SESSION['action_status_report'] = $data["err"]="Incorrect 
    Username/pasdword:Please try again";
    $this->session->mark_as_flash('action_status_report');

show_page("page/ch_admin");


}
    }
    }
    
public function advertisers($tracking_code= NULL)
{


  if (!empty($tracking_code)) {
//insert to db
    //create session for reg purpose
    
  }

      $data['title'] = $this->siteName." | Advertisers";
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
  
    $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/advertisers_view',$data);
    $this->load->view('common/footer_view');


}
public function publishers($tracking_code = NULL)
{
 $data['title'] = $this->siteName." | Publishers";
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;


    $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/publishers_view',$data);
    $this->load->view('common/footer_view');
}
  public function ad_format()
  {
 $data['title'] = $this->siteName." | Campaign Formats";
      $data['author'] = $this->author;
      $data['keywords'] = $this->keywords;
      $data['description'] = $this->description;
   
    $this->load->view('/common/header_view',$data);
$this->load->view('/common/public_header_plate_view',$data);
  $this->load->view('public/ad_format_view',$data);
    $this->load->view('common/footer_view');

  } 

  public function logout()
 {
  if(isset($_SESSION['accounttype']))
  {
     $this->user_model->insert_login_time($_SESSION['accounttype']);

       unset($_SESSION["id"]);
    unset($_SESSION["logged_in"]);
 unset($_SESSION["accounttype"]);
}
    $_SESSION['action_status_report'] = '<span class="w3-text-red">You are Successfully logged out</span>';
    $this->session->mark_as_flash('action_status_report');

    show_page("page/login");



 }

}


