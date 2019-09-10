<div class="w3-twothird w3-center w3-padding">

	<span class="w3-xlarge w3-text-blue-grey">
    SITE & SEO Settings
	</span>
<div class="w3-padding">
<?= form_open("admin/site_settings") ?>

<span class="w3-label w3-large">Site Name: </span><br>
<input type="text" placeholder="Site Name" name="site_name"
 value="<?=$site_name ?>"/>
<br>
<span class="w3-label w3-large">Site keywords:<span class="w3-small">
	Each separated comma ','</span> </span><br>
<input type="text" placeholder="Site Keywords" name="site_keywords"
 value="<?=$site_keywords ?>"/>
<br>
<span class="w3-label w3-large">Site Descriptions: </span><br>
<textarea placeholder="Descriptions here" cols="10" rows="10">
	<?= $site_descriptions?></textarea>

<input type="submit" class="w3-button w3-blue w3-margin" value="Change Site Details"/>

</div>




</div>
