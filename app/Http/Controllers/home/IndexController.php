<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{

    public function index(Request $request)
    {

        return view('home.index');
    }
}
