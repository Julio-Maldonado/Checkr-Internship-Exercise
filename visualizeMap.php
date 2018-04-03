<?php
// Returns unique values in array by a key
function array_unique_by_key (&$array, $key) {
    $tmp = array();
    $result = array();
    foreach ($array as $value) {
        if (!in_array($value[$key], $tmp)) {
            array_push($tmp, $value[$key]);
            array_push($result, $value);
        }
    }
    return $array = $result;
}
// Returns color dependent on how many disasters in specified state
function color_map($state, &$states_arr) {
  if ($states_arr[$state] > 3500)
    return "#191970";
  if ($states_arr[$state] > 2500)
    return "#0000CD";
  if ($states_arr[$state] > 2000)
    return "#4169E1";
  if ($states_arr[$state] > 1500)
    return "#4682B4";
  if ($states_arr[$state] > 1000)
    return "#87CEEB";
  if ($states_arr[$state] > 500)
    return "#B0E0E6";
  return "#F0F8FF";
}
// Initialize array and get all >48000 disasters documented by FEMA
$states_arr = [];
for ($i = 0; $i <= 48000; $i += 1000) {
  $fema_url = 'https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$skip='.$i.'&$orderby=state';
  $fema_arr = json_decode(file_get_contents($fema_url,true),true);
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

/*
*** This should return all JSON objects, but I believe the request is too large
*** to work on my school's server...try later when deployed as Heroku/PHP app
$fema_url = 'https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$top=0&$orderby=state';
$fema_arr = json_decode(file_get_contents($fema_url,true),true);
$fema_arr = array_slice($fema_arr,1)['DisasterDeclarationsSummaries'];
foreach($fema_arr as $item) {
  if ($item["state"] != $state) {
    $state = $item["state"];
  }
  $states_arr[$state]++;
}
*/
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
    state_description: "Data value is #data#",
    state_color: "#88A4BC",
    state_hover_color: "off",
    state_url: "",
    border_size: 1.5,
    all_states_inactive: "no",
    all_states_zoomable: "yes",
    
    //Location defaults
    location_description: "Add location markers using latitude and longitude!",
    location_color: "#2041D4",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_url: "",
    location_size: 25,
    location_type: "square",
    location_image_source: "frog.png",
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
    url_new_tab: "yes",
    images_directory: "/static/lib/simplemaps/map_images/",
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
      description: "Data value is 23"
    },
    AK: {
      color: <?php echo '"'.color_map('AK', $states_arr).'",'; ?>
      name: "Alaska",
      description: "Data value is 50"
    },
    FL: {
      color: <?php echo '"'.color_map('FL', $states_arr).'",'; ?>
      inactive: "no",
      name: "Florida",
      description: "Data value is 90"
    },
    NH: {
      color: <?php echo '"'.color_map('NH', $states_arr).'",'; ?>
      name: "New Hampshire",
      description: "Data value is 840"
    },
    VT: {
      color: <?php echo '"'.color_map('VT', $states_arr).'",'; ?>
      name: "Vermont",
      description: "Data value is 1"
    },
    ME: {
      color: <?php echo '"'.color_map('ME', $states_arr).'",'; ?>
      name: "Maine",
      description: "Data value is 32"
    },
    RI: {
      color: <?php echo '"'.color_map('RI', $states_arr).'",'; ?>
      name: "Rhode Island",
      description: "Data value is 1568"
    },
    NY: {
      color: <?php echo '"'.color_map('NY', $states_arr).'",'; ?>
      name: "New York",
      description: "Data value is 81"
    },
    PA: {
      color: <?php echo '"'.color_map('PA', $states_arr).'",'; ?>
      name: "Pennsylvania",
      description: "Data value is 489"
    },
    NJ: {
      color: <?php echo '"'.color_map('NJ', $states_arr).'",'; ?>
      name: "New Jersey",
      description: "Data value is 16"
    },
    DE: {
      color: <?php echo '"'.color_map('DE', $states_arr).'",'; ?>
      name: "Delaware",
      description: "Data value is 234"
    },
    MD: {
      color: <?php echo '"'.color_map('MD', $states_arr).'",'; ?>
      name: "Maryland",
      description: "Data value is 98"
    },
    VA: {
      color: <?php echo '"'.color_map('VA', $states_arr).'",'; ?>
      name: "Virginia",
      description: "Data value is 23"
    },
    WV: {
      color: <?php echo '"'.color_map('WV', $states_arr).'",'; ?>
      name: "West Virginia",
      description: "Data value is 50"
    },
    OH: {
      color: <?php echo '"'.color_map('OH', $states_arr).'",'; ?>
      name: "Ohio",
      description: "Data value is 90"
    },
    IN: {
      color: <?php echo '"'.color_map('IN', $states_arr).'",'; ?>
      name: "Indiana",
      description: "Data value is 840"
    },
    IL: {
      color: <?php echo '"'.color_map('IL', $states_arr).'",'; ?>
      name: "Illinois",
      description: "Data value is 1"
    },
    CT: {
      color: <?php echo '"'.color_map('CT', $states_arr).'",'; ?>
      name: "Connecticut",
      description: "Data value is 32"
    },
    WI: {
      color: <?php echo '"'.color_map('WI', $states_arr).'",'; ?>
      name: "Wisconsin",
      description: "Data value is 1568"
    },
    NC: {
      color: <?php echo '"'.color_map('NC', $states_arr).'",'; ?>
      name: "North Carolina",
      description: "Data value is 81"
    },
    DC: {
      color: <?php echo '"'.color_map('DC', $states_arr).'",'; ?>
      name: "District of Columbia",
      description: "Data value is 489"
    },
    MA: {
      color: <?php echo '"'.color_map('MA', $states_arr).'",'; ?>
      name: "Massachusetts",
      description: "Data value is 16"
    },
    TN: {
      color: <?php echo '"'.color_map('TN', $states_arr).'",'; ?>
      name: "Tennessee",
      description: "Data value is 234"
    },
    AR: {
      color: <?php echo '"'.color_map('AR', $states_arr).'",'; ?>
      name: "Arkansas",
      description: "Data value is 98"
    },
    MO: {
      color: <?php echo '"'.color_map('MO', $states_arr).'",'; ?>
      name: "Missouri",
      description: "Data value is 23"
    },
    GA: {
      color: <?php echo '"'.color_map('AG', $states_arr).'",'; ?>
      name: "Georgia",
      description: "Data value is 50"
    },
    SC: {
      color: <?php echo '"'.color_map('SC', $states_arr).'",'; ?>
      name: "South Carolina",
      description: "Data value is 90"
    },
    KY: {
      color: <?php echo '"'.color_map('KY', $states_arr).'",'; ?>
      description: "Data value is 840",
      name: "Kentucky",
      zoomable: "no"
    },
    AL: {
      color: <?php echo '"'.color_map('AL', $states_arr).'",'; ?>
      name: "Alabama",
      description: "Data value is 1"
    },
    LA: {
      color: <?php echo '"'.color_map('LA', $states_arr).'",'; ?>
      name: "Louisiana",
      description: "Data value is 32"
    },
    MS: {
      color: <?php echo '"'.color_map('MS', $states_arr).'",'; ?>
      name: "Mississippi",
      description: "Data value is 1568"
    },
    IA: {
      color: <?php echo '"'.color_map('IA', $states_arr).'",'; ?>
      name: "Iowa",
      description: "Data value is 81"
    },
    MN: {
      color: <?php echo '"'.color_map('MN', $states_arr).'",'; ?>
      name: "Minnesota",
      description: "Data value is 489"
    },
    OK: {
      color: <?php echo '"'.color_map('OK', $states_arr).'",'; ?>
      name: "Oklahoma",
      description: "Data value is 16"
    },
    TX: {
      color: <?php echo '"'.color_map('TX', $states_arr).'",'; ?>
      name: "Texas",
      description: "Data value is 234"
    },
    NM: {
      color: <?php echo '"'.color_map('NM', $states_arr).'",'; ?>
      name: "New Mexico",
      description: "Data value is 98"
    },
    KS: {
      color: <?php echo '"'.color_map('KS', $states_arr).'",'; ?>
      name: "Kansas",
      description: "Data value is 23"
    },
    NE: {
      color: <?php echo '"'.color_map('NE', $states_arr).'",'; ?>
      name: "Nebraska",
      description: "Data value is 50"
    },
    SD: {
      color: <?php echo '"'.color_map('SD', $states_arr).'",'; ?>
      name: "South Dakota",
      description: "Data value is 90"
    },
    ND: {
      color: <?php echo '"'.color_map('ND', $states_arr).'",'; ?>
      name: "North Dakota",
      description: "Data value is 840"
    },
    WY: {
      color: <?php echo '"'.color_map('WY', $states_arr).'",'; ?>
      name: "Wyoming",
      description: "Data value is 1"
    },
    MT: {
      color: <?php echo '"'.color_map('MT', $states_arr).'",'; ?>
      name: "Montana",
      description: "Data value is 32"
    },
    CO: {
      color: <?php echo '"'.color_map('CO', $states_arr).'",'; ?>
      name: "Colorado",
      description: "Data value is 1568"
    },
    UT: {
      color: <?php echo '"'.color_map('UT', $states_arr).'",'; ?>
      name: "Utah",
      description: "Data value is 81"
    },
    AZ: {
      color: <?php echo '"'.color_map('AZ', $states_arr).'",'; ?>
      name: "Arizona",
      description: "Data value is 489"
    },
    NV: {
      color: <?php echo '"'.color_map('NV', $states_arr).'",'; ?>
      name: "Nevada",
      description: "Data value is 16"
    },
    OR: {
      color: <?php echo '"'.color_map('OR', $states_arr).'",'; ?>
      name: "Oregon",
      description: "Data value is 234"
    },
    WA: {
      color: <?php echo '"'.color_map('WA', $states_arr).'",'; ?>
      name: "Washington",
      description: "Data value is 98"
    },
    CA: {
      color: <?php echo '"'.color_map('CA', $states_arr).'",'; ?>
      name: "California",
      description: "Data value is 23"
    },
    MI: {
      color: <?php echo '"'.color_map('MI', $states_arr).'",'; ?>
      name: "Michigan",
      description: "Data value is 50"
    },
    ID: {
      color: <?php echo '"'.color_map('ID', $states_arr).'",'; ?>
      name: "Idaho",
      description: "Data value is 90"
    },
    GU: {
      color: <?php echo '"'.color_map('GU', $states_arr).'",'; ?>
      hide: "yes",
      name: "Guam",
      description: "Data value is 840"
    },
    VI: {
      color: <?php echo '"'.color_map('VI', $states_arr).'",'; ?>
      hide: "yes",
      name: "Virgin Islands",
      description: "Data value is 1"
    },
    PR: {
      color: <?php echo '"'.color_map('PR', $states_arr).'",'; ?>
      hide: "yes",
      name: "Puerto Rico",
      description: "Data value is 32"
    },
    MP: {
      color: <?php echo '"'.color_map('MP', $states_arr).'",'; ?>
      hide: "yes",
      name: "Northern Mariana Islands",
      description: "Data value is 1568"
    },
    AS: {
      color: <?php echo '"'.color_map('AS', $states_arr).'",'; ?>
      hide: "yes",
      name: "American Samoa",
      description: "Data value is 81"
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
  </head>
  <body>
  <h1>HTML5/Javascript USA Map</h1>
    <div id="map"></div>
    <style type="text/css">
.legend{color: black; width: 100%; font-family: arial; font-size: 14px;}    
.legend_color {display: table; width: 100%; background: white; list-style: none; margin: 0px; padding: 0px; }
.legend_color li{width: 20%;  height: 20px; display: table-cell;}
.legend_label {display: table; width: 100%;  padding: 0px; padding-left: 10%; padding-right: 10%; list-style: none; margin: 0px; box-sizing: border-box;}
.legend_label li{width: 25%;  height: 20px; display: table-cell; text-align: center;}
</style>
<div class="legend">
  <ul class="legend_label">
    <li>23</li><li>50</li><li>90</li><li>489</li>
  </ul>
  <ul class="legend_color">
    <li style="background-color: #66c7ff"></li><li style="background-color: #33b5ff"></li><li style="background-color: #00a2ff"></li><li style="background-color: #0082cc"></li><li style="background-color: #006199"></li>
  </ul>
</div>
    
      <p>This map was created and can be edited at <a href="http://simplemaps.com/custom/us/SFRXcTHp">http://simplemaps.com/custom/us/SFRXcTHp</a>
    
    
      <p>To remove the "Simplemaps.com Trial" text, <a href="http://simplemaps.com/pricing" />purchase a map license</a>.  
      
      Then, register your license at the link above (Options > Register Purchase).  Or, simply replace the usmap.js file in this folder (trial version) with the usmap.js file that you are emailed (full version).
      
      </p>
    
    <p>To learn how to install this map on your web page, see the <a href="http://simplemaps.com/docs">Documentation</a>.</p>
  </body>
</html>