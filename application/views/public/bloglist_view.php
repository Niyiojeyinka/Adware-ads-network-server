<br>

<div class="w3-padding w3-padding-top w3-row">
<div  class="w3-col l3 m4 s12">
<span class='w3-text-blue w3-xlarge'>
<b>Latests From Our Blog</b></span><br>
</div>
<div class="w3-col w3-white l9 m8 s12">

<?php

if (!empty($items))
{
foreach ($items as $item)
{
	?>
 <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href='<?=site_url("/blog/".$item['slug']) ?>'>
                        <h2 class="post-title">
                            <?= $item['title'] ?>
                        </h2></a>
                      <!--=  <h3 class="post-subtitle">
                            Problems look mighty small from 150 miles up
                        </h3>-->
                    </a>
                    <p class="post-meta">Posted by Custch on <?=date( "F j, Y, g:i a",$item['time']) ?></p>
                </div>
                <hr>
                
               
            </div>
        </div>
    </div>

    <hr>
<?php

}}
?>
 <!-- Pager --><center>
                <ul class="pager">
               <?php echo $pagination; ?></center><br>


</div>

</div>

