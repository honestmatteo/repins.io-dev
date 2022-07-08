<?php

use Illuminate\Support\Facades\Route;
use Respins\BaseFunctions;
use Illuminate\Http\Request;

//Routes directly used for game proxy



Route::match(['get', 'post', 'head', 'patch', 'put', 'delete'] , 'bets.io/{slug}', function(Request $request){
    return ProxyHelperFacade::CreateProxy($request)->toHost('https://api.bets.io/', 'api/bets.io');
})->where('slug', '([A-Za-z0-9\-\/]+)');