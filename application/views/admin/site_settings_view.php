<div class="w3-twothird w3-center w3-padding w3-center">

	<span class="w3-xlarge w3-text-blue-grey">
    SITE & SEO Settings
	</span>
<div class="w3-padding">
<?= form_open("admin/site_settings") ?>

<span class="w3-label w3-large">Site Name: </span><br>
<input type="text" placeholder="Site Name" class="w3-padding w3-margin" name="site_name"
 value="<?=$site_name ?>"/>
<br>
<span class="w3-label w3-large">Site Tag Line:<span class="w3-small">
	or Motto</span> </span><br>
<input type="text" placeholder="Site Tagline"  class="w3-padding w3-margin" name="site_tagline"
 value="<?=$site_tagline ?>"/>
<br>
<span class="w3-label w3-large">Site Author: </span><br>
<input type="text" placeholder="Site Author"  class="w3-padding w3-margin" name="site_author"
 value="<?=$site_author ?>"/>
<br>
<span
<span class="w3-label w3-large">Site keywords:<span class="w3-small">
	Each separated comma ','</span> </span><br>
<input type="text" placeholder="Site Keywords"  class="w3-padding w3-margin" name="site_keywords"
 value="<?=$site_keywords ?>"/>
<br>
<span
<span class="w3-label w3-large">Site Descriptions: </span><br>
<textarea placeholder="Descriptions here" cols="10" rows="10">
	<?= $site_descriptions?></textarea>

<input type="submit" class="w3-button w3-blue w3-margin" value="Change Site Details"/>

</div>




</div>
