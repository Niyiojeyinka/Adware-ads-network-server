<div class="w3-container w3-center">
<span class="w3-text-indigo w3-large w3-serif">Campaign Details(<?= $campaign_item['name']?>)</span><br>

<?php
if(isset($_SESSION['action_status_report']))
{
echo $_SESSION['action_status_report'];
}
?>


<div class="w3-container w3-center">
	<div class="w3-container w3-padding w3-half w3-center">
			<span class="w3-text-indigo"><b>Campaign Performance</b></span>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      var data = google.visualization.arrayToDataTable([
          ['Time', 'Clicks', 'Views'],
           ['4Days Ago',   <?= $four_days_ago_clicks ?>,       <?= $four_days_ago_views ?>],
           ['3Days Ago',   <?= $three_days_ago_clicks ?>,       <?= $three_days_ago_views ?>],
          ['2Days Ago',   <?= $two_days_ago_clicks ?>,       <?= $two_days_ago_views ?>],
          ['Yesterday',   <?= $yesterday_clicks ?>,        <?= $yesterday_views ?>],
          ['Today',   <?= $today_clicks ?>,      <?= $today_views ?>]
        ]);


        var options = {
          title: '',
          hAxis: {title: 'Time',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>	    <div id="chart_div" style="width: 100%; height: 500px;"></div>
</div>



	<div class="w3-container w3-padding w3-half w3-small">
		<br><br>

			<span class="w3-text-indigo"><b>Campaign Statistics</b></span>
			<div style="width: 80%" class="w3-container">
  <table class="w3-table w3-striped w3-white">
          <tr>
            <td><i class="fa fa-eye w3-text-blue w3-large"></i></td>
            <td>Views Today.</td>
            <td><i><?php
echo $today_views;
             ?></i></td>
          </tr>

<tr>
            <td><i class="fa fa-hand-o-up w3-text-indigo w3-large"></i></td>
            <td>click Today.</td>
            <td><i><?php
echo $today_clicks;
             ?></i></td>
          </tr>
<tr>
            <td><i class="fa fa-eye w3-text-red w3-large"></i></td>
            <td>Total Views.</td>
            <td><i><?php
echo $campaign_item['views'];
             ?></i></td>
          </tr>

<tr>
            <td><i class="fa fa-hand-o-up w3-text-yellow w3-large"></i></td>
            <td>Total click.</td>
            <td><i><?php
echo $campaign_item['clicks'];
             ?></i></td>
          </tr>

</table>
</div>


<div class="w3-half" ><span class="w3-text-indigo w3-small w3-serif"><b>Campaign Demo</b></span><br>

		<?php
if($campaign_item['type'] =="text")
{
  echo "<div class='w3-border w3-border-blue'>";
echo "<span class='w3-text-blue'><b>".$campaign_item['text_title']."</b></span><br>";
echo "<span class='w3-small'>".$campaign_item['text_content']."</span><br>";
echo "<span class='w3-text-blue'><b>".$campaign_item['disp_link']."</b></span><br>";

  echo "</div>";

}elseif ($campaign_item['type'] =="banner") {
   //echo "<div class='w3-container'><b>250px X 350px</b></div>";
    echo "<div class='w3-center'>";
echo "<img class='w3-card' style='max-width:100%;max-height:100%' src='".base_url('assets/campaigns/'.$campaign_item['img_link'])."'/>";
  echo "</div>";
}elseif ($campaign_item['type'] =="recommendation") {

echo "<div class='w3-container w3-row w3-border w3-margin-bottom w3-padding w3-center' ><div class='w3-col s4 m12 w3-padding'><img class='w3-image w3-margin-top' src='".base_url('assets/campaigns/'.$campaign_item['img_link'])."'/></div><div id='text' class='w3-col s8 m12 w3-padding-bottom' style='text-align:justify;'><span class='w3-large' id='text'><b>".$campaign_item['text_title']."</b></span></div></div>";



}/*elseif ($campaign_item['type'] =="banner_text") {
  //echo "<div class='w3-container'><b>250px X 350px</b></div>";
    echo "<div class='w3-center w3-card'>";
echo "<img class='' style='max-width:100%;max-height:100%' src='".base_url('assets/campaigns/'.$campaign_item['img_link'])."'/>";
echo "<center><div style='width:200px;' class='w3-margin w3-center'>".$campaign_item['text_title']."</div>";
    echo "</div></center>";
}*/


	

		 ?>
		</div>
    <div class="w3-half">
      <span class="w3-text-indigo w3-small w3-serif"><b>Budget Details</b></span><br>

      <div style="width: 80%" class="w3-container">
  <table class="w3-table w3-striped w3-white">
          <tr
<?php
if ($campaign_item['per_click'] <= 0) {

echo "style='display:none;'";}

?>
          >
            <td>Cost Per Click</td>
            <td><i> <?= $general_details['currency_code'].' '.$campaign_item['per_click'] ?></i></td>
          </tr>
            <tr
<?php
if ($campaign_item['per_view'] <= 0) {

echo "style='display:none;'";}

?>
  
            >
            <td>Cost Per View</td>
            <td><i> <?= $general_details['currency_code'].' '.$campaign_item['per_view'] ?> </i></td>
          </tr>
            <tr
<?php
if ($campaign_item['per_action'] <= 0) {

echo "style='display:none;'";}

?>
  
            >
            <td>Cost Per Action</td>
            <td><i> <?= $general_details['currency_code'].' '.$campaign_item['per_action'] ?> </i></td>
          </tr>
            <tr
<?php
if ($campaign_item['per_paid_action'] <= 0) {

echo "style='display:none;'";}

?>
  
            >
            <td>Cost Per Paid Action</td>
            <td><i> <?= $general_details['currency_code'].' '.$campaign_item['per_paid_action'] ?> </i></td>
          </tr>
            <tr>
            <td>Budget</td>
            <td><i> <?= $general_details['currency_code'].' '.$campaign_item['budget'] ?> </i></td>
          </tr>
            <tr>
            <td>Balance</td>
            <td><i> <?= $general_details['currency_code'].' '.$campaign_item['balance'] ?></i></td>
          </tr>
            <tr>
            <td>Total Spent</td>
            <td><i> <?= $general_details['currency_code'].' '.($campaign_item['budget']- $campaign_item['balance']) ?></i></td>

          </tr>
        </table>
    </div>
	</div>

</div>

<div class="w3-container">
	<?php
if($campaign_item['status'] == "active")
{
echo "<a  class='w3-button w3-red w3-margin' href='".site_url('advertiser_dashboard/campaign_action/stop/'.$this->uri->segment(3))."'>Stop</a>";

}elseif($campaign_item['status'] == "pending")
{
	echo "<a  class='w3-button w3-grey w3-margin' href=''>Pending</a>";


}elseif($campaign_item['status'] == "inactive")
{
	echo "<a  class='w3-button w3-green w3-margin' href='".site_url('advertiser_dashboard/campaign_action/start/'.$this->uri->segment(3))."'>Start</a>";

}
?>

</div>
<?= form_open('advertiser_dashboard/fund_campaign/'.$this->uri->segment(3)) ?>
<span class="w3-text-indigo">Add Fund From Main Balance</span><br>
<input type="number" name="amount" class="w3-padding" placeholder="0.00"/><br>
<input type="submit" name="submit" class="w3-button w3-indigo" value="Add Fund"/>
</form>
</div>
</div>