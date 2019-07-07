  <!-- Post Content -->
   <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1"><!--feature image--><br>
<?php

if (!empty($item['img_url']))
{
echo '<img src="'.base_url('assets/media/images/'.$item['img_url']).'" class="w3-image w3-center" style="max-width:70%;" alt="'.$item['title'].'" img></img>';
}
?><br>
<span class="w3-small"><b><?= $item['title']?></b></span>
      <br>             <?php echo $item['text']; ?>
                </div>


            </div>
        </div>
    </article>
<hr>