
<center>
<div class="w3-container w3-white">
<span class='w3-text-red w3-xlarge'>
<b>

  Latests From Our Blog:</b></span><br>
<div id="blg">
<?php

if (!empty($items))
{

foreach ($items as $item)
{

echo "<div  class='w3-container w3-text-grey'>
<span class='w3-text-red'><a href='".site_url()."/blog/view/".$item['slug']."'><b>".$item['title']."</b></a></span>
<br><span>".get_blog_excerpt($item['text'],150)."......</span></div>";

}
}else{
echo "No blog entries";

}
if(isset($pagintion))
{
echo $pagination;
}
?>

</div>

</div>

              
</center>
</div>
