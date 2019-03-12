<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

  

class HomeController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function ajaxRequest()

    {

        return view('ajaxRequest');

    }

   

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function ajaxRequestPost(Request $request)

    {

        $input = $request;
        // $a = $input->name;

        // echo view('register');
        // Session::put();
        $asd = response()->json(['success'=> 'Ajax']);
        session(['asd', 'asd']);
        return $asd;

        // return 

        // view('ajaxRequest');
        ;
    }

}