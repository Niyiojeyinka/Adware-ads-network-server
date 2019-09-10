<div class="w3-twothird">


<div class="w3-center">
<b class="w3-xlarge w3-text-blue-grey">Post New Article:</b><br>

<?php

echo form_open_multipart('admin_blog/add_post');

?>
<span ="w3-text-red"><?php
echo validation_errors(); ?>
</span>
<?php
if(isset($_SESSION['action_status_report']))
{

	echo $_SESSION['action_status_report'];

}
?>
<br>
<span class="w3-label">Title:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="title" value="<?php echo set_value('title'); ?>" placeholder="Article title"></input>
<br><br>





<script>
    $(document).ready(function() {
       $('#contents').summernote({
    height: ($(window).height() - 300),
    callbacks: {
        onImageUpload: function(image) {
            uploadImage(image[0]);
        }
    }
});

function uploadImage(image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        url: '<?=site_url("gettew_webfunction/upload_image") ?>',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
            var image = $('<img>').attr('src', /*'http://' + */url);
            $('#contents').summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}});


</script>




<center>
<span class="w3-label">Contents:</span><br>
<textarea id="contents" placeholder="Article contents" class="w3-center w3-border-blue-grey" name="contents"  value="<?php  echo set_value('contents'); ?>" rows="25" cols="52"></textarea><br>

<br>
<span class="w3-label">Meta Keywords(separated by comma):</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="keywords"  value="<?php echo set_value('keywords'); ?>" placeholder="Post Meta Keywords"></input>
<br>

<br>
<span class="w3-label">Meta Description:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="desc"  value="<?php echo set_value('desc'); ?>" placeholder="Post Meta Description"></input>
<br><br>
<span class="w3-label">Category:</span><br>
<select class="w3-padding" name='category'>
		<option value="">No Category</option>
	<option value="Documentation">Documentation</option>
	<option value="How_Tos">How Tos</option>
	<option value="Advertising">Advertising</option>
	<option value="Marketing">Marketing</option>
	<option value="Business">Business</option>
	<option value="New_Upadte">New Update</option>
	<option value="New_Feature">New Feature</option>

</select>
<br><br>


</center>
<span class="w3-label">Feature Image:</span><br>
<input type="file" class="w3-border-blue-grey w3-padding" style="width:60%;" name="fimg"  ></input><br>
<br>

<a class="w3-button w3-green w3-margin" href="<?php echo site_url("media"); ?>">Go to Media</a><br>

<input type="submit" class="w3-btn w3-blue" value="Publish" name="submit"></input><br>


</div>
