<div class="w3-container w3-center">
<br>
<span class="w3-text-indigo w3-large w3-serif">Form Data</span><br>
<div  style='display: inline;overflow-y: scroll' class="w3-container">

<center class='w3-responsive'><table style='max-width:80%;/*overflow-x: scroll;*/' class='w3-table w3-striped w3-center w3-responsive'>
<?php


if(!empty($data_list))
{
	//check if the cpa data is not empty
echo "<tr>";
foreach (json_decode($cpa['form_makeup_data'],true) as $lone) {
	/*list available field from the form_makeup_data column*/
	echo "<th>".ucfirst($lone['field_names'])."</th>";
}
echo "</tr>";


foreach ($data_list as $lone){
	/*list available data from the form_data column*/
echo "<tr>";
	foreach (json_decode($cpa['form_makeup_data'],true) as $index) {
		/*use available field from the form_makeup_data column as index*/

$to_output = $lone[str_replace(' ', '_', $index['field_names'])];

	
		if (isset($lone[$index['field_names']])) {
if ($index['field_type'] != 'inbuilt') {

		if(!is_array($to_output ))
		{
			echo "<td>".ucfirst($to_output)."</td>";
		}else{
			echo "<td>";
			foreach ($to_output as $out) {
				echo $out.",";
			}
			echo "</td>";
		
	
	}

}else{
	echo "<td>".date( "F j, Y, g:i a",$to_output)."</td>";
}

}else{
    echo "<td>NULL</td>";
  }
}
echo "</tr>";
	//echo "<th>".var_dump($lone)."</th>";
	//break;
}
}else{
	echo "No Data Available Yet";
}

//echo var_dump(json_decode($cpa['form_data'],true));
?>
	</table></center><br>
<?=$pagination ?>


</div>

</div>