
<!--<?=strtotime(date("d-m-y")) ?>
<?= date( "F j, Y, g:i a",strtotime(date("d-m-y"))) ?>

<?=strtotime(date("y-m-d")) ?>
<?= date( "F j, Y, g:i a",strtotime(date("y-m-d"))) ?>
-->
<div class="w3-container w3-center">
<span class="w3-text-indigo w3-xlarge w3-serif">Space Details<br>(<?= $item['name'] ?>)</span><br>



<div class="w3-container">
	<div class="w3-half">
<span class="w3-text-indigo"><b>Performance Charts</b></span>
<!--- pie start here-->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Volume'],
          ['Views',     <?=$item['views'] ?>],
          ['Clicks',      <?=$item['clicks'] ?>]
        
        ]);

        var options = {
          title: 'Ads Space Performance'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

  <div id="piechart" style="width: 900px; height: 500px;"></div>
<!--pie ends here-->
</div>
<div class="w3-half">

	
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
    </script>	
       <div id="chart_div" style="width: 100%; height: 500px;"></div> 
	</div>
</div>



<div class="w3-container">
	<div class="w3-twothird">
	<div class="w3-half">
					<span class="w3-text-indigo"><b>Space Details</b></span><br>
					<table style="max-width: 65%" class="w3-table w3-striped w3-white">
          <tr><td>
            <i class="fa fa-globe w3-text-blue w3-large"></i>
            Space URL</td>
            <td><i><?php
echo $item['website'];
             ?></i></td>
          </tr>
          <tr><td>
            <i class="fa fa-calendar-check-o w3-text-green w3-large"></i>
            Time Created</td>
            <td><i><?php
echo date( "F j, Y, g:i a",$item['time']);
             ?></i></td>
          </tr>

 <tr><td>
            <i class="fa fa-check w3-text-yellow w3-large"></i>
            Status</td>
            <td><i><?php
echo ucfirst($item['status']);
             ?></i></td>
          </tr>
          <tr><td>
            <i class="fa fa-hand-o-up w3-text-purple w3-large"></i>
            Clicks</td>
            <td><i><?php
echo $item['clicks'];
             ?></i></td>
          </tr>
            <tr><td>
            <i class="fa fa-eye w3-text-orange w3-large"></i>
            Views</td>
            <td><i><?php
echo $item['views'];
             ?></i></td>
          </tr>
</table>
	</div>


	<div class="w3-half">
					<span class="w3-text-indigo"><b>Space Details</b></span><br>
					<table style="max-width: 65%" class="w3-table w3-striped w3-white">
       
          <tr><td>
            <i class="fa fa-hand-o-up w3-text-purple w3-large"></i>
           Today's Clicks</td>
            <td><i><?php
echo $today_clicks;
             ?></i></td>
          </tr>
            <tr><td>
            <i class="fa fa-eye w3-text-orange w3-large"></i>
           Today's Views</td>
            <td><i><?php
echo $today_views;
             ?></i></td>
          </tr>
</table>
	</div>
</div>
	<div class="w3-third">
		<span class="w3-text-indigo"><b>Integration Code</b></span>
<br>
		<textarea cols="15" rows="5" id="secretInfo" class="w3-border w3-border-indigo w3-margin"><?= $item['code'] ?></textarea>
		<input type="button" id="btnCopy" class="w3-btn w3-small w3-indigo w3-round-jumbo" name="copy" value="Copy Code"/>
	</div>
    <script type="text/javascript">
      var $body = document.getElementsByTagName('body')[0];
      var $btnCopy = document.getElementById('btnCopy');
      var secretInfo = document.getElementById('secretInfo').value;
      var copyToClipboard = function(secretInfo) {
        var $tempInput = document.createElement('INPUT');
        $body.appendChild($tempInput);
        $tempInput.setAttribute('value', secretInfo)
        $tempInput.select();
        document.execCommand('copy');
        $body.removeChild($tempInput);
      }
      $btnCopy.addEventListener('click', function(ev) {
        copyToClipboard(secretInfo);
              alert('copied');

      });

    </script>

</div>

	
	
</div>