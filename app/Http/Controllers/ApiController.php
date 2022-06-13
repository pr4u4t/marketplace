<?php

namespace App\Http\Controllers;

use App\Exceptions\RedirectException;
use App\Exceptions\RequestException;
use App\Http\Requests\Product\NewBasicRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller{
	public function api_method(Request $request){
		return $request->user();
	}
}
