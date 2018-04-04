<?php 
require_once('data.php');
// Sorts array by designated key
function ascSort($item1,$item2) {
	$key = $_GET['$key'];
	if ($item1[$key] == $item2[$key])
		return 0;
	return ($item1[$key] > $item2[$key]) ? 1 : -1;
}

$returned_data = $data;

if(!empty($_GET['$key'])) {
	$k = $_GET['$key'];
	uasort($returned_data,'ascSort');
} 

if(!empty($_GET['$filter'])) {
	$filter = $_GET['$filter'];
	// Create temp array to store filtered arrays from $returned_data
	$temp_data = [];
	/* Iterate through all rows in $returned_data and add that row to 
	   $temp_data if its state matches the requested state */
	foreach($returned_data as $row) {
		if ($row['state'] == $filter) {
			$temp_data[] = $row;
		}
	}
	$returned_data = $temp_data;
}
// Encode $returned_data and print it so the data can be retrieved
$json = json_encode($returned_data, JSON_PRETTY_PRINT);
echo $json;


?>