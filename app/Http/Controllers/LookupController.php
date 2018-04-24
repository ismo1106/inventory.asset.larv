<?php

namespace App\Http\Controllers;

use App\Models\Lookup;
use App\Http\Controllers\Controller;

class LookupController extends Controller
{
   
    public function index()
    {
		$idi = Lookup::where('type','pernikahan')->where('value','1')->select('name')->first();
		dd($idi);
        return "sas";
    }
}