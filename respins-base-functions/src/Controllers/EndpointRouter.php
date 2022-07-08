<?php
namespace Respins\BaseFunctions\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Respins\BaseFunctions\Traits\ApiResponseHelper;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;

class EndpointRouter
{
    use ApiResponseHelper;
    
    public function createSessionValidation(Request $request) {
        $validator = Validator::make($request->all(), [
            'game' => ['required', 'max:30', 'min:3'],
            'currency' => ['required', 'min:2', 'max:40'],
            'player' => ['required', 'min:3', 'max:100', 'regex:/^[^(\|\]`!%^&=};:?><’)]*$/'],
            'currency' => ['required', 'min:2', 'max:7'],
            'mode' => ['required', 'min:2', 'max:15'],
        ]);

        $ip = $_SERVER['REMOTE_ADDR'];
        if($ip === NULL || !$ip) {
            $ip = $request->header('CF-Connecting-IP');
            if($ip === NULL) {
              $ip = $request->ip();  
            }
        }

        if ($validator->stopOnFirstFailure()->fails()) {
            $errorReason = $validator->errors()->first();
            $prepareResponse = array('message' => $errorReason, 'request_ip' => $ip);
            return $this->respondError($prepareResponse);
        }

        return $this->respondOk();
    }
    
    ## Endpoint Relay (mitm)
    # Validate then send along to specific game routing
    public function createSession(Request $request)
    {   
        $validate = $this->createSessionValidation($request);
        if($validate->status() !== 200) {
            return $validate;
        }  
    }
}