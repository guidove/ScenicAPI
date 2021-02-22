/******************************
*****   Helper Function   *****
/*****************************/
function roundToSix(num) {    
    return +(Math.round(num + "e+6")  + "e-6");
}

function stringOfCoordinatesArray(coordinates) {
    var str = "";
    coordinates.forEach(function(coordinate){
	    str += roundToSix(coordinate[0]).toFixed(6) + "," + roundToSix(coordinate[1]).toFixed(6) + "|";
    })
    return str.substr(0, str.length -1);
}

function stringOfStringArray(strings) {
	var str = "";
	strings.forEach(function(strng){
		str += strng.replace("|", "") + "|";
	})
	return str.substr(0, str.length -1);
}

function post(path, params) {
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}



/**************************************************************
**************   Send GPX URL for IMPORT    *******************
***************************************************************
****  gpxurl (required): the url to the gpx file (String) (has to be direct link, no html wrappers like a dropbox link for example)
****  source (optional): the name of your website or service (String)
***************************************************************
****  the route name and description will be extracted from the GPX file
****  if the GPX contains more routes, tracks and/or waypoints they can all be imported by the user
**************************************************************/
function sendToScenicForImport_gpxurl(gpxurl, source = "") {
	var params = [];
	params["source"] = source;
	params["gpxurl"] = gpxurl;
	post("https://scenicapp.space/api/import/gpxurl", params);
}


/**************************************************************
*****               Send Polyline for IMPORT          *********
***************************************************************
****  polyline (required): Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
****  waypointKinds: (optional): An array of strings, where the strings represent the waypointKind, which is either "via" or "stop". The array should contain the same amount of elements as there are coordinates. A via is a shaping point to force the route along that point. User is not alerted when reaching a via and vias can be ignored upon recalculation. A stop is a special kind of via. User will get alerts when nearing a via point and stops are not ignored upon recalculation. Route begin and end point are stops. E.g. var waypointKinds = ["stop","via","via","via","stop","via","stop"]
****  waypointNames: (optional): An array of strings, where the strings represent the waypointName. The number of names needs to match the number of coordinates. P.S. If a waypoint does not have a name an empty string should be included. If a name has a pipe character it will be removed from the name. E.g. var waypointNames = ["Route start","","","","Lunch Place","","Route endpoint"]
****  name: (optional): the route name (String)
****  descr (optional): the description of the route (String)
****  source (optional): the name of your website or service (String)
**************************************************************/
function sendToScenicForImport_polyline(polyline, waypointKinds = [], waypointNames = [], name = "", descr = "", source = "") {
	var params = [];
	params["source"] = source;
	params["polyline"] = polyline;
	params["waypointKinds"] = stringOfStringArray(waypointKinds);
	params["waypointNames"] = stringOfStringArray(waypointNames);
	params["name"] = name;
	params["descr"] = descr;
	post("https://scenicapp.space/api/import/polyline", params);
}


/**************************************************************
************       Send Coordinates for IMPORT      **********
**************************************************************
****  coordinates (required): Array of coordinates (Array of arrays with lat as element 0 and lon as element 1) E.g. coordinates[0][0] = 32.123456; coordinates[0][1] = 17.654321;
****  polyline (required): Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
****  waypointKinds: (optional): An array of strings, where the strings represent the waypointKind, which is either "via" or "stop". The array should contain the same amount of elements as there are coordinates. A via is a shaping point to force the route along that point. User is not alerted when reaching a via and vias can be ignored upon recalculation. A stop is a special kind of via. User will get alerts when nearing a via point and stops are not ignored upon recalculation. Route begin and end point are stops. E.g. var waypointKinds = ["stop","via","via","via","stop","via","stop"]
****  waypointNames: (optional): An array of strings, where the strings represent the waypointName. The number of names needs to match the number of coordinates. P.S. If a waypoint does not have a name an empty string should be included. If a name has a pipe character it will be removed from the name. E.g. var waypointNames = ["Route start","","","","Lunch Place","","Route endpoint"]
****  name (optional): the name of the route (String)
****  descr (optional): the description of the route (String)
****  source (optional): the name of your website or service (String)
**************************************************************/
function sendToScenicForImport_coordinates(coordinates, waypointKinds = [], waypointNames = [], name = "", descr = "", source = "") {
	var params = [];
	params["source"] = source;
	params["coordinates"] = stringOfCoordinatesArray(coordinates);
	params["waypointKinds"] = stringOfStringArray(waypointKinds);
	params["waypointNames"] = stringOfStringArray(waypointNames);
	params["name"] = name;
	params["descr"] = descr;
	post("https://scenicapp.space/api/import/coordinates", params);
}


/**************************************************************
*****               Send Polyline for NAVIGATION      *********
***************************************************************
****  polyline (required): Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
****  the polyline has to contain at least 2 coordinates and at the most 200 coordinates
****  name (Optional): the name of the route (String)
****  routeMode (Optional): F for Fastest, S for Shortest, E for Efficient, C for Curvy (Defaults to F)
****  vehicleType (Optional): C for Car/Motorcycle, B for Bicycle, P for Pedestrian (Defaults to C)
**************************************************************/
function sendToScenicForNavigation_polyline(polyline, name = "", routeMode = "F", vehicleType = "C") {
	var params = [];
	params["name"] = name;
	params["polyline"] = polyline;
	params["routeMode"] = routeMode;
	params["vehicleType"] = vehicleType;

	post("https://scenicapp.space/api/navigate/polyline", params);
}


/**************************************************************
************       Send Coordinates for NAVIGATION   **********
**************************************************************
****  coordinates(Required): Array of coordinates (Array of arrays with lat as element 0 and lon as element 1) E.g. coordinates[0][0] = 32.123456; coordinates[0][1] = 17.654321;
****  - 6 digits precision for the lat and lon components is sufficient
****  - there should be at least 2 coordinate and at the most 200 coordinates
****  name (Optional): the name of the route (String)
****  routeMode (Optional): F for Fastest, S for Shortest, E for Efficient, C for Curvy (Defaults to F)
****  vehicleType (Optional): C for Car/Motorcycle, B for Bicycle, P for Pedestrian (Defaults to C)
**************************************************************/
function sendToScenicForNavigation_coordinates(coordinates, name = "", routeMode = "F", vehicleType = "C") {
	var params = [];
	params["coordinates"] = stringOfCoordinatesArray(coordinates);
	params["name"] = name;
	params["routeMode"] = routeMode;
	params["vehicleType"] = vehicleType;

	post("https://scenicapp.space/api/navigate/coordinates", params);
}

/*************************************************************
************   Send Single Coordinate for NAVIGATION   *******
**************************************************************
****  coordinate: Array with lat as element 0 and lon as element 1. E.g. coordinates[0] = 32.123456; coordinates[1] = 17.654321;
****  - 6 digits precision for the lat and lon components is sufficient
**************************************************************/
function sendToScenicForNavigation_coordinate(coordinate, name) {
	var params = [];
	params["name"] = name;
	params["coordinate"] = roundToSix(coordinate[0]).toFixed(6) + "," + roundToSix(coordinate[1]).toFixed(6)
	post("https://scenicapp.space/api/navigate/coordinate", params);
}

