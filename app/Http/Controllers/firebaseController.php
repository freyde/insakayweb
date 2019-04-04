<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Kreait\Firebase\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

use Illuminate\Http\Request;

class firebaseController extends Controller {

    public function homeManager() {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();
            $uid = session()->get('uid');

            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();
            
            return view('/controlPanel')->with('uid', $uid)->with('opName', $opName);
        }
    }
    
    public function index(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $database = $firebase->getDatabase();
        $auth = $firebase->getAuth();
        
        // $newPost = $database->getReference('blog/posts')->push([
        //     'title' => 'Laravel FireBase Tutorial' ,
        //     'category' => 'Laravel'
        // ]);
        // echo '<pre>';
        // print_r($newPost->getvalue());
        // $datas = $database->getReference('blog/posts')->getSnapshot()->getValue();
        
        // $uid = $auth->listUsers(3, 1);
        // foreach ($uid as $uids) {
        //     // print_r($data['title']);
        //     // print_r($data['category']);
        //     print_r(trim(json_encode($uids->email), '"'));
        //     echo '<br>';
        //     echo '<br>';
            
        // }
        //     $d = 0;
        // foreach($uid as $c) {
        //     $array = array([
        //         'email' => trim(json_encode($c->email)),
        //         'uid' => trim(json_encode($c->uid)),
        //     ]);
        //     $d++;
        // }
        // print_r($array);
        // $a = $database->getReference('users/VavJrBitfOg9EVTRs00zPzPuuze2/info');
        // print_r($a->getChild('users/VavJrBitfOg9EVTRs00zPzPuuze2/info'));
        $routes = $database->getReference('users/YSP0Y43ilUbxdyToijbCakI3KoG2/routes')->getSnapshot()->getValue();
        // $routes = $database->getReference('users/' . $uid .'/routes')->getSnapshot()->getValue();
        foreach($routes as $route) {
        print_r($route['routeName']);
        }
        
    }

    public function listConductors() {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $array = $database->getReference('users/' . $uid .'/conductors')->getSnapshot()->getValue();
            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();
    
            return view('conductors')->with('conductors', $array)->with('uid', $uid)->with('opName', $opName);
        }
    }

    public function listBuses() {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $array = $database->getReference('users/' . $uid .'/buses')->getSnapshot()->getValue();
            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();

            return view('buses')->with('buses', $array)->with('uid', $uid)->with('opName', $opName);
        }
    }

    public function addConductor(Request $request) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $vars = $request->all();
            $alert = response()->json(['success' => 'Success!']);
            $name = $request['name'];
            $num = $request['number'];
            $password = $request['pass'];
            $uid = session()->get('uid');

            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $array = $database->getReference('users/' . $uid .'/info')->getSnapshot()->getValue();
            $count = $array['conductorCount'];
            $cCount = $count + 1;
            $cno = $array['operatorID'].'-'.sprintf('%03d',$cCount);

            $database->getReference('users/' . $uid .'/info')->update([
                'conductorCount' => $cCount
            ]);
            
            $database->getReference('users/'. $uid .'/conductors')->push([
                'name' =>  $name,
                'phoneNo' => $num,
                'conductorNo' => $cno,
                'password' => $password,
                'status' => "0"
            ]);
            return $alert;
        }
    }

    public function addBus(Request $request) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $vars = $request->all();
            $alert = response()->json(['success' => 'Success!']);
            $name = $request['name'];
            $plateNo = $request['plate'];
            $uid = session()->get('uid');

            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $array = $database->getReference('users/' . $uid .'/info')->getSnapshot()->getValue();
            $count = $array['busCount'];
            $bCount = $count + 1;
            $bno = $array['operatorID'].'-'.sprintf('%04d',$bCount);

            $database->getReference('users/' . $uid .'/info')->update([
                'busCount' => $bCount
            ]);

            $database->getReference('users/'. $uid .'/buses')->push([
                'busNo' =>  $bno,
                'driverName' => $name,
                'plateNo' => $plateNo
            ]);

            return $alert;
        }
    }

    public function displayRoutes() {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $routes = $database->getReference('users/' . $uid .'/routes')->getSnapshot()->getValue();
            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();

            return view('route')->with('routes', $routes)->with('uid', $uid)->with('opName', $opName);
        }
    }

    function viewAddRoute() {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();

            return view('addRoute')->with('uid', $uid)->with('opName', $opName);
        }
    }

    function addRoute(Request $request) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $routeName = $request['name'];
            $coverage = $request['list'];


            $operatorID = $database->getReference('users/'. $uid .'/info/operatorID')->getSnapshot()->getValue();
            $a = $database->getReference('users/'. $uid .'/info/routeCount')->getSnapshot()->getValue();
            $newCount = $a + 1;
            $route = sprintf('%03d', $newCount);
            $rID = ($operatorID .'-'. $route);
            $database->getReference('users/'. $uid .'/info')->update([
                'routeCount' => $newCount,
            ]);
                // print_r($request['list']);
            $database->getReference('users/'. $uid .'/routes')->push([
                'routeName' => $routeName,
                'routeID' => $rID,
                'coverage' => $coverage,
                'landmarkCount' => 0,
                'endPoint1' => "none",
                'endPoint2' => "none",
            ]);

            $alert = response()->json(['success' => $coverage]);
            return $alert;
        }
    }

    public function manageRoute($routeid) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();
            $uid = session()->get('uid');
            $routes = $database->getReference('users/'. $uid .'/routes')->getSnapshot()->getValue();
            
            foreach($routes as $route) {
                if($route['routeID'] == $routeid) {
                    $infos = $route;
                }
            }

            $landmarks = $database->getReference('users/'. $uid .'//landmarks/'. $routeid)->getSnapshot()->getValue();
            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();

            return view('manageRoute')->with('infos', $infos)->with('landmarks', $landmarks)->with('uid', $uid)->with('routeID', $routeid)->with('opName', $opName);
        }
    }

    public function addEndPoint(Request $request) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $alert = response()->json(['result' => 'Success!']);
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();
            $uid = session()->get('uid');

            $type = $request['type'];
            $name = $request['name'];
            $routeID = $request['routeID'];

            $routeKeys = $database->getReference('users/'. $uid .'/routes')->getChildKeys();
            foreach($routeKeys as $key) {
                $route = $database->getReference('users/'. $uid .'//routes/'. $key)->getSnapshot()->getValue();
                if($route['routeID'] == $routeID) {
                    if($type == "ep1") {
                        if($name != $route['endPoint2']) {
                            $database->getReference('users/'. $uid .'//routes/'. $key)->update([
                                'endPoint1' => $name,
                            ]);
                        } else {
                            $alert = response()->json(['result' => 'Failed! Coverage already chosen as end point 2']);
                        }
                    } 
                    else if($type == "ep2") {
                        if($name != $route['endPoint1']) {
                            $database->getReference('users/'. $uid .'//routes/'. $key)->update([
                                'endPoint2' => $name,
                            ]);
                        } else {
                            $alert = response()->json(['result' => 'Failed! Coverage already chosen as end point 1']);
                        }
                    }
                    break;
                }
            }
            return $alert;
        }
    }

    public function addLandmark(Request $request) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $alert = response()->json(['success' => 'Success!']);
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $routeID = $request['routeID'];
            $landmarkName = $request['landmarkName'];
            $coordinate = $request['coordinate'];
            $coverage = $request['coverage'];

            $routes = $database->getReference('users/'. $uid .'/routes')->getSnapshot()->getValue();

            foreach($routes as $route) {
                if($route['routeID'] == $routeID) {
                    $landmarkCount = $route['landmarkCount'];
                }
            }
            $newLandmarkCount = $landmarkCount + 1;
            $landmarkID = $routeID ."-". sprintf('%03d', $newLandmarkCount);

            $database->getReference('users/'. $uid .'//landmarks/'. $routeID)->push([
                'landmarkID' => $landmarkID,
                'landmarkName' => $landmarkName,
                'coordinate' => $coordinate,
                'coverage' => $coverage,
            ]); 
            
            $routeKeys = $database->getReference('users/'. $uid .'/routes')->getChildKeys();

            foreach($routeKeys as $routeKey) {
                $route = $database->getReference('users/'. $uid .'//routes/'. $routeKey)->getSnapshot()->getValue();
                if($route['routeID'] == $routeID) {
                    $database->getReference('users/'. $uid .'//routes/'. $routeKey)->update([
                        'landmarkCount' => $newLandmarkCount,
                    ]);
                }
            }
        
            return $alert;
        }
    }

    public function viewFare() {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $routes = $database->getReference('users/'. $uid .'/routes')->getSnapshot()->getValue();
            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();

            return view('fare')->with('routes', $routes)->with('uid', $uid)->with('opName', $opName);
        }
    }

    public function manageFare($routeID) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $routes = $database->getReference('users/'. $uid .'/routes')->getSnapshot()->getValue();

            foreach($routes as $route) {
                if($route['routeID'] == $routeID) {
                    $routeInfos = $route;
                    $routeName = $route['routeName'];
                }
            }
            $haveFare;
            $fareKeys = "";
            $fares = $database->getReference('users/'. $uid .'//fares/'. $routeID)->getSnapshot()->getValue();
            if($fares != null) {
                $haveFare = true;
                $rawKeys = $database->getReference('users/'. $uid .'//fares/'. $routeID ."/matrix")->getChildKeys();
                $fareKeys = array();
                foreach($rawKeys as $key) {
                    $a = explode(", ", $key);
                    $fareKeys[] = $a[0];
                }
            } else {
            $haveFare = false;
            }

            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();

            return view('manageFare')->with('infos', $routeInfos)->with('routeName', $routeName)->with('opName', $opName)->with('uid', $uid)->with('haveFare', $haveFare)->with('fares', $fares)->with('fareKeys', $fareKeys);
        }
    }

    public function saveFareMatrix(Request $request) {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');

            $routeID = $request['routeID'];
            $raw = $request['list'];
            $database->getReference('users/'. $uid .'//fares/'. $routeID)->update([
                'matrix' => $raw,
            ]);
        }
    }

    public function viewReports() {
        $uid = session()->get('uid');
        if( $uid == null) {
            return view('login');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            return view('err403');
        } else {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();

            $uid = session()->get('uid');
            $opName = $database->getReference('users/' . $uid .'//info/operatorName')->getSnapshot()->getValue();

            $reports = $database->getReference('users/' . $uid .'/reports')->getSnapshot()->getValue();
            $keys = "";
            if($reports != null)
                $keys = $database->getReference('users/' . $uid .'/reports')->getChildKeys();

            return view('reports')->with('uid', $uid)->with('opName', $opName)->with('keys', $keys)->with('reports', $reports);
        }
    }
}

?>