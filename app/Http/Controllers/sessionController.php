<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sessionController extends Controller
{
    public function save(Request $request) {
        $alert = response()->json(['success' => $request['id']]);
        session(['uid'=> $request['id']]);
        return $alert;
    }

    public function logout(Request $request) {
        $alert = response()->json(['success' => $request['id']]);
        session()->forget('uid');
        session()->flush();
        return $alert;
    }

    public function adminsave(Request $request) {
        $alert = response()->json(['success' => $request['id']]);
        $admin = $request['id'];
        if($admin == 'kNZ24FppcNS7o8fp2lev7b7zIet1' ) {
            session(['uid'=> $admin]);
        }
        
        return $alert;
    }
}
