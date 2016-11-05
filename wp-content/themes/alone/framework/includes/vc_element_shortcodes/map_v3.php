<?php
vc_map(array(
    "name" => 'Google Maps V3',
    "base" => "maps",
    "category" => __('Extra Elements', 'bearsthemes'),
	"icon" => "tb-icon-for-vc",
    "description" => __('Google Maps API V3', 'bearsthemes'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __('API Key', 'bearsthemes'),
            "param_name" => "api",
            "value" => '',
            "description" => __('Enter you api key of map, get key from (https://console.developers.google.com)', 'bearsthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Address', 'bearsthemes'),
            "param_name" => "address",
            "value" => 'New York, United States',
            "description" => __('Enter address of Map', 'bearsthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Coordinate', 'bearsthemes'),
            "param_name" => "coordinate",
            "value" => '',
            "description" => __('Enter coordinate of Map, format input (latitude, longitude)', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Click Show Info window', 'bearsthemes'),
            "param_name" => "infoclick",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Marker", 'bearsthemes'),
            "description" => __('Click a marker and show info window (Default Show).', 'bearsthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Coordinate', 'bearsthemes'),
            "param_name" => "markercoordinate",
            "value" => '',
            "group" => __("Marker", 'bearsthemes'),
            "description" => __('Enter marker coordinate of Map, format input (latitude, longitude)', 'bearsthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Title', 'bearsthemes'),
            "param_name" => "markertitle",
            "value" => '',
            "group" => __("Marker", 'bearsthemes'),
            "description" => __('Enter Title Info windows for marker', 'bearsthemes')
        ),
        array(
            "type" => "textarea",
            "heading" => __('Marker Description', 'bearsthemes'),
            "param_name" => "markerdesc",
            "value" => '',
            "group" => __("Marker", 'bearsthemes'),
            "description" => __('Enter Description Info windows for marker', 'bearsthemes')
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Marker Icon', 'bearsthemes'),
            "param_name" => "markericon",
            "value" => '',
            "group" => __("Marker", 'bearsthemes'),
            "description" => __('Select image icon for marker', 'bearsthemes')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __('Marker List', 'bearsthemes'),
            "param_name" => "markerlist",
            "value" => '',
            "group" => __("Multiple Marker", 'bearsthemes'),
            "description" => __('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'bearsthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Info Window Max Width', 'bearsthemes'),
            "param_name" => "infowidth",
            "value" => '200',
            "group" => __("Marker", 'bearsthemes'),
            "description" => __('Set max width for info window', 'bearsthemes')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'bearsthemes'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => __('Select the map type.', 'bearsthemes')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style Template", 'bearsthemes'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Subtle Grayscale" => "Subtle-Grayscale",
                "Shades of Grey" => "Shades-of-Grey",
                "Blue water" => "Blue-water",
                "Pale Dawn" => "Pale-Dawn",
                "Blue Essence" => "Blue-Essence",
                "Apple Maps-esque" => "Apple-Maps-esque",
            ),
            "group" => __("Map Style", 'bearsthemes'),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textfield",
            "heading" => __('Zoom', 'bearsthemes'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => __('zoom level of map, default is 13', 'bearsthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Width', 'bearsthemes'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => __('Width of map without pixel, default is auto', 'bearsthemes')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Height', 'bearsthemes'),
            "param_name" => "height",
            "value" => '350px',
            "description" => __('Height of map without pixel, default is 350px', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scroll Wheel', 'bearsthemes'),
            "param_name" => "scrollwheel",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Controls", 'bearsthemes'),
            "description" => __('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Pan Control', 'bearsthemes'),
            "param_name" => "pancontrol",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Controls", 'bearsthemes'),
            "description" => __('Show or hide Pan control.', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Zoom Control', 'bearsthemes'),
            "param_name" => "zoomcontrol",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Controls", 'bearsthemes'),
            "description" => __('Show or hide Zoom Control.', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scale Control', 'bearsthemes'),
            "param_name" => "scalecontrol",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Controls", 'bearsthemes'),
            "description" => __('Show or hide Scale Control.', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Map Type Control', 'bearsthemes'),
            "param_name" => "maptypecontrol",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Controls", 'bearsthemes'),
            "description" => __('Show or hide Map Type Control.', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Street View Control', 'bearsthemes'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Controls", 'bearsthemes'),
            "description" => __('Show or hide Street View Control.', 'bearsthemes')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Over View Map Control', 'bearsthemes'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                __("Yes, please", 'bearsthemes') => true
            ),
            "group" => __("Controls", 'bearsthemes'),
            "description" => __('Show or hide Over View Map Control.', 'bearsthemes')
        )
    )
));