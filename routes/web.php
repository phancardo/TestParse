<?php

use Illuminate\Support\Facades\Route;
use Parse\ParseQuery;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/insertionClient', 'ClientController@insertionClient')->name(('insertionClient'));
Route::get('/getClient', 'ClientController@getClient');
Route::get('/listeclient', 'ClientController@ListeClient');
Route::put('/updateclient/{id}', 'ClientController@updateClient')->name('updateClient');
Route::delete('/deleteClient/{id}', 'ClientController@deleteClient')->name('deleteClient');

//User
Route::post('/insertionUser', 'UtilisateurController@saveUser')->name(('insertionUser'));
Route::post('/loginUser', 'UtilisateurController@loginUser')->name(('loginUser'));
Route::get('/getUser', 'ClientController@getUser');
//Coo

Route::get('/insertionCoo', 'ClientController@insertionCoo')->name(('insertionCoo'));
//relation
Route::get('/showRelation', 'ClientController@showRelation')->name(('showRelation'));
Route::get('/showRelationData', 'ClientController@showRelationData')->name(('showRelationData'));
Route::get('/map', 'ClientController@map')->name(('map'));



Route::get('/users', function () {
    $query = new ParseQuery("_User");
            $users = $query->find();

            return view('users', compact('users'));

});
Route::get('/', function () {
    $query = new ParseQuery("Client");
    $client = $query->find();
    return view('inscription',[
        'client'=>$client
    ]);

});

Route::get('/login', function () {
    return view('login');

});

