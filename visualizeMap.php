<?php

// Returns color dependent on how many disasters in specified state
function color_map($state, &$states_arr) {
  if ($states_arr[$state] > 2800)
    return "#191970";
  if ($states_arr[$state] > 2100)
    return "#0000CD";
  if ($states_arr[$state] > 1400)
    return "#4169E1";
  if ($states_arr[$state] > 700)
    return "#4682B4";
  return "#6495ED";
}

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

// Initialize array and get all disasters documented by FEMA
$states_arr = [];
$MAX_DISASTERS = json_decode(http_get_contents('https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$inlinecount=allpages&$top=1'))['metadata']['count'];
for ($i = 0; $i <= $MAX_DISASTERS; $i += 1000) {
  $fema_url = 'https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$skip='.$i.'&$orderby=state';
  $fema_arr = json_decode(http_get_contents($fema_url),true);
  $fema_arr = array_slice($fema_arr,1)['DisasterDeclarationsSummaries'];
  // Increment the states disasters every time the state is seen in the sorted array,
  // else start a new entry and increment that entry
  foreach($fema_arr as $item) {
    if ($item["state"] != $state) {
      $state = $item["state"];
    }
    $states_arr[$state]++;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>USA Map Example</title>
    <script type="text/javascript">
      
var simplemaps_usmap_mapdata={
  main_settings: {
   //General settings
    width: "responsive", //'700' or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",
    popups: "detect",
    
    //State defaults
    state_description: "Click Me To See Filterable Statistics",
    state_color: "#88A4BC",
    state_hover_color: "off",
    state_url: "",
    border_size: 1.5,
    all_states_inactive: "no",
    all_states_zoomable: "no",
    
    //Location defaults
    location_description: "Add location markers using latitude and longitude!",
    location_color: "#2041D4",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_url: "",
    location_size: 25,
    location_type: "square",
    location_border_color: "#FFFFFF",
    location_border: 2,
    location_hover_border: 2.5,
    all_locations_inactive: "no",
    all_locations_hidden: "no",
    
    //Label defaults
    label_color: "#d5ddec",
    label_hover_color: "#808080",
    label_size: 22,
    label_font: "Arial",
    hide_labels: "no",
    hide_eastern_labels: "no",
   
    //Zoom settings
    zoom: "yes",
    back_image: "no",
    initial_back: "no",
    initial_zoom: -1,
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 0.99,
    zoom_time: 0.5,
    
    //Popup settings
    popup_color: "white",
    popup_opacity: 0.9,
    popup_shadow: 1,
    popup_corners: 5,
    popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
    popup_nocss: "no",
    
    //Advanced settings
    div: "map",
    auto_load: "yes",
    url_new_tab: "no",
    fade_time: 0.1,
    import_labels: "no",
    link_text: "View Website",
    state_image_url: "",
    state_image_position: "",
    location_image_url: "",
    border_hover_color: "gray",
    border_hover_size: "3"
  },
  state_specific: {
    HI: {     // Call color_map here to find appropriate color
      color: <?php echo '"'.color_map('HI', $states_arr).'",'; ?>
      name: "Hawaii",
      url: "displayData.php?state=HI"    },
    AK: {
      color: <?php echo '"'.color_map('AK', $states_arr).'",'; ?>
      name: "Alaska",
      url: "displayData.php?state=AK"
    },
    FL: {
      color: <?php echo '"'.color_map('FL', $states_arr).'",'; ?>
      inactive: "no",
      name: "Florida",
      url: "displayData.php?state=FL"
    },
    NH: {
      color: <?php echo '"'.color_map('NH', $states_arr).'",'; ?>
      name: "New Hampshire",
      url: "displayData.php?state=NH"
    },
    VT: {
      color: <?php echo '"'.color_map('VT', $states_arr).'",'; ?>
      name: "Vermont",
      url: "displayData.php?state=VT"
    },
    ME: {
      color: <?php echo '"'.color_map('ME', $states_arr).'",'; ?>
      name: "Maine",
      url: "displayData.php?state=ME"
    },
    RI: {
      color: <?php echo '"'.color_map('RI', $states_arr).'",'; ?>
      name: "Rhode Island",
      url: "displayData.php?state=RI"
    },
    NY: {
      color: <?php echo '"'.color_map('NY', $states_arr).'",'; ?>
      name: "New York",
      url: "displayData.php?state=NY"
    },
    PA: {
      color: <?php echo '"'.color_map('PA', $states_arr).'",'; ?>
      name: "Pennsylvania",
      url: "displayData.php?state=PA"
    },
    NJ: {
      color: <?php echo '"'.color_map('NJ', $states_arr).'",'; ?>
      name: "New Jersey",
      url: "displayData.php?state=NJ"
    },
    DE: {
      color: <?php echo '"'.color_map('DE', $states_arr).'",'; ?>
      name: "Delaware",
      url: "displayData.php?state=DE"
    },
    MD: {
      color: <?php echo '"'.color_map('MD', $states_arr).'",'; ?>
      name: "Maryland",
      url: "displayData.php?state=MD"
    },
    VA: {
      color: <?php echo '"'.color_map('VA', $states_arr).'",'; ?>
      name: "Virginia",
      url: "displayData.php?state=VA"
    },
    WV: {
      color: <?php echo '"'.color_map('WV', $states_arr).'",'; ?>
      name: "West Virginia",
      url: "displayData.php?state=WV"
    },
    OH: {
      color: <?php echo '"'.color_map('OH', $states_arr).'",'; ?>
      name: "Ohio",
      url: "displayData.php?state=OH"
    },
    IN: {
      color: <?php echo '"'.color_map('IN', $states_arr).'",'; ?>
      name: "Indiana",
      url: "displayData.php?state=IN"
    },
    IL: {
      color: <?php echo '"'.color_map('IL', $states_arr).'",'; ?>
      name: "Illinois",
      url: "displayData.php?state=IL"
    },
    CT: {
      color: <?php echo '"'.color_map('CT', $states_arr).'",'; ?>
      name: "Connecticut",
      url: "displayData.php?state=CT"
    },
    WI: {
      color: <?php echo '"'.color_map('WI', $states_arr).'",'; ?>
      name: "Wisconsin",
      url: "displayData.php?state=WI"
    },
    NC: {
      color: <?php echo '"'.color_map('NC', $states_arr).'",'; ?>
      name: "North Carolina",
      url: "displayData.php?state=NC"
    },
    DC: {
      color: <?php echo '"'.color_map('DC', $states_arr).'",'; ?>
      name: "District of Columbia",
      url: "displayData.php?state=DC"
    },
    MA: {
      color: <?php echo '"'.color_map('MA', $states_arr).'",'; ?>
      name: "Massachusetts",
      url: "displayData.php?state=MA"
    },
    TN: {
      color: <?php echo '"'.color_map('TN', $states_arr).'",'; ?>
      name: "Tennessee",
      url: "displayData.php?state=TN"
    },
    AR: {
      color: <?php echo '"'.color_map('AR', $states_arr).'",'; ?>
      name: "Arkansas",
      url: "displayData.php?state=AR"
    },
    MO: {
      color: <?php echo '"'.color_map('MO', $states_arr).'",'; ?>
      name: "Missouri",
      url: "displayData.php?state=MO"
    },
    GA: {
      color: <?php echo '"'.color_map('AG', $states_arr).'",'; ?>
      name: "Georgia",
      url: "displayData.php?state=GA"
    },
    SC: {
      color: <?php echo '"'.color_map('SC', $states_arr).'",'; ?>
      name: "South Carolina",
      url: "displayData.php?state=SC"
    },
    KY: {
      color: <?php echo '"'.color_map('KY', $states_arr).'",'; ?>
      name: "Kentucky",
      url: "displayData.php?state=KY",
      zoomable: "no"
    },
    AL: {
      color: <?php echo '"'.color_map('AL', $states_arr).'",'; ?>
      name: "Alabama",
      url: "displayData.php?state=AL"
    },
    LA: {
      color: <?php echo '"'.color_map('LA', $states_arr).'",'; ?>
      name: "Louisiana",
      url: "displayData.php?state=LA"
    },
    MS: {
      color: <?php echo '"'.color_map('MS', $states_arr).'",'; ?>
      name: "Mississippi",
      url: "displayData.php?state=MS"
    },
    IA: {
      color: <?php echo '"'.color_map('IA', $states_arr).'",'; ?>
      name: "Iowa",
      url: "displayData.php?state=IA"
    },
    MN: {
      color: <?php echo '"'.color_map('MN', $states_arr).'",'; ?>
      name: "Minnesota",
      url: "displayData.php?state=MN"
    },
    OK: {
      color: <?php echo '"'.color_map('OK', $states_arr).'",'; ?>
      name: "Oklahoma",
      url: "displayData.php?state=OK"
    },
    TX: {
      color: <?php echo '"'.color_map('TX', $states_arr).'",'; ?>
      name: "Texas",
      url: "displayData.php?state=TX"
    },
    NM: {
      color: <?php echo '"'.color_map('NM', $states_arr).'",'; ?>
      name: "New Mexico",
      url: "displayData.php?state=NM"
    },
    KS: {
      color: <?php echo '"'.color_map('KS', $states_arr).'",'; ?>
      name: "Kansas",
      url: "displayData.php?state=KS"
    },
    NE: {
      color: <?php echo '"'.color_map('NE', $states_arr).'",'; ?>
      name: "Nebraska",
      url: "displayData.php?state=NE"
    },
    SD: {
      color: <?php echo '"'.color_map('SD', $states_arr).'",'; ?>
      name: "South Dakota",
      url: "displayData.php?state=SD"
    },
    ND: {
      color: <?php echo '"'.color_map('ND', $states_arr).'",'; ?>
      name: "North Dakota",
      url: "displayData.php?state=ND"
    },
    WY: {
      color: <?php echo '"'.color_map('WY', $states_arr).'",'; ?>
      name: "Wyoming",
      url: "displayData.php?state=WY"
    },
    MT: {
      color: <?php echo '"'.color_map('MT', $states_arr).'",'; ?>
      name: "Montana",
      url: "displayData.php?state=MT"
    },
    CO: {
      color: <?php echo '"'.color_map('CO', $states_arr).'",'; ?>
      name: "Colorado",
      url: "displayData.php?state=CO"
    },
    UT: {
      color: <?php echo '"'.color_map('UT', $states_arr).'",'; ?>
      name: "Utah",
      url: "displayData.php?state=UT"
    },
    AZ: {
      color: <?php echo '"'.color_map('AZ', $states_arr).'",'; ?>
      name: "Arizona",
      url: "displayData.php?state=AZ"
    },
    NV: {
      color: <?php echo '"'.color_map('NV', $states_arr).'",'; ?>
      name: "Nevada",
      url: "displayData.php?state=NV"
    },
    OR: {
      color: <?php echo '"'.color_map('OR', $states_arr).'",'; ?>
      name: "Oregon",
      url: "displayData.php?state=OR"
    },
    WA: {
      color: <?php echo '"'.color_map('WA', $states_arr).'",'; ?>
      name: "Washington",
      url: "displayData.php?state=WA"
    },
    CA: {
      color: <?php echo '"'.color_map('CA', $states_arr).'",'; ?>
      name: "California",
      url: "displayData.php?state=CA"
    },
    MI: {
      color: <?php echo '"'.color_map('MI', $states_arr).'",'; ?>
      name: "Michigan",
      url: "displayData.php?state=MI"
    },
    ID: {
      color: <?php echo '"'.color_map('ID', $states_arr).'",'; ?>
      name: "Idaho",
      url: "displayData.php?state=ID"
    },
    GU: {
      color: <?php echo '"'.color_map('GU', $states_arr).'",'; ?>
      hide: "yes",
      name: "Guam",
      url: "displayData.php?state=GU"
    },
    VI: {
      color: <?php echo '"'.color_map('VI', $states_arr).'",'; ?>
      hide: "yes",
      name: "Virgin Islands",
      url: "displayData.php?state=VI"
    },
    PR: {
      color: <?php echo '"'.color_map('PR', $states_arr).'",'; ?>
      hide: "yes",
      name: "Puerto Rico",
      url: "displayData.php?state=PR"
    },
    MP: {
      color: <?php echo '"'.color_map('MP', $states_arr).'",'; ?>
      hide: "yes",
      name: "Northern Mariana Islands",
      url: "displayData.php?state=MP"
    },
    AS: {
      color: <?php echo '"'.color_map('AS', $states_arr).'",'; ?>
      hide: "yes",
      name: "American Samoa",
      url: "displayData.php?state=AS"
    }
  },
  locations: {
    "0": {
      name: "New York City",
      lat: 40.7143528,
      lng: -74.0059731
    },
    "1": {
      name: "Anchorage",
      lat: 61.2180556,
      lng: -149.9002778
    }
  },
  labels: {
    NH: {
      parent_id: "NH",
      x: "932",
      y: "183",
      pill: "yes",
      width: 45,
      display: "all"
    },
    VT: {
      parent_id: "VT",
      x: "883",
      y: "243",
      pill: "yes",
      width: 45,
      display: "all"
    },
    RI: {
      parent_id: "RI",
      x: "932",
      y: "273",
      pill: "yes",
      width: 45,
      display: "all"
    },
    NJ: {
      parent_id: "NJ",
      x: "883",
      y: "273",
      pill: "yes",
      width: 45,
      display: "all"
    },
    DE: {
      parent_id: "DE",
      x: "883",
      y: "303",
      pill: "yes",
      width: 45,
      display: "all"
    },
    MD: {
      parent_id: "MD",
      x: "932",
      y: "303",
      pill: "yes",
      width: 45,
      display: "all"
    },
    DC: {
      parent_id: "DC",
      x: "884",
      y: "332",
      pill: "yes",
      width: 45,
      display: "all"
    },
    MA: {
      parent_id: "MA",
      x: "932",
      y: "213",
      pill: "yes",
      width: 45,
      display: "all"
    },
    CT: {
      parent_id: "CT",
      x: "932",
      y: "243",
      pill: "yes",
      width: 45,
      display: "all"
    },
    HI: {
      parent_id: "HI",
      x: 305,
      y: 565,
      pill: "yes"
    },
    AK: {
      parent_id: "AK",
      x: "113",
      y: "495"
    },
    FL: {
      parent_id: "FL",
      x: "773",
      y: "510"
    },
    ME: {
      parent_id: "ME",
      x: "893",
      y: "85"
    },
    NY: {
      parent_id: "NY",
      x: "815",
      y: "158"
    },
    PA: {
      parent_id: "PA",
      x: "786",
      y: "210"
    },
    VA: {
      parent_id: "VA",
      x: "790",
      y: "282"
    },
    WV: {
      parent_id: "WV",
      x: "744",
      y: "270"
    },
    OH: {
      parent_id: "OH",
      x: "700",
      y: "240"
    },
    IN: {
      parent_id: "IN",
      x: "650",
      y: "250"
    },
    IL: {
      parent_id: "IL",
      x: "600",
      y: "250"
    },
    WI: {
      parent_id: "WI",
      x: "575",
      y: "155"
    },
    NC: {
      parent_id: "NC",
      x: "784",
      y: "326"
    },
    TN: {
      parent_id: "TN",
      x: "655",
      y: "340"
    },
    AR: {
      parent_id: "AR",
      x: "548",
      y: "368"
    },
    MO: {
      parent_id: "MO",
      x: "548",
      y: "293"
    },
    GA: {
      parent_id: "GA",
      x: "718",
      y: "405"
    },
    SC: {
      parent_id: "SC",
      x: "760",
      y: "371"
    },
    KY: {
      parent_id: "KY",
      x: "680",
      y: "300"
    },
    AL: {
      parent_id: "AL",
      x: "655",
      y: "405"
    },
    LA: {
      parent_id: "LA",
      x: "550",
      y: "435"
    },
    MS: {
      parent_id: "MS",
      x: "600",
      y: "405"
    },
    IA: {
      parent_id: "IA",
      x: "525",
      y: "210"
    },
    MN: {
      parent_id: "MN",
      x: "506",
      y: "124"
    },
    OK: {
      parent_id: "OK",
      x: "460",
      y: "360"
    },
    TX: {
      parent_id: "TX",
      x: "425",
      y: "435"
    },
    NM: {
      parent_id: "NM",
      x: "305",
      y: "365"
    },
    KS: {
      parent_id: "KS",
      x: "445",
      y: "290"
    },
    NE: {
      parent_id: "NE",
      x: "420",
      y: "225"
    },
    SD: {
      parent_id: "SD",
      x: "413",
      y: "160"
    },
    ND: {
      parent_id: "ND",
      x: "416",
      y: "96"
    },
    WY: {
      parent_id: "WY",
      x: "300",
      y: "180"
    },
    MT: {
      parent_id: "MT",
      x: "280",
      y: "95"
    },
    CO: {
      parent_id: "CO",
      x: "320",
      y: "275"
    },
    UT: {
      parent_id: "UT",
      x: "223",
      y: "260"
    },
    AZ: {
      parent_id: "AZ",
      x: "205",
      y: "360"
    },
    NV: {
      parent_id: "NV",
      x: "140",
      y: "235"
    },
    OR: {
      parent_id: "OR",
      x: "100",
      y: "120"
    },
    WA: {
      parent_id: "WA",
      x: "130",
      y: "55"
    },
    ID: {
      parent_id: "ID",
      x: "200",
      y: "150"
    },
    CA: {
      parent_id: "CA",
      x: "79",
      y: "285"
    },
    MI: {
      parent_id: "MI",
      x: "663",
      y: "185"
    },
    PR: {
      parent_id: "PR",
      x: "620",
      y: "545"
    },
    GU: {
      parent_id: "GU",
      x: "550",
      y: "540"
    },
    VI: {
      parent_id: "VI",
      x: "680",
      y: "519"
    },
    MP: {
      parent_id: "MP",
      x: "570",
      y: "575"
    },
    AS: {
      parent_id: "AS",
      x: "665",
      y: "580"
    }
  },
  regions: {},
  data: {
    data: {
      HI: "23",
      AK: "50",
      FL: "90",
      NH: "840",
      VT: "1",
      ME: "32",
      RI: "1568",
      NY: "81",
      PA: "489",
      NJ: "16",
      DE: "234",
      MD: "98",
      VA: "23",
      WV: "50",
      OH: "90",
      IN: "840",
      IL: "1",
      CT: "32",
      WI: "1568",
      NC: "81",
      DC: "489",
      MA: "16",
      TN: "234",
      AR: "98",
      MO: "23",
      GA: "50",
      SC: "90",
      KY: "840",
      AL: "1",
      LA: "32",
      MS: "1568",
      IA: "81",
      MN: "489",
      OK: "16",
      TX: "234",
      NM: "98",
      KS: "23",
      NE: "50",
      SD: "90",
      ND: "840",
      WY: "1",
      MT: "32",
      CO: "1568",
      UT: "81",
      AZ: "489",
      NV: "16",
      OR: "234",
      WA: "98",
      CA: "23",
      MI: "50",
      ID: "90",
      GU: "840",
      VI: "1",
      PR: "32",
      MP: "1568",
      AS: "81"
    }
  }
};
    </script>
    <script src="usmap.js"></script>
    <style>
      #mapDiv {
        height: 75%;
        width: 75%;
      }
    </style>
  </head>
  <body>
  <h1>HTML5/Javascript USA Map</h1>
    <div id="mapDiv">
    <div id="map"></div>
    </div>
    <style type="text/css">
.legend{color: black; width: 100%; font-family: arial; font-size: 14px;}    
.legend_color {display: table; width: 100%; background: white; list-style: none; margin: 0px; padding: 0px; }
.legend_color li{width: 20%;  height: 20px; display: table-cell;}
.legend_label {display: table; width: 100%;  padding: 0px; padding-left: 10%; padding-right: 10%; list-style: none; margin: 0px; box-sizing: border-box;}
.legend_label li{width: 25%;  height: 20px; display: table-cell; text-align: center;}
</style>
<div class="legend">
  <ul class="legend_label">
    <li>700</li><li>1400</li><li>2100</li><li>2800</li>
  </ul>
  <ul class="legend_color">
    <li style="background-color: #6495ED"></li><li style="background-color: #4682B4"></li><li style="background-color: #4169E1"></li><li style="background-color: #0000CD"></li><li style="background-color: #191970"></li>
  </ul>
</div>      
      <p>This map was created and can be edited at <a href="http://simplemaps.com/custom/us/SFRXcTHp">http://simplemaps.com/custom/us/SFRXcTHp</a>
    
    
      <p>To remove the "Simplemaps.com Trial" text, <a href="http://simplemaps.com/pricing" />purchase a map license</a>.  
      
      Then, register your license at the link above (Options > Register Purchase).  Or, simply replace the usmap.js file in this folder (trial version) with the usmap.js file that you are emailed (full version).
      
      </p>
    
    <p>To learn how to install this map on your web page, see the <a href="http://simplemaps.com/docs">Documentation</a>.</p>
  </body>
</html>