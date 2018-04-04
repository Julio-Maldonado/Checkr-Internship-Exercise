<?php 
require_once('data.php');

function ascSort($item1,$item2) {
	$key = $_GET['$key'];
	if ($item1[$key] == $item2[$key])
		return 0;
	return ($item1[$key] > $item2[$key]) ? 1 : -1;
}

if(!empty($_GET['$key'])) {
	$k = $_GET['$key'];
	$sorted_data = $data;
	uasort($sorted_data,'ascSort');
	//print_r($sortedData);
	$json = json_encode($sorted_data, JSON_PRETTY_PRINT);
	echo $json;
} else {
	echo 'Key not specified. Please go back to previous page.';
}

?>