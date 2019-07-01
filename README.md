Scenic is a the number 1 Motorcycle Navigation App on iOS. For more information see [MotoMappers.com](http://www.motomappers.com) and [Scenic on the App Store](https://itunes.apple.com/app/id1089668246)

# Scenic-Integration
By adding links to your app and website your users will be able to:

- **Navigate** to locations with Scenic
- **Navigate** routes with Scenic
- **Import** send routes from your site to their Scenic account

By simply tapping/clicking a link or button, Scenic will open automatically and navigation or import will start. It works even if the user is on a desktop. In that case the Scenic WebApp will open and user can add the location/route to his/her account from there.

By integrating with Scenic you not only offer more functionality to your existing users, but also **open up an additional channel to acquire new users**. (i.e. We will promote the link via our newsletter and social channels. Options for custom integration are also available)

# Ways to Integrate

## 'Navigate with Scenic' links on your website / in your app
Send a route or location to Scenic to **navigate** it:

- When a user clicks a 'navigate' link/button on your website/app Scenic will open with the location/route ready to be navigated.
- There is a link to send a location (single coordinate) and there are links to send routes with upto 200 coordinates.
- When sending a single location the user will be navigated from his/her current position to that location
- When sending a route the user will be navigated along the send coordinates, optionally including navigation from his/her current position to the first coordinate.
- After the user taps 'Start' the navigation begins.
- Navigation links do NOT add a route to the users' account. After navigation finishes the route is 'gone'.

## 'Import in Scenic' links on your website / in your app
They send a route to Scenic to **import** it in a users account:

- When a user clicks an 'import' link/button on your website/app the route will be sent to Scenic.
- The route can than be imported by the user and added to his/her account.
- The user can also navigate, edit, duplicate and publish (i.e. make public for other Scenic users) a route after importing.

> *Both the Import and the Navigate links are based on iOS Universal Links, but they have been customised. While regular universal links only open Scenic if tapped/clicked from an iOS app or from an iOS browser, the Scenic links wil redirect the user to the Scenic WebApp if browsing on a desktop.*
>
> - *If the user is browsing on an iOS device or using your iOS App, and Scenic is installed, Scenic will automatically open upon clicking the link/button. If Scenic is not installed the App Store App will open on the Scenic page.*
> - *If the user is not browsing on an iOS device the user is directed to the Scenic WebApp, upon where he/she can enter their Scenic credentials. The route/location is then uploaded to their Scenic account and upon opening Scenic on their device he/she will be notified that a route/location is ready to be imported or navigated.*
>
> Because of this behaviour the customised universal links **don't work offline**. For the 'Navigate' links, [Direct Universal Links](directUniLinksForNavigation.md) are also available. They do work offline, but they don't redirect the user to the Scenic WebApp if browsing on a non-ios device. In stead they will open the App Store Scenic page.

## Custom integration
Besides the Universal Links it's also possible to give your (potential new) users access to their routes directly from the Scenic App. Scenic users will see your site/app logo in the Scenic app. When they tap it they will be asked to 'Connect' their account to Scenic so they will be able to see their routes.

This kind of integration is custom and is not covered in this repository, but if you're interested please feel free to [contact MotoMappers](http://www.motomappers.com/mailsupport.php). For an example please download the Scenic app and see how it already integrates with [Furkot](www.furkot.com) and [RouteYou](www.routeyou.com) in this way. 

# Technical Options
There are 2 ways you can call the Scenic Universal Links

1. Using GET request (links with parameters as part of the link)
2. Using POST request (the parameters are included in the body of the request)

GET requests are easier to implement, but they have 2 potential downsides: (1) the route data (e.g. a gpx url) is exposed to the public as it's part of the link and (2) url length is [limited to 2000 characters](http://stackoverflow.com/questions/417142/what-is-the-maximum-length-of-a-url-in-different-browsers) which could become a problem when using the `polyline` or `coordinates` subendpoints.

POST request are recommended. This repository includes JavaScript, PHP and Swift libraries to make this easy to implement.

## GET requests
Using the GET requests is as simple as putting a link on your website. The link format is:
`https://scenicapp.space/Scenic/api/<endpoint>/<subendpoint>?<parameter1name>=<parameter1value>&<parameter2name>=<parameter2value>&...etc`

- Endpoints are `navigate` and `import`
- The `navigate` endpoint has three subendpoints: `polyline`, `coordinates` and `coordinate`
- The `import` endpoint has three subendpoints: `gpxurl`, `polyline` and `coordinates`
- All parameter values need to be urlencoded EXCEPT polyline and coordinates

For more info and a full example see the HTTP-GET folder of this repository.

## POST requests
This repository offers three libraries to simplify the implementation of Scenic POST requests:

- PHP Library (for websites)
- Javascript Library (for websites)
- Swift Library (for iOS apps) 

### PHP Library

#### Installation
Include scenicapi.php in your php page(s):
`include_once('scenicapi.php');`

#### Usage
The php library offers 6 functions:

**to send a route for Navigation:**

- `sendToScenicForNavigation_polyline($polyline, $name, $routeMode, $vehicleType)`
- `sendToScenicForNavigation_coordinates($coordinates, $name, $routeMode, $vehicleType)`

**to send a location for Navigation**

- `sendToScenicForNavigation_coordinate($coordinate, $name)`

**to send a route for Import:**

- `sendToScenicForImport_gpxurl($gpxurl, $source)`
- `sendToScenicForImport_polyline($polyline, $name, $descr, $source)`
- `sendToScenicForImport_coordinates($coordinates, $name, $descr, $source)`

For more info and examples see the PHP folder of this repository.

### JavaScript Library

#### Installation
Include scenicapi.js in your html page(s):
`<script src='scenicapi.js'></script>`

#### Usage
The JavaScript library also offers 6 functions:

**to send a route for Navigation:**

- `sendToScenicForNavigation_polyline(polyline, name, routeMode, vehicleType)`
- `sendToScenicForNavigation_coordinates(coordinates, name, routeMode, vehicleType)`

**to send a location for Navigation**

- `sendToScenicForNavigation_coordinate(coordinate, name)`

**to send a route for Import:**

- `sendToScenicForImport_gpxurl(gpxurl, source)`
- `sendToScenicForImport_polyline(polyline, name, descr, source)`
- `sendToScenicForImport_coordinates(coordinates, name, descr, source)`

For more info and examples see the JavaScript folder of this repository.

### Swift Library
The Swift Library is written in **Swift 3**

#### Installation
Drag the `ScenicAPI.swift` file to your project. Make sure to check 'Copy items if needed'.

#### Usage
Create an instance of the ScenicAPI class: `let scenic = ScenicAPI()` and use any of the 6 available functions:

**to send a route for Navigation:**

- `scenic.sendToScenicForNavigation(polyline: String, name: String, routeMode: RouteMode, vehicleType: VehicleType)`
- `scenic.sendToScenicForNavigation(coordinates: Array<CLLocationCoordinate2D>, name: String, routeMode: RouteMode, vehicleType: VehicleType)`

**to send a location for Navigation**

- `scenic.sendToScenicForNavigation(coordinate: CLLocationCoordinate2D, name: String)`

**to send a route for Import:**

- `scenic.sendToScenicForImport(gpxurl: String)`
- `scenic.sendToScenicForImport(polyline: String, name: String, descr: String)`
- `scenic.sendToScenicForImport(coordinates: Array<CLLocationCoordinate2D>, name: String, descr: String)`

For more info and an example project see the Swift folder of this repository.


# FAQs
Q | A
--- | ---
How many route points can Scenic handle? | For Import Scenic can handle routes with thousands of points. For Navigation Scenic can handle up to 200 points.
If I send a gpxurl for import, will that url need to be reachable forever? | No, Scenic creates a copy of the GPX and stores it (until the user imports it) on the Scenic server. Your URL can stop existing a few seconds after the user clicked the link.
App Store App opens while Scenic is installed? | This is a bug ([or feature?](http://stackoverflow.com/questions/34607023/branch-io-disable-right-arrow-button-bnc-lt-on-statusbar)) in the Apple Universal links.<br>- When Scenic opens through a universal link the status bar will display the domain of that universal link in the top right of the status bar. In scenic's case `scenicapp.space`.<br>- If a user taps on that, the iOS device thinks that from now on ALL universal links for this app should NOT open the App anymore, but in stead go to `scenicapp.space`, which, for Scenic, results in the App Store Scenic page opening.<br>-To resolve this, email the following link to your user `https://scenicapp.space/api/openScenic.php` and tell the user to open the email on his iPhone and 'tap and hold' on this link. An action sheet will appear where the user should choose 'Open in Scenic'. From then on all links will open in Scenic again.



