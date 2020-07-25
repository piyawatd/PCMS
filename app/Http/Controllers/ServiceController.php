<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 25/7/2020 AD
 * Time: 12:37
 */

namespace App\Http\Controllers;


use App\Models\Amphure;
use App\Models\District;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAmphure(Request $request){
        return Amphure::where('province_id',$request->input('id'))->get();
    }

    public function getDistrict(Request $request){
        return District::where('amphure_id',$request->input('id'))->get();
    }
}
