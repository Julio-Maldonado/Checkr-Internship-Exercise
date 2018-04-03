<?php

// Found this particular function on StackOverflow and although it doesn't 
// work consistently, it was the only way I was able to surpass 403 error
function http_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if(FALSE === ($retval = curl_exec($ch))) {
        echo curl_error($ch);
    } else {
        return $retval;
    }
}

function get_data_for_state($state) {
  $url = 'https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$filter='.urlencode('state eq \''.strtoupper($state)).'\'&$top=0&$orderby=fyDeclared';
  $arr = json_decode(http_get_contents($url),true);
  $arr = array_slice($arr,1)['DisasterDeclarationsSummaries'];
  return $arr;
}

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

/*  foreach($fema_arr as $item) {
    if ($item["state"] != $state) {
      $state = $item["state"];
    }
    $states_arr[$state]++;
  }*/

if(!empty($_GET['state'])) {
	$data = get_data_for_state($_GET['state']);
//	print_r($data);
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