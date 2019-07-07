<div class="w3-twothird"><br>
<a style="margin-left:2%" class="w3-btn w3-blue" href="<?php
echo site_url("media/Upload_image");
?>">Add Image</a>


<div>
<br>




<?php 

if (!empty($items))
{

foreach ($items as $item)
{
echo "<br><div id='imgmedia'>";
echo "<img class='w3-image w3-card' src='".base_url("assets/media/images/".$item['link'])."' width='auto' class='w3-image' height='auto'></img>";
echo "<br><br><input type='text' value='". base_url("assets/media/images/".$item['link'])."'></input>";
echo "</div>";

}
}else{
echo "No Media Content";

}


?>






<?php
echo $pagination;
?>

</div>
</div>