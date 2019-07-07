<div class="w3-twothird">


<div class="w3-center">

<br><?php
if(isset($_SESSION['err_reports']))
{

  echo $_SESSION['err_reports'];

}
?>
<br>
<b class="w3-center w3-text-grey w3-xlarge">Pages</b><br>

<?php

if (!empty($items))
{

foreach ($items as $item)
{

echo "<div style='width:90%' class='w3-container w3-text-blue-grey w3-center'>
<span class='w3-text-blue-grey'><a href='".site_url()."/p/".$item['slug']."'>
<b>".$item['title']."</b></a><br><a href='".site_url()."/admin_blog/edit_page/"
.$item['id']."'>Edit</a>";







echo "</span></div><hr></center>";

}
}else{
echo "No blog entries";

}


?>


</ul>
<?php echo $pagination; ?>
</div>
