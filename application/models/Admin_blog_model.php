<?php

class Admin_blog_model extends CI_Model {


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





public function insert_post($what = NULL,$image)
{
if($what == "post")
{

$slg = url_title($this->input->post('title'),"dash",TRUE);

 $article = array(

'title' => $this->input->post('title'),
'keywords' => $this->input->post('keywords'),
'description' => $this->input->post('desc'),
'category' => $this->input->post('category'),
'img_url' => $image,
'text' => $this->input->post('contents'),
'status' => 'published',
'slug' => $slg,
'time' => time()
);



 if( $this->db->insert('blog',$article))
 {


return true;

}
}elseif($what == "pages")
{
//insert into pages
$slg = url_title($this->input->post('title'),"dash",TRUE);

 $pag = array(

'title' => $this->input->post('title'),
'keywords' => $this->input->post('keywords'),
 'description' => $this->input->post('desc'),
'text' => $this->input->post('contents'),
'status' => 'published',
'slug' => $slg,
'author' => $_SESSION['name'],
'time' => time()
); 


if( $this->db->insert('pages',$pag))
{


return true;

}


}
elseif($what == "products")
{
$_shop1 = array("name" => $this->input->post("sname1"),"image" => $this->input->post("simage1"), "link" => $this->input->post("slink1"),"price" => $this->input->post("sprice1"));


$_shop2 = array("name" => $this->input->post("sname2"),"image" => $this->input->post("simage2"), "link" => $this->input->post("slink2"),"price" => $this->input->post("sprice2"));


$_shop3 = array("name" => $this->input->post("sname3"),"image" => $this->input->post("simage3"), "link" => $this->input->post("slink3"),"price" => $this->input->post("sprice3"));

if($this->input->post("fimg") != null)
{
$_imgs = json_encode(explode(',', $this->input->post("fimg") ) );

}else{

$_imgs = null;

}


$slg = url_title($this->input->post('name'),"dash",TRUE);

 $product = array(

'name' => $this->input->post('name'),
'keywords' => $this->input->post('keywords'),
'seo_desc' => $this->input->post('seo_desc'),
'short_desc' => $this->input->post('short'),
'long_desc' => $this->input->post('long'),
'category' => $this->input->post('category'),
'maker' => $this->input->post('maker'),
'model' => $this->input->post('model'),
'shop_one' => json_encode($_shop1),
'shop_two' => json_encode($_shop2),
'shop_three' => json_encode($_shop3),
'min_price' => $this->input->post('minp'),
'max_price' => $this->input->post('maxp'),
'image_url' => $_imgs,
'status' => 'published',
'slug' => $slg,
'time' => time()
);


if( $this->db->insert('products',$product))
{


return true;

}
return false;





}


}



public function edit_post($idkey,$img)
{

//edit means to update



 $article = array(

'title' => $this->input->post('title'),
'keywords' => $this->input->post('keywords'),
'img_url' => $img,
'description' => $this->input->post('desc'),
'category' => $this->input->post('category'),
'text' => $this->input->post('contents')
);


 if($this->db->update("blog",$article,array("id" => $idkey)))
 {

return true;

}
return false;
}


public function edit_product($idkey)
{

//edit or update


$_shop1 = array("name" => $this->input->post("sname1"),"image" => $this->input->post("simage1"), "link" => $this->input->post("slink1"),"price" => $this->input->post("sprice1"));


$_shop2 = array("name" => $this->input->post("sname2"),"image" => $this->input->post("simage2"), "link" => $this->input->post("slink2"),"price" => $this->input->post("sprice2"));


$_shop3 = array("name" => $this->input->post("sname3"),"image" => $this->input->post("simage3"), "link" => $this->input->post("slink3"),"price" => $this->input->post("sprice3"));



if($this->input->post("fimg") != null)
{
$_imgs = json_encode(explode(',', $this->input->post("fimg") ) );

}else{

$_imgs = null;

}





 $product = array(


'name' => $this->input->post('name'),
'category' => $this->input->post('category'),
'keywords' => $this->input->post('keywords'),
'seo_desc' => $this->input->post('desc'),
'short_desc' => $this->input->post('short'),
'long_desc' => $this->input->post('long'),
'maker' => $this->input->post('maker'),
'model' => $this->input->post('model'),
'shop_one' => json_encode($_shop1),
'shop_two' => json_encode($_shop2),
'shop_three' => json_encode($_shop3),
'min_price' => $this->input->post('minp'),
'max_price' => $this->input->post('maxp'),
'image_url' => $_imgs,
'status' => 'published'
);


 if($this->db->update("products",$product,array("id" => $idkey)))
 {

return true;

}
return false;
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


public function delete_item($type,$id)
{

if( $type == "post")
{

$this->db->delete("blog",array('id' => $id));
return true;
}elseif($type == "page")
{


if($this->db->delete("pages",array('id' => $id)))
{
return true;
}
return false;
}
elseif($type == "products")
{


if($this->db->delete("products",array('id' => $id)))
{
return true;
}
return false;
}



}







public function move_item($id,$type,$statu)
{






if ($type == "post" && $statu == "published")
{
 $article = array(

'status' => "draft"
);


$this->db->update("blog",$article,array("id" => $id));

return true;
}


elseif ($type == "post" && $statu == "draft")
{
 $article = array(

'status' => "published"
);


$this->db->update("blog",$article,array("id" => $id));

return true;

}



elseif ($type == "product" && $statu == "published")
{
 $article = array(

'status' => "draft"
);


$this->db->update("products",$article,array("id" => $id));

return true;
}


elseif ($type == "product" && $statu == "draft")
{
 $article = array(

'status' => "published"
);


$this->db->update("products",$article,array("id" => $id));

return true;

}


elseif ($type == "page" && $statu == "published")
{
 $pag = array(

'status' => "draft"
);


$this->db->update("pages",$pag,array("id" => $id));

return true;

}


elseif ($type == "page" && $statu == "draft")
{
 $pag = array(

'status' => "published"
);






$this->db->update("pages",$pag,array("id" => $id));

return true;

}
return false;
}




public function get_sdata($offset,$limit)
{

  $this->db->order_by("id","DESC");


$res = $this->db->get("search",$limit,$offset);
$result = $res->result_array();
return $result;
}




public function get_draft()
{


}



/*public function move_to_publish()
{


}

*/

}
