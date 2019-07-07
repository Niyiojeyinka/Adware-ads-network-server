<div class="w3-twothird">


<div class="w3-center">

<?php 

if(isset($_SESION['action_status_report']))


echo $_SESION['action_status_report']; ?>
<br>
<b class="w3-center w3-text-grey w3-xlarge">Posts</b><br>

<?php 

if (!empty($items))
{

foreach ($items as $item)
{

echo "<center><div style='width:85%' class='w3-container w3-text-blue-grey w3-center'> 
<span class='w3-text-blue-grey'><li><a href='".site_url()."/blog/view/".$item['slug']."'><b>".$item['title']."</b></a><br><a href='".site_url()."/admin_blog/edit_post/".$item['id']."'>Edit</a><a style='margin-left:2%' href='".site_url()."/admin_blog/delete_post/".$item['id']."'>Delete</a>";





 $statu = $item['status'];
	
if ($statu == "published")
{

 echo "<a style='margin-left:2%' href='".site_url("admin_blog/move/").$item['id']."/post'>Move To Draft</a>";

}
else {


echo "<a style='margin-left:2%' href='".site_url("admin_blog/move/").$item['id']."/post'>Publish</a>";

}
	
	




echo "</span></div></center><br>";

}
}else{
echo "No blog entries";

}


?>


</ul>




<?php echo $pagination; ?>
</div>