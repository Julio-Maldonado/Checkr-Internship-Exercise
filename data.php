<?php
error_reporting(-1); 
ini_set('display_errors', 'On');
ini_set('memory_limit', '-1');
$file = fopen('DisasterDeclarationsSummaries.csv','r');
// Code obtained from https://stackoverflow.com/questions/10181054/process-csv-into-array-with-column-headings-for-key
$data = [];
$header = fgetcsv($file);
while ($row = fgetcsv($file)) {
  $data[] = array_combine($header, $row);
}
//print_r($data);
?>