<div class="w3-twothird">


<div class="w3-center">
<b class="w3-xlarge w3-text-blue-grey">Edit Page:</b><br>
<form action="<?php
echo site_url('admin_blog/edit_page/'.$this->uri->segment(3));
?>" method="post">
<span ="w3-text-red"><?php
echo validation_errors(); ?>
</span>
<?php
if(isset($_SESSION['err_reports']))
{

  echo $_SESSION['err_reports'];

}

?>
<br>
<span class="w3-label">Title:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="title" value="<?php echo $title; ?>" placeholder="Article title"></input>
<br><br>



<input type="hidden" name="idkey" value="<?php echo $this->uri->segment(3); ?>"></input>


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
<textarea id="contents" placeholder="Article contents" class="w3-center w3-border-blue-grey" name="contents"  rows="25" cols="52"><?php  echo $content; ?></textarea><br>

<br>
<span class="w3-label">Meta Keywords(separated by comma):</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="keywords"  value="<?php echo $keywords; ?>" placeholder="Post Meta Keywords"></input>
<br>

<br>
<span class="w3-label">Meta Description:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="desc"  value="<?php echo $description; ?>" placeholder="Post Meta Description"></input>
<br>



</center>
<br>

<a class="w3-button w3-padding w3-green" href="<?php echo site_url("media"); ?>">Go to Media</a><br><br>

<input type="submit" class="w3-btn w3-blue" value="Update" name="submit"></input><br>


</div>
