<?php

namespace App\Http\Controllers;

use App\Client;
use App\Parse;
use Illuminate\Http\Request;
use Parse\ParseACL;
use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseRole;
use Parse\ParseUser;

class ClientController extends Controller
{
    function insertionClient(Request $request){
        $client = new ParseObject("Client");
        $client->set("name", $request->input('name'));
        $user = new ParseUser();
        $user->set("username", $request->input('name'));
        $user->set("password", $request->input('password'));
        $roleACL = new ParseACL();
        $roleACL->setPublicReadAccess(true);
        $role = ParseRole::createRole("Administrator", $roleACL);
        $role->set("user",$user);
        try {
            $role->save();
            $user->signUp();
            $client->set("user", $user);
            $client->save();
            $query = new ParseQuery("Client");
            $client = $query->find();

            return view('inscription', compact('client'));
        } catch (ParseException $ex) {
            echo 'Failed to create new object, with error message: ' . $ex->getMessage();
        }

    }

    function getClient(){

        try {
        $query = new ParseQuery("Client");
        $client = $query->get("554rz4llv4");

        dd($client);
        // The object was retrieved successfully.
        } catch (ParseException $ex) {
            dd($ex->getMessage());
        }
    }

    function ListeClient(){

        try {
        $query = new ParseQuery("Client");
        $client = $query->find();

       return view('inscription', compact('client'));
        // The object was retrieved successfully.
        } catch (ParseException $ex) {
            dd($ex->getMessage());
        }

    }

    function updateClient(Request $request,$id){

        try {
            $query = new ParseQuery("Client");
            $client = $query->get($id);
            $client->set("name",$request->input('name'));
            $client->save();

            $listeClient = new ParseQuery("Client");
            $client = $listeClient->find();

            return view('inscription', compact('client'));
            // The object was retrieved successfully.
            } catch (ParseException $ex) {
                dd($ex->getMessage());
            }
    }

    function deleteClient($id){
        try {
            $query = new ParseQuery("Client");
            $client = $query->get($id);
            $client->destroy($id);
            $client->save();
            $listeClient = new ParseQuery("Client");
            $client = $listeClient->find();

            return view('inscription', compact('client'));

            // The object was retrieved successfully.
            } catch (ParseException $ex) {
                dd($ex->getMessage());
            }
    }

    function showRelation(){
        $client = new ParseObject("Client");
        $client->set("name", "relation");
        $poste = new ParseObject("Poste");
        $poste->set("poste", "developpeur");
        $poste->set("parent", $client);
        $poste->save();
        //many to many
 
    }
}
