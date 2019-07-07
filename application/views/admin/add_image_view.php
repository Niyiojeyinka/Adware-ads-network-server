<div class="w3-twothird">

<a style="margin-left:2%" class="w3-btn w3-blue" href="<?php
echo site_url("media");
?>">Go To Media</a>


<div class="w3-image">
<img style="width:200px;" src="<?php
if(isset($image))
{
echo $image;
}
?>
" alt="just uploaded image"></img><br>

<input type="text" size="40" value="<?php
if(isset($image))
{
echo $image;
}

?>"></input>

</div>

<?php

if(isset($err_reports))
{
echo $err_reports;
}

?>



<div class="w3-text-red"><?php
if(isset($error))
{
echo $error;
}
?> </div>

<?php
echo form_open_multipart('media/upload_image');
?>
<input type="file" name="userfile" size="20"/><br/><br/>
 <input type="submit" class="w3-btn w3-blue" value="upload"/> </form>



</div>
