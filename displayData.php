<?php

// Gets the data for the requested state and returns it sorted by fyDeclared
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

if(!empty($_GET['state'])) {
	$data = get_data_for_state($_GET['state']);
	$year_graph_arr = get_data_for_graph($data,'fyDeclared');	
} else {
	$year_graph_arr = [];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data for Selected State</title>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
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
	            chart: {
			        title: 'Graph of Selected State',
			    },
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
</body>
</html>