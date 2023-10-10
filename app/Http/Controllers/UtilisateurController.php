<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Parse\ParseException;
use Parse\ParseQuery;
use Parse\ParseUser;

class UtilisateurController extends Controller
{
    function saveUser(Request $request){
        $user = new ParseUser();
        $user->set("username", $request->input('username'));
        $user->set("password", $request->input('password'));
        $user->set("email", $request->input('email'));
        try {
            $user->signUp();
            $listeUser = new ParseQuery("_User");
            $users = $listeUser->find();
            return view('users', compact('users'));
        // Hooray! Let them use the app now.
        } catch (ParseException $ex) {
        // Show the error message somewhere and let the user try again.
            echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
        }
    }
    function getUser(){

    }
    function loginUser(Request $request){
        try {
            $user = ParseUser::logIn($request->input('username'),$request->input('password'));
            dd($user);
          } catch (ParseException $error) {

          }
    }
}
