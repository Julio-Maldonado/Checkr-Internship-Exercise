<?php
/* Set infinite memory limit to allow my universitys server to retreive all 
   data. Usually bad practice, but we know our data set is finite so it is acceptable */
error_reporting(-1); 
ini_set('display_errors', 'On');
ini_set('memory_limit', '-1');

// Open file
$file = fopen('DisasterDeclarationsSummaries.csv','r');
// Initialize $data and the $header which is the first line
$data = [];
$header = fgetcsv($file);
/* Iterate through the file and use array_combine to set $header 
   as the key and each $row as the values */
while ($row = fgetcsv($file)) 
  $data[] = array_combine($header, $row);

?>