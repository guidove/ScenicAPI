//
//  ScenicIntegration.swift
//
//  Created by Pinguido
//  Copyright © 2016 Pinguido. All rights reserved.
//


import Foundation
import UIKit
import CoreLocation

class ScenicAPI {
    
    
    //  All functions attempt to open the Scenic App on the users' device.
    //  If Scenic is not on the device the App Store App will open on the Scenic Download Page.
    
    
    
    /**************************************************************
    ***********************    Send GPX URL     *******************
    ***************************************************************
    ****  gpxurl: the url to the gpx file (has to be direct link, no html wrappers like a dropbox link for example)
    ***************************************************************
    ****  the route name and description will be extracted from the GPX file
    ****  if the GPX contains more routes, tracks and/or waypoints they can all be imported by the user
    **************************************************************/
    
    func sendToScenicForImport(gpxurl: String) {
        if let encodedgpxurl = gpxurl.addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed) {
            let param = "gpxurl=\(encodedgpxurl)"
            self.getCopiedGPXURL("import/gpxurl", parameters: param) { (error, url) -> Void in
                if !error {
                    self.sendGPXURL(url!)
                }
            }
        }
        else {
            self.showErrorAlert("Error", message: "The Route Data could not be processed")
        }
    }
    
    
    
    
    /**************************************************************
    *****  Send Polyline (Google Encoded Polyline Format) *********
    ***************************************************************
    ****  polyline: Encoded Polyline (String) (https://developers.google.com/maps/documentation/utilities/polylinealgorithm)
    ****  name: the name of the route (String)
    ****  descr: the description of the route (String)
    **************************************************************/
    
    func sendToScenicForImport(polyline: String, name: String, descr: String) {
        if let encodedname = name.addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed),
           let encodeddescr = descr.addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed) {
            let param = "polyline=\(polyline)&name=\(encodedname)&descr=\(encodeddescr)"
            self.getCopiedGPXURL("import/polyline", parameters: param) { (error, url) -> Void in
                if !error {
                    self.sendGPXURL(url!)
                }
            }
        }
        else {
            self.showErrorAlert("Error", message: "The Route Data could not be processed")
        }

    }
    
    
    
    
    /**************************************************************
     ********************  Send Coordinates ***********************
     **************************************************************
     ****  coordinates: Array of coordinates (latitude,longitude) (Array<CLLocationCoordinate2D>)
     ****  name: the name of the route (String)
     ****  descr: the description of the route (String)
     **************************************************************/
    
    func sendToScenicForImport(coordinates: Array<CLLocationCoordinate2D>, name: String, descr: String) {
        if let encodedname = name.addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed),
            let encodeddescr = descr.addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed) {
            let param = "coordinates=\(stringOfCLLocationArray(coordinates))&name=\(encodedname)&descr=\(encodeddescr)"
            self.getCopiedGPXURL("import/coordinates", parameters: param) { (error, url) -> Void in
                if !error {
                    self.sendGPXURL(url!)
                }
            }
        }
        else {
            self.showErrorAlert("Error", message: "The Route Data could not be processed")
        }
        
    }

    
    
    
    
    
    
    
    
    
    
    
    /**************************************************************
     ***********************    Helper Functions     **************
     *************************************************************/
    fileprivate func stringOfCLLocationArray(_ cllArray: [CLLocationCoordinate2D]) -> String {
        var str = ""
        for location in cllArray {
            str += "\(location.latitude.toNonScientificString()),\(location.longitude.toNonScientificString())|"
        }
        return String(str.characters.dropLast())
    }
    
    fileprivate func sendGPXURL(_ gpxurl: String) {
        var urlComponents = URLComponents(string: "https://scenicapp.space/api/openScenic.php")!
        let encodedgpxurl = gpxurl.addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed)
        urlComponents.queryItems = [
            URLQueryItem(name: "gpxurl", value: encodedgpxurl)
        ]
        UIApplication.shared.open(urlComponents.url!, options: [:], completionHandler: nil)
    }
    
    fileprivate func getCopiedGPXURL(_ endpoint: String, parameters: String, compHandler:@escaping (_ error: Bool, _ gpxurl: String?) ->()) {
        let params = "fromOtherApp=1&\(parameters)"
        
        let defaultSession = URLSession(configuration: URLSessionConfiguration.default)
        var dataTask: URLSessionDataTask?
        let urlString = "https://scenicapp.space/api/\(endpoint)"
        var request = URLRequest(url: URL(string: urlString)!)
        request.httpMethod = "POST"
        let data = params.data(using: .utf8)
        print("JsonData")
        //request.setValue("application/json; charset=utf-8", forHTTPHeaderField: "Content-Type")
        request.httpBody = data

        
        dataTask = defaultSession.dataTask(with: request, completionHandler: {
            data, response, error in
            if let error = error {
                print(error.localizedDescription)
            }
            else if let httpResponse = response as? HTTPURLResponse {
                if httpResponse.statusCode == 200 {
                    do {
                        if let data = data {
                            print(data)
                            if let json = try JSONSerialization.jsonObject(with: data, options:JSONSerialization.ReadingOptions.allowFragments) as? Dictionary<String,String> {
                                print(json)
                                if let gpxurl = json["gpxurl"] {
                                    compHandler(false, gpxurl)
                                    return
                                } else {
                                    print("Results key not found in dictionary")
                                }
                            }
                            else {
                                print("Could not serialize JSON")
                            }
                        } else {
                            print("JSON Error")
                        }
                    } catch let error as NSError {
                        print("Error parsing results: \(error.localizedDescription)")
                    }
                }
            }
            print(response)
            self.showErrorAlert("Error", message: "Connection to Scenic failed or incorrect data received.")
            compHandler(true, nil)
        }) 
        dataTask?.resume()
    }

    
    fileprivate func showErrorAlert(_ title: String, message: String) {
        func presentFromController(_ controller: UIViewController, animated: Bool, completion: (() -> Void)?) {
            if let navVC = controller as? UINavigationController,
                let visibleVC = navVC.visibleViewController {
                presentFromController(visibleVC, animated: animated, completion: completion)
            }
            else {
                if let tabVC = controller as? UITabBarController, let selectedVC = tabVC.selectedViewController {
                    presentFromController(selectedVC, animated: animated, completion: completion)
                }
                else {
                    print("Presenting")
                    controller.present(controller, animated: animated, completion: completion);
                }
            }
        }
        let alert = UIAlertController(title: title, message: message, preferredStyle: UIAlertControllerStyle.alert)
        alert.addAction(UIAlertAction(title: "OK", style: UIAlertActionStyle.default, handler: nil))
        if let rootVC = UIApplication.shared.keyWindow?.rootViewController {
            if let presentingVC = rootVC.presentingViewController {
                presentFromController(presentingVC, animated: true, completion: nil)
            }
        }
    }
}

fileprivate extension Double {
    func toNonScientificString() -> String {
        if self < 0.000001 && self > -0.000001 {
            return "0.000000"
        }
        return String(format: "%.6f", self)
    }
}

