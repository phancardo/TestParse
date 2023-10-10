<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parse\HttpClients\ParseCurlHttpClient;
use Parse\ParseClient;

class Parse extends Model
{
    public function initParse(){
        ParseClient::initialize( 'CPP_DEMO', '>Hp5uE@Nk+kvLe}w', ':XUbDFu:b:Hj\K2' );
        ParseClient::setServerURL('http://172.16.1.2:1333','parse');
        $health = ParseClient::getServerHealth();

        ParseClient::setHttpClient(new ParseCurlHttpClient());
        if($health['status'] === 200) {
            return "ok";
        }
    }
}
