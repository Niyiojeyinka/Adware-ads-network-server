# PHP-AdNetworkServer

### Contents
<ul>
<li><a href="#req">Requirements</a></li>
<li><a href="#pub">Publisher's Features</a></li>
<li><a href="#adv">Advertiser's Features</a></li>
<li><a href="#admin">Admin's Features</a></li>
<li><a href="#auto">Auto Installation</a></li>
<li><a href="#manual">Manual Installation</a></li>
<li><a href="#todo">Todo(s)</a></li>


</ul>




A PHP web App for Serving Text Ads,Image Ads and Article like Ads on anpther website think of Google adsense
<br>
------------------------------------------------------- Features------------------------------------------------------------------



<br><br>
<div class="admin">

## Network Admin Features-
<ul>
<li>Monitor/Manage campaign and ads spaces</li>
<li>Manage Advertisers & Publishers</li>
<li>Approve/Disapprove Publisher account</li>
<li>Process Publisher withdrawal <li>
<li>Business Settings like Setting of Minimum CPC,CPM,CPA</li>
<li>Credit/Debit Users' Account</li>
<li>Set site meta/seo details </li>

</ul>
</div>


## Publisher Account-

<ul id="pub">
	<li>Withdrawal Request</li>
<li>Integration Code Generator</li>
<li>Manage Ads Spaces</li>

</ul>

## Advertiser Account-
<ul id="adv">

<li>Account Settings</li>
<li>Ad Creator</li>
<li>Form builder : Create and Manage Forms </li>
<li>Manage Ads</li>
<li>Ads Performance Report </li>
<li>Integration with Flutterwave Payment Gateway</li>
<li>Multicurrency and Multi-Country support</li>
<li>for any information contact me on twitter @niyiojeyinka or olaniyiojeyinka@gmail.com</li>
</ul>

Since  this software was not orignally created to be open source so some function are not dynamic but hard coded
will be working on modifying it suit the new purpose and also make it easy to install

App live on www.custch.com

## Installation

### Automatic installation
<ul class="auto">
	<li>Copy the files to your root directory</li>
	<li>visit youraddress/index.php/install/index  and fill in the input ,then click on install now button</li>

</ul>

<br>

### Manual installation
<ul class="manual">
	<li>Download the zip file of this repo and extract</li>
	<li>edit the <code>application/controllers/installer.json</code>  </li>
	<li>and input as follows:</li>
	<li><ul>
<li>change the hostname's value to your database url/ip</li>
<li>change the username's value to your database username</li>
<li>change the password's value to your database password</li>
<li>change the database's value to your database name</li>

<li>change the base_url's value to your home url e.g yourdomain.com</li>
	</ul>
	</li>

</ul>

<br>
<div class="req">
## Requirement
PHP 5.6+,MYSQL 5+ 

</div>
## Todo
<div class="todo">
--Add Editor to Homepage OR make it theme based<br>
--Ability to change branding element like colors,logos etc<br>
--edit of email and its admin section
--Paypal,flutterwave ,paypal integration<br>
--more beautiful admin dashboard<br>
--ability for admin to choose out of available featured payment gateway from the admin dashboard<br>
--upgrade blog functionality or remove completely
</div>