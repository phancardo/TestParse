<?php

namespace App\Http\Controllers;

use App\Client;
use App\Parse;
use Illuminate\Http\Request;
use Parse\ParseACL;
use Parse\ParseException;
use Parse\ParseGeoPoint;
use Parse\ParseObject;
use Parse\ParsePolygon;
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
        // $roleACL = new ParseACL();
        // $roleACL->setPublicReadAccess(true);
        // $role = ParseRole::createRole("Administrator", $roleACL);
        //$role->set("user",$user);
        try {
            //$role->save();
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

    function ListeAdresse(){

        try {
        $query = new ParseQuery("Arret");
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
        $geoPoint1 = new ParseGeoPoint(31.75, -120.68);
        $geoPoint2 = new ParseGeoPoint(37.75, -125.68);
        $geoPoint3 = new ParseGeoPoint(30.75, -122.68);
        $polygon = new ParsePolygon([$geoPoint1,$geoPoint2,$geoPoint3]);
        $poly = new ParseObject("Arret");
        $poly->set('listePoint', $polygon);
        $poly->save();
        $client->set("name", "gINOT");
        $client->set("tableauArret", $poly);
        $poste = new ParseObject("Poste");
        $poste->set("poste_nom", "FULLSTACK");
        $poste->set("parent", $client);
        $poste->save();


    }
    function showRelationData(){

        try {
        $query = new ParseQuery("Client");
        $client = $query->get("KjuAqZnpub");
        $client->fetch();
        $listeArret = $client->get("tableauArret");
        //$poste_nom = $poste->get("poste_nom");
        //dd($poste);
        $listeArret->fetch();
        dd($listeArret->get("listePoint"));
        die();
       return view('inscription', compact('client'));
        // The object was retrieved successfully.
        } catch (ParseException $ex) {
            dd($ex->getMessage());
        }

    }

    function insertionCoo(Request $request){
        $coo = new ParseObject("Cooperative");

    }
    function map(){
        $query = new ParseQuery("Arret");
        $arret = $query->get('sBeQqiXwyx');
        $listepoint = $arret->get('listePoint');


        $query = new ParseQuery("Arret");
        $arret = $query->find();
        //dd($arret);
        $arretLength = count($arret);
        $points = array();
        //  dd($arretLength);
        for($i=0;$i<count($arret);$i++){
            $points[$i] = $arret[$i]->get('listePoint')->getCoordinates();
        }
        //dd($points);
        //$listepoint = "";
        //$listepoint->getCoordinates();
       //dd($listepoint->getCoordinates());

        return view('map',['point'=> $points]);
    }
}
