<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class FileManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manager(){
        return view('Admins.el.manager',['navsel' => 'file']);
    }

    public function elbrowse(Request $request){
        return view('Admins.el.browseel',['type' => $request->input('type'),'folder' => $request->input('folder')]);
    }
//
    public function ckbrowse(Request $request){
        return view('Admins.el.browseck',['type' => 'content','CKEditorFuncNum' => $request->input('CKEditorFuncNum')]);
    }
//
//    public function ckimage(Request $request){
//        $fileName = "fileName".time().'.'.request()->upload->getClientOriginalExtension();
//
//        $request->upload->storeAs('/public/upload/ck',$fileName);
//        $json_data = array(
//            "filename" => $fileName,
//            "uploaded" => 1,
//            "url" => "/public/upload/ck/".$fileName
//        );
//        echo json_encode($json_data);
//    }
//
//    public function ckdelete(Request $request){
//        $filename = $request->input('fileName');
//        Storage::delete('/public/upload/ck/'.$filename);
//        $json_data = array(
//            "status" => true
//        );
//        echo json_encode($json_data);
//    }
}
