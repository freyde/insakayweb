<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Kreait\Firebase\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class adminController extends Controller
{
    public function adminHomeManager() {
        $uid = session()->get('uid');
        if($uid == null) {
            return view('/adminlogin');
        } else if($uid == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $database = $firebase->getDatabase();
        $auth = $firebase->getAuth();

        $uid = session()->get('uid');
        $resources = $database->getReference('resources')->getSnapshot()->getValue();
        $a = $resources['userCount'];
        $b = $auth->listUsers($a, 1);
        $d = 0;
        $array = array([
            'email' => 'aasd',
            'uid' => 'qwe'
        ]);
        foreach($b as $c) {
            array_push($array, array([
                'email' => trim(json_encode($c->email), '"'),
                'uid' => trim(json_encode($c->uid), '"'),
            ]));
            $d++;
        }
        array_shift($array);
        return view('admincontrolpanel')->with('operators',$array)->with('uid', $uid);
        } else {
            return view('err403');
        }
    }

    function addOperatorAccount(Request $request) {
        $uids = session()->get('uid');
        if($uids == null) {
            return view('/adminlogin');
        } else if($uids == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            $email = $request['emailAddress'];
            $password = $request['pass'];
            $firstName = $request['ownerFName'];
            $lastName = $request['ownerLName'];
            $fullName = $request['fullName'];
            $shortName = $request['shortName'];
            $key = $request['key'];

            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();
            $auth = $firebase->getAuth();

            $resources = $database->getReference('resources')->getSnapshot()->getValue();
            $a = $resources['userCount']+1;
            $UID = sprintf('%05d', $a);

            $auth->createUserWithEmailAndPassword($email, $password);
            $database->getReference('resources')->update([
                'userCount' => $a,
            ]);
            $uid='a';
            $accounts = $auth->listUsers($a, 1);

            foreach($accounts as $account) {
                $x = trim(json_encode($account->email), '"');
                if($x == $email) {
                    $uid = trim(json_encode($account->uid), '"');
                }
            }

            $database->getReference('users/'. $uid .'/info')->update([
                'busCount' => '0',
                'conductorCount' => 0,
                'routeCount' => 0,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'operatorID' => $UID,
                'operatorName' => $fullName,
                'shortName' => $shortName,
                'uid' => $uid,
                'key' => $key,
            ]);
            
            $alert = response()->json(['success' => $uid]);
            
            return $alert;
        } else {
            return view('err403');
        }
    }

    function displayOperator($operator) {
        $uids = session()->get('uid');
        if($uids == null) {
            return view('/adminlogin');
        } else if($uids == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();
            $raw = $database->getReference('users/' .$operator. '/info')->getSnapshot()->getValue();
            // $infos = array_pop($raw);
            // print_r($a);
            return view('manageOperator')->with('infos', $raw)->with('uid', $uid);
        } else {
            return view('err403');
        }
    }

    public function deleteOperatorAccount(Request $request) {
        $uids = session()->get('uid');
        if($uids == null) {
            return view('/adminlogin');
        } else if($uids == 'kNZ24FppcNS7o8fp2lev7b7zIet1') {
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/insakay-198614-firebase-adminsdk-mrk72-6083723cf0.json');
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();
            $database = $firebase->getDatabase();
            $auth = $firebase->getAuth();

            $curCount = $database->getReference('resources/userCount')->getSnapshot()->getValue();
            $newCount = $curCount - 1;
            $uid = $request['uid'];

            $auth->deleteUser($uid);
            $database->getReference('users/'. $uid)->remove();
            $database->getReference('resources')->update([
                'userCount' => $newCount
            ]);
        } else {
            return view('err403');
        }
    }
}
