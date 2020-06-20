<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{

/*
	public function __construct()
    {
        $this->middleware('auth');
    }
*/
	public function index(){
	    App::setLocale('th');
        session(['page' => 'index']);
        return view('Admins.admin.index');
    }

	public function table(){
        return view('Admins.admin.table');
    }

}
