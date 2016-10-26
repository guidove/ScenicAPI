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
********************    Send GPX URL     **********************
***************************************************************
****  gpxurl: the url to the gpx file (String) (has to be direct link, no html wrappers like a dropbox link for example)
****  source: the name of your website or service (String)
***************************************************************
****  the route name and description will be extracted from the GPX file
****  if the GPX contains more routes, tracks and/or waypoints they can all be imported by the user
**************************************************************/
function sendToScenicForImport_gpxurl(gpxurl, source) {
	var params = [];
	params["source"] = source;
	params["gpxurl"] = gpxurl;
	post("https://scenicapp.space/api/import/gpxurl", params);
}


/**************************************************************
*****  Send Polyline (Google Encoded Polyline Format) *********
***************************************************************
****  polyline: Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
****  name: the name of the route (String)
****  descr: the description of the route (String)
****  source: the name of your website or service (String)
**************************************************************/
function sendToScenicForImport_polyline(polyline, name, descr, source) {
	var params = [];
	params["source"] = source;
	params["polyline"] = polyline;
	params["name"] = name;
	params["descr"] = descr;
	post("https://scenicapp.space/api/import/polyline", params);
}


/**************************************************************
********************  Send Coordinates ***********************
**************************************************************
****  coordinates: Array of coordinates (Array of arrays with lat as element 0 and lon as element 1) E.g. coordinates[0][0] = 32.123456; coordinates[0][1] = 17.654321;
****  name: the name of the route (String)
****  descr: the description of the route (String)
****  source: the name of your website or service (String)
**************************************************************/
function sendToScenicForImport_coordinates(coordinates, name, descr, source) {
	var params = [];
	params["source"] = source;
	params["coordinates"] = stringOfCoordinatesArray(coordinates);
	params["name"] = name;
	params["descr"] = descr;
	post("https://scenicapp.space/api/import/coordinates", params);
}


