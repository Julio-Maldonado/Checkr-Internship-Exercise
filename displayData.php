<?php

// Gets the data for the requested state from my API endpoint and returns it sorted by fyDeclared
function get_data_for_state($state) {
  $url = 'http://projects.cse.tamu.edu/juliom72/modifyData.php?$key=fyDeclared&$filter='.$state;
  $arr = json_decode(file_get_contents($url),true);
  return $arr;
}

// Iterates through arr incrementing every states counter at requested key
function get_data_for_graph(&$arr,$key) {
	$a = [];
	foreach($arr as $item) {
		if($item[$key] != $temp) {
			$temp = $item[$key];
		}	
		$a[$temp]++;
	}
	return $a;
}
/* Iterates through arra and adds to a temp array so long as the $keys are in range of 
   $first and $second */
function get_data_in_range(&$arr,$first,$second) {
	$temp_arr = [];
	foreach($arr as $key => $item) {
		if ($key >= $first)
			$temp_arr[$key] = $item;
		if ($key >= $second)
			break;
	}
	return $temp_arr;
}

// Get data for state clicked
if(!empty($_GET['state'])) {
	$data = get_data_for_state($_GET['state']);
	$year_graph_arr = get_data_for_graph($data,'fyDeclared');
} else {
	$year_graph_arr = [];
}

// Used to filter data as requested by user
if (empty($_GET['flag']))
	$flag = false;
else {
	$flag = $_GET['flag'];
	$first = $_POST['first'];
	$second = $_POST['second'];
	// Assert that $first is less than $second
	if ($first > $second) {
		$temp = $first;
		$first = $second;
		$second = $temp;
	}
	// Get graph data
	$year_graph_arr = get_data_in_range($year_graph_arr,$first,$second);
}
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo '<title>Data for '.$_GET['state'].'</title>'?>
	<?php echo '<h3>Graph for '.$_GET['state'].'</h3>'?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		// Used Google Charts 
	    google.charts.load('current', {'packages':['line']});
		google.charts.setOnLoadCallback(drawChart);

	    function drawChart() {
	        var data = new google.visualization.DataTable();
	        data.addColumn('number', 'Year');
	        data.addColumn('number', 'Disasters');
	        data.addRows([
	        	// This php code is the only thing I changed, just iterates through rows and inputs the key and value for the rows in the google graph
	        	<?php 
	        		foreach($year_graph_arr as $key => $value)
	        			echo "[".$key.",".$value."],";
	        	?>
	        ]);         
	        var options = {
			    width: 900,
			    height: 500,
			    axes: {
			    	x: {
			        	0: {side: 'top'}
			    	}
			    },
			    hAxis: {format: 'decimal' }
	        };
	        var chart = new google.charts.Line(document.getElementById('line_top_x'));
	      	chart.draw(data, google.charts.Line.convertOptions(options));
	    }
	</script>
</head>
<body>
	<option value="decimal"></option>
	<div id="line_top_x"></div>
	<?php 
	/* If date has not been filtered, display a form to filter the date, otherwise
	   display go back */
	if (!$flag) {
		echo '<p>Please input two numbers in the range of '.reset(array_keys($year_graph_arr)).' and '.end(array_keys($year_graph_arr)).'</p>';
		echo '
		<form name="reloadGraph" action="displayData.php?state=TX&flag=true" onsubmit="return reloadGraph()" method="post">';
		echo '<input type="number" name="first" min = "'.reset(array_keys($year_graph_arr)).'" max = "'.end(array_keys($year_graph_arr)).'" value required>';
		echo '<input type="number" name="second" min = "'.reset(array_keys($year_graph_arr)).'" max = "'.end(array_keys($year_graph_arr)).'" value required>';
		echo '<input type="submit" value="Submit" >';
		echo '</form>';
	} else {
		echo '<p>Please go back to modify data again</p>';
	}
	?>
</body>
</html>