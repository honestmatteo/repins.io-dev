<?php
namespace Respins\BaseFunctions\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Respins\BaseFunctions\Traits\ApiResponseHelper;
class EndpointRouter
{
    use ApiResponseHelper;
    
    public function createSession() {
        $test = array('hello => omega', 'ye' => 'ye');
        return $this->respondForbidden($test);

    }


    

}