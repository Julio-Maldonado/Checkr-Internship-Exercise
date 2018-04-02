var simplemaps_usmap_mapdata={
  main_settings: {
   //General settings
    width: "responsive", //'700' or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",
    popups: "detect",
    
    //State defaults
    state_description: "State Description",
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
    label_hover_color: "#d5ddec",
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
  state_specific: { // USE PHP TO MODIFY COLOR VALUES ACCORDING TO FEMA API RESPONSE
    HI: {
      color: "#005399",
      name: "Hawaii"
    },
    AK: {
      color: "#006ecc",
      name: "Alaska"
    },
    FL: {
      color: "#66b9ff",
      inactive: "no",
      name: "Florida"
    },
    NH: {
      color: "#005399",
      name: "New Hampshire"
    },
    VT: {
      color: "#005399",
      name: "Vermont"
    },
    ME: {
      color: "#006ecc",
      name: "Maine"
    },
    RI: {
      color: "#005399",
      name: "Rhode Island"
    },
    NY: {
      color: "#008aff",
      name: "New York"
    },
    PA: {
      color: "#66b9ff",
      name: "Pennsylvania"
    },
    NJ: {
      color: "#006ecc",
      name: "New Jersey"
    },
    DE: {
      color: "#33a1ff",
      name: "Delaware"
    },
    MD: {
      color: "#33a1ff",
      name: "Maryland"
    },
    VA: {
      color: "#008aff",
      name: "Virginia"
    },
    WV: {
      color: "#33a1ff",
      name: "West Virginia"
    },
    OH: {
      color: "#008aff",
      name: "Ohio"
    },
    IN: {
      color: "#008aff",
      name: "Indiana"
    },
    IL: {
      color: "#33a1ff",
      name: "Illinois"
    },
    CT: {
      color: "#66b9ff",
      name: "Connecticut"
    },
    WI: {
      color: "#005399",
      name: "Wisconsin"
    },
    NC: {
      color: "#006ecc",
      name: "North Carolina"
    },
    DC: {
      color: "#66b9ff",
      name: "District of Columbia"
    },
    MA: {
      color: "#005399",
      name: "Massachusetts"
    },
    TN: {
      color: "#005399",
      name: "Tennessee"
    },
    AR: {
      color: "#006ecc",
      name: "Arkansas"
    },
    MO: {
      color: "#005399",
      name: "Missouri"
    },
    GA: {
      color: "#008aff",
      name: "Georgia"
    },
    SC: {
      color: "#66b9ff",
      name: "South Carolina"
    },
    KY: {
      color: "#006ecc",
      name: "Kentucky",
      zoomable: "no"
    },
    AL: {
      color: "#33a1ff",
      name: "Alabama"
    },
    LA: {
      color: "#33a1ff",
      name: "Louisiana"
    },
    MS: {
      color: "#008aff",
      name: "Mississippi"
    },
    IA: {
      color: "#33a1ff",
      name: "Iowa"
    },
    MN: {
      color: "#008aff",
      name: "Minnesota"
    },
    OK: {
      color: "#008aff",
      name: "Oklahoma"
    },
    TX: {
      color: "#33a1ff",
      name: "Texas"
    },
    NM: {
      color: "#66b9ff",
      name: "New Mexico"
    },
    KS: {
      color: "#005399",
      name: "Kansas"
    },
    NE: {
      color: "#006ecc",
      name: "Nebraska"
    },
    SD: {
      color: "#66b9ff",
      name: "South Dakota"
    },
    ND: {
      color: "#005399",
      name: "North Dakota"
    },
    WY: {
      color: "#005399",
      name: "Wyoming"
    },
    MT: {
      color: "#006ecc",
      name: "Montana"
    },
    CO: {
      color: "#005399",
      name: "Colorado"
    },
    UT: {
      color: "#008aff",
      name: "Utah"
    },
    AZ: {
      color: "#66b9ff",
      name: "Arizona"
    },
    NV: {
      color: "#006ecc",
      name: "Nevada"
    },
    OR: {
      color: "#33a1ff",
      name: "Oregon"
    },
    WA: {
      color: "#33a1ff",
      name: "Washington"
    },
    CA: {
      color: "#008aff",
      name: "California"
    },
    MI: {
      color: "#33a1ff",
      name: "Michigan"
    },
    ID: {
      color: "#008aff",
      name: "Idaho"
    },
    GU: {
      color: "#008aff",
      hide: "yes",
      name: "Guam"
    },
    VI: {
      color: "#33a1ff",
      hide: "yes",
      name: "Virgin Islands"
    },
    PR: {
      color: "#66b9ff",
      hide: "yes",
      name: "Puerto Rico"
    },
    MP: {
      color: "#005399",
      hide: "yes",
      name: "Northern Mariana Islands"
    },
    AS: {
      color: "#005399",
      hide: "yes",
      name: "American Samoa"
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
  regions: {}
};