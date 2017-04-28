<?php

	/**************************************************************
	**************   Send GPX URL for IMPORT    *******************
	***************************************************************
	****  gpxurl (required): the url to the gpx file (String) (has to be direct link, no html wrappers like a dropbox link for example)
	****  source (optional): the name of your website or service (String)
	***************************************************************
	****  the route name and description will be extracted from the GPX file
	****  if the GPX contains more routes, tracks and/or waypoints they can all be imported by the user
	**************************************************************/
	function sendToScenicForImport_gpxurl($gpxurl, $source = "") {
		header('Content-Type: text/html; charset=utf-8');
		echo '<html><body>
		<form name="redirect" method="post" action="https://scenicapp.space/api/import/gpxurl" style="display: none">
			<input type="hidden" name="gpxurl" value="'.$gpxurl.'" />
			<input type="hidden" name="source" value="'.$source.'" />
			<input type="submit" value="Submit" />
		</form>
		<script>document.forms["redirect"].submit();</script>
		</body></html>';
		
	}
	
	/**************************************************************
	*****               Send Polyline for IMPORT          *********
	***************************************************************
	****  polyline (required): Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
	****  name (optional): the name of the route (String)
	****  descr (optional): the description of the route (String)
	****  source (optional): the name of your website or service (String)
	**************************************************************/
	function sendToScenicForImport_polyline($polyline, $name = "", $descr = "", $source ="") {
		header('Content-Type: text/html; charset=utf-8');
		echo '<html><body>
		<form name="redirect" method="post" action="https://scenicapp.space/api/import/polyline" style="display: none">
			<input type="hidden" name="polyline" value="'.$polyline.'" />
			<input type="hidden" name="source" value="'.$source.'" />
			<input type="hidden" name="name" value="'.$name.'" />
			<input type="hidden" name="descr" value="'.$descr.'" />
			<input type="submit" value="Submit" />
		</form>
		<script>document.forms["redirect"].submit();</script>
		</body></html>';
	}
	
    /*************************************************************
    ************       Send Coordinates for IMPORT      **********
    **************************************************************
    ****  coordinates: Array of coordinates (Array of associative-arrays with lat and lon as key) E.g. coordinates[0]['lat'] = 32.123456; coordinates[0]['lon'] = 17.654321;
    ****  name: the name of the route (String)
    ****  descr: the description of the route (String)
	****  source: the name of your website or service (String)
	**************************************************************/
	function sendToScenicForImport_coordinates($coordinates, $name = "", $descr = "", $source ="") {
		header('Content-Type: text/html; charset=utf-8');
		echo '<html><body>
		<form name="redirect" method="post" action="https://scenicapp.space/api/import/coordinates" style="display: none">
			<input type="hidden" name="coordinates" value="'.stringOfCoordinatesArray($coordinates).'" />
			<input type="hidden" name="source" value="'.$source.'" />
			<input type="hidden" name="name" value="'.$name.'" />
			<input type="hidden" name="descr" value="'.$descr.'" />
			<input type="submit" value="Submit" />
		</form>
		<script>document.forms["redirect"].submit();</script>
		</body></html>';
	}
	
	/**************************************************************
	*****          Send Polyline for NAVIGATION           *********
	***************************************************************
	****  polyline (Required): Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
	****  the polyline has to contain at least 2 coordinates and at the most 200 coordinates
	****  name (Optional): the name of the route (String)
	****  routeMode (Optional): F for Fastest, S for Shortest, E for Efficient, C for Curvy (Defaults to F)
	****  vehicleType (Optional): C for Car/Motorcycle, B for Bicycle, P for Pedestrian (Defaults to C)
	**************************************************************/
	function sendToScenicForNavigation_polyline($polyline, $name = "", $routeMode = "F", $vehicleType = "C") {
		header('Content-Type: text/html; charset=utf-8');
		echo '<html><body>
		<form name="redirect" method="post" action="https://scenicapp.space/api/navigate/polyline" style="display: none">
			<input type="hidden" name="polyline" value="'.$polyline.'" />
			<input type="hidden" name="name" value="'.$name.'" />
			<input type="hidden" name="routeMode" value="'.$routeMode.'" />
			<input type="hidden" name="vehicleType" value="'.$vehicleType.'" />
			<input type="submit" value="Submit" />
		</form>
		<script>document.forms["redirect"].submit();</script>
		</body></html>';
	}
	
    /**************************************************************
    ***************  Send Coordinates for NAVIGATION *************
    **************************************************************
    ****  coordinates (Required): Array of coordinates (Array of associative-arrays with lat and lon as key) E.g. coordinates[0]['lat'] = 32.123456; coordinates[0]['lon'] = 17.654321;
	****  - 6 digits precision for the lat and lon components is sufficient
	****  - there should be at least 2 coordinate and at the most 200 coordinates
	****  name (Optional): the name of the route (String)
	****  routeMode (Optional): F for Fastest, S for Shortest, E for Efficient, C for Curvy (Defaults to F)
	****  vehicleType (Optional): C for Car/Motorcycle, B for Bicycle, P for Pedestrian (Defaults to C)
	**************************************************************/
	function sendToScenicForNavigation_coordinates($coordinates, $name = "", $routeMode = "F", $vehicleType = "C") {
		header('Content-Type: text/html; charset=utf-8');
		echo '<html><body>
		<form name="redirect" method="post" action="https://scenicapp.space/api/navigate/coordinates" style="display: none">
			<input type="hidden" name="coordinates" value="'.stringOfCoordinatesArray($coordinates).'" />
			<input type="hidden" name="name" value="'.$name.'" />
			<input type="hidden" name="routeMode" value="'.$routeMode.'" />
			<input type="hidden" name="vehicleType" value="'.$vehicleType.'" />
			<input type="submit" value="Submit" />
		</form>
		<script>document.forms["redirect"].submit();</script>
		</body></html>';
	}
	
	
	/**************************************************************
    ***************  Send Single Coordinate for NAVIGATION *************
    **************************************************************
    ****  coordinate (required): Associative-array with lat and lon as key, E.g. coordinate['lat'] = 32.123456; coordinates['lon'] = 17.654321;
	****  - 6 digits precision for the lat and lon components is sufficient	
	****  name (optional): the name of the location (String)
	**************************************************************/
	function sendToScenicForNavigation_coordinate($coordinate, $name = "") {
		header('Content-Type: text/html; charset=utf-8');
		echo '<html><body>
		<form name="redirect" method="post" action="https://scenicapp.space/api/navigate/coordinate" style="display: none">
			<input type="hidden" name="coordinate" value="'.round($coordinate['lat'], 6).','.round($coordinate['lon'], 6).'" />
			<input type="hidden" name="name" value="'.$name.'" />
			<input type="submit" value="Submit" />
		</form>
		<script>document.forms["redirect"].submit();</script>
		</body></html>';
	}
	
	
	
	
	
	 /**************************************************************
     ***********************    Helper Functions     **************
     *************************************************************/
    function stringOfCoordinatesArray($coordinates) {
        $str = "";
        foreach ($coordinates as $coordinate) {
            $str .= round($coordinate['lat'], 6).",".round($coordinate['lon'], 6)."|";
        }
        return rtrim($str, "|");
    }
	

	
?>