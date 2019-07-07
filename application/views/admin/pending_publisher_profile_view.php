<div class='w3-container w3-center w3-twothird'><br>
<br>
<div class="w3-text-red">
<?php
if(isset($_SESSION['action_status_report']))
{


	echo $_SESSION['action_status_report'];
}

?>
</div><span class='w3-large w3-text-blue-grey'>
<?php
echo  $user['firstname'].' '.$user['lastname'];
?></span>
<br>


<div class="w3-container">
<table class='w3-table w3-striped'>
<tr><td>Account Status</td><td><?= $user['account_status'] ?></td></tr>
<tr><td>Referral Username</td><td><?= $user['referral_id'] ?></td></tr>
<tr><td>Website</td><td><a href="http://<?= json_decode($user['websites'])[0] ?>"><?= json_decode($user['websites'])[0] ?></a></td></tr>
<tr><td>Account Email</td><td>
<?= $user['email'] ?>
</td></tr>
</table>
	<table class="w3-table w3-striped w3-small">
	<tr>
<td>
Total Amount Withdrawn</td>


<td>
	<b>USD</b><?= $user['total_earned'] ?>
</td>

</tr>
<tr>
<td>
	Account Balance Now
</td>


<td>
	<b>USD</b><?= $user['account_bal'] ?>
</td>

</tr>


	<tr>
<td>
	Pending Balance
</td>


<td>
	<b>USD</b><?= $user['pending_bal'] ?>
</td>

</tr>


	</table>
<br><span class='w3-center w3-text-large w3-text-blue-grey'>Withdrawal Details</span>
<br>

	<table class="w3-table w3-striped w3-small">
	<tr>
<td>
Account Name</td>


<td>
	<?= $user['bank_det'] ?>
</td>

</tr>
<tr>
<td>
	Account Number
</td>


<td>
	<?= $user['bank_no'] ?>
</td>

</tr>


	<tr>
<td>
	Bank Name
</td>


<td>
<?= $user['bank_name'] ?>
</td>

</tr>
</table>
<br><br>
</div>




<div class="w3-container w3-center w3-margin">
<a href="<?php echo site_url("admin/approve_pending_publisher/".$user['id']); ?>" class="w3-btn w3-green">Approve</a>


<a href="<?php echo site_url("admin/disapprove_pending_publisher/".$user['id']); ?>" class="w3-btn w3-red">Disapprove</a>

<a href="<?php echo site_url("admin/email/publishers/".$user['id']); ?>" class="w3-btn w3-blue">
Email</a>
</div>



<br>


</div>
