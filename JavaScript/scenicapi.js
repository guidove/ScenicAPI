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
****  name: (optional) the name of the route (String)
****  descr (optional): the description of the route (String)
****  source (optional): the name of your website or service (String)
**************************************************************/
function sendToScenicForImport_polyline(polyline, name = "", descr = "", source = "") {
	var params = [];
	params["source"] = source;
	params["polyline"] = polyline;
	params["name"] = name;
	params["descr"] = descr;
	post("https://scenicapp.space/api/import/polyline", params);
}


/**************************************************************
************       Send Coordinates for IMPORT      **********
**************************************************************
****  coordinates (required): Array of coordinates (Array of arrays with lat as element 0 and lon as element 1) E.g. coordinates[0][0] = 32.123456; coordinates[0][1] = 17.654321;
****  name (optional): the name of the route (String)
****  descr (optional): the description of the route (String)
****  source (optional): the name of your website or service (String)
**************************************************************/
function sendToScenicForImport_coordinates(coordinates, name = "", descr = "", source = "") {
	var params = [];
	params["source"] = source;
	params["coordinates"] = stringOfCoordinatesArray(coordinates);
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

