<?php

	/**************************************************************
	***********************    Send GPX URL     *******************
	***************************************************************
	****  gpxurl: the url to the gpx file (String) (has to be direct link, no html wrappers like a dropbox link for example)
	****  source: the name of your website or service (String)
	****  output: FALSE if unsuccessfull, TRUE if successfull
	***************************************************************
	****  the route name and description will be extracted from the GPX file
	****  if the GPX contains more routes, tracks and/or waypoints they can all be imported by the user
	**************************************************************/
	function sendToScenicForImport_gpxurl($gpxurl, $source) {
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
	*****  Send Polyline (Google Encoded Polyline Format) *********
	***************************************************************
	****  polyline: Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
	****  name: the name of the route (String)
	****  descr: the description of the route (String)
	****  source: the name of your website or service (String)
	**************************************************************/
	function sendToScenicForImport_polyline($polyline, $name, $descr, $source) {
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
	
    /**************************************************************
    ********************  Send Coordinates ***********************
    **************************************************************
    ****  coordinates: Array of coordinates (Array of associative-arrays with lat and lon as key) E.g. coordinates[0]['lat'] = 32.123456; coordinates[0]['lon'] = 17.654321;
    ****  name: the name of the route (String)
    ****  descr: the description of the route (String)
	****  source: the name of your website or service (String)
	**************************************************************/
	function sendToScenicForImport_coordinates($coordinates, $name, $descr, $source) {
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