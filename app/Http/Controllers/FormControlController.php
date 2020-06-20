<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class FormControlController extends Controller
{
    //
    public function index(){
        return view('formcontrol');
    }

    public function upload(Request $request)
    {
        $allowedfileExtension=['jpg','png'];
        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);
        if($check) {
            $destinationPath = 'public/upload/';
            $file->move($destinationPath,'test_'.$file->getClientOriginalName());
        }else{
            echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
        }

    }

    public function deletefile(Request $request)
    {
        $destinationPath = 'public/upload/'.$request->input('filename');
        File::delete($destinationPath);   
    }
}
