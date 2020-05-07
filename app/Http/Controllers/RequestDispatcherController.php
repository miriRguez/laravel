<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessRequest;

class RequestDispatcherController extends Controller
{
    public static function postRequest($url, $params) {
       $result =  ProcessRequest::dispatch($url, $params);
    }
}
