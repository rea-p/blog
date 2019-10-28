<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class DebugController extends Controller
{
    public function index()
    {
        return view('pages.debug');
    }
}
