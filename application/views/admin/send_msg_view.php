<div class="w3-container w3-twothird">



<b class="w3-center w3-text-grey w3-xlarge">Send A Message</b><br>


<div>
<?php

if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}


echo form_open('admin/send_msg/'.$this->uri->segment(3).'/'.$this->uri->segment(4));

?>	
<br>
<span class="w3-label w3-large">Message Title:</span><br>
<input type="text" class="w3-padding w3-margin-top" name="title" value="<?= set_value('title') ?>" placeholder="Message Title" required/>


<br><br>
<textarea 
cols="20" 
rows="15" 
class="w3-border w3-margin-top" name="contents">Your Message here</textarea>
<br>


<select name="type" class="w3-padding">
	
	<option value="personal">Personal</option>

	<option value="general"
<?php

if(empty($this->uri->segment(3)))
{


	echo "selected";
}


?>
	>General</option>
</select>
<br>
<span class="w3-label w3-small">Please do not change this option unless you really know what you are doing<br>
General:Message for all person
<br>
Personal: Message for Specified User</span><br>
<input type="submit" name="submit" class="w3-btn w3-blue" value="Send"/>
</form>

<br>
</div>











</div>
















</div>