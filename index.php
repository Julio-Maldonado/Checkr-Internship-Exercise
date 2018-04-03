<?php 
include_once("visualizeMap.php"); 

/*
if(!empty($_GET['state'])) {
	// MAKE GET CALL TO FEMA API AND FILTER TO ONLY GET REQUESTED STATE
	//for ($i = 0; $i <= 48000; $i += 1000) { $skip=1000&$top=500
	$i = 1;
	while($i != 0)
		$fema_url = 'https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$filter='.urlencode('state eq \''.strtoupper($_GET['state']).'\'&$skip='.$i;
		$fema_json = file_get_contents($fema_url,true);
		$fema_arr = (json_decode($fema_json,true));
		$i = $fema_arr['metadata']['top'];
		$fema_arr = array_slice($fema_arr,1)['DisasterDeclarationsSummaries'];
		$unique_fema_arr = array_unique_by_key($fema_arr, 'disasterNumber');
		print_r($unique_fema_arr);
		foreach($fema_arr as $item) {
			echo $item["disasterNumber"];
			echo $item["ihProgramDeclared"]."<br/>";
		}
	}
	// USE THIS TO SEE JSON OBJECT IN PRETTY PRINT
//	$json_string = json_encode($fema_arr, JSON_PRETTY_PRINT);
//	echo "<pre>".$json_string."</pre>";
	// READY TO BE PARSED 
/*	$disasterNumber = $fema_arr['DisasterDeclarationsSummaries']['disasterNumber'];
	$ihProgramDeclared = $fema_arr['DisasterDeclarationsSummaries']['ihProgramDeclared'];
	$iaProgramDeclared = $fema_arr['DisasterDeclarationsSummaries']['iaProgramDeclared'];
	$paProgramDeclared = $fema_arr['DisasterDeclarationsSummaries']['paProgramDeclared'];
	$hmProgramDeclared = $fema_arr['DisasterDeclarationsSummaries']['hmProgramDeclared'];
	$declarationDate = $fema_arr['DisasterDeclarationsSummaries']['declarationDate'];
	$fyDeclared = $fema_arr['DisasterDeclarationsSummaries']['fyDeclared'];
	$disasterType =$fema_arr['DisasterDeclarationsSummaries']['disasterType'];
	$incidentType = $fema_arr['DisasterDeclarationsSummaries']['incidentType'];
	$title = $fema_arr['DisasterDeclarationsSummaries']['title'];
	$incidentBeginDate = $fema_arr['DisasterDeclarationsSummaries']['incidentBeginDate'];
	$incidentEndDate = $fema_arr['DisasterDeclarationsSummaries']['incidentEndDate'];
	$disasterCloseOutDate = $fema_arr['DisasterDeclarationsSummaries']['disasterCloseOutDate'];
	$declaredCountyArea = $fema_arr['DisasterDeclarationsSummaries']['declaredCountyArea'];
	$placeCode = $fema_arr['DisasterDeclarationsSummaries']['placeCode'];
	$hash = $fema_arr['DisasterDeclarationsSummaries']['hash'];
	$lastRefresh = $fema_arr['DisasterDeclarationsSummaries']['lastRefresh'];
	$id = $fema_arr['DisasterDeclarationsSummaries']['id'];
*/	// ITERATE THROUGH EVERY ITEM IN JSON AND PARSE NECESSARY DATA
	
//}

?>
