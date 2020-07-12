<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MemberController extends Controller
{
    public function __construct()
    {
//        $this->middleware('authmember');
    }

    public function index(){
        return view('member.index');
    }

}
