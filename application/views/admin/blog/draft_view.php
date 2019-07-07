<div class="w3-twothird">


<div class="w3-center">


<b class="w3-center w3-text-grey w3-xlarge">Post From Draft</b><br>


<?php 
if(isset($_SESSION['action_status_report']))
{
echo $_SESSION['action_status_report'];
}
 ?>

<?php 

if (!empty($items))
{

foreach ($items as $item)
{

echo "<br><br><center><ul><div style='width:85%' class='w3-container w3-text-blue-grey w3-border w3-center'> 
<span class='w3-text-blue-grey'><li><a href='".site_url()."/blog/view/".$item['slug']."'><b>".$item['title']."</b></a><br><a href='".site_url()."/admin_blog/edit_post/".$item['id']."'>Edit</a><a style='margin-left:2%' href='".site_url()."/admin_blog/delete_post/".$item['id']."'>Delete</a>";





 $statu = $item['status'];
	
if ($statu == "published")
{

 echo "<a style='margin-left:2%' href='".site_url("admin_blog/move/").$item['id']."/post'>Move To Draft</a>";

}
else {


echo "<a style='margin-left:2%' href='".site_url("admin_blog/move/").$item['id']."/post'>Publish</a>";

}
	
	




echo "</span></div></li></center><br>";

}
}else{
echo "No blog entries";

}


?>


</ul>
</div>



