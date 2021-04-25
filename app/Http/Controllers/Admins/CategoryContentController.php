<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 18/6/2020 AD
 * Time: 10:32
 */

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\CategoryContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class CategoryContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('Admins.categorycontent.index',['navsel'=>'categorycontent']);
    }

    public function new(){
        return view('Admins.categorycontent.form',['navsel' => 'categorycontent','mode' => 'new','categorycontent' => new CategoryContent()]);
    }

    public function edit($id){
        return view('Admins.categorycontent.form',['navsel' => 'categorycontent','mode' => 'edit','categorycontent' => CategoryContent::find($id)]);
    }

    public function checkAlias(Request $request){
        $count = CategoryContent::where('alias',$request->input('value'))
            ->count();
        $result['result'] = false;
        if($count > 0){
            $result['value'] = true;
        }
        return $result;
    }

    public function create(Request $request){
        $categorycontent = New CategoryContent();
        $this->updateDatabase($categorycontent,$request);
        return redirect()->route('admincategorycontent')->with('success', 'categorycontent saved!');

    }

    public function update($id,Request $request){
        $categorycontent = CategoryContent::find($id);
        $this->updateDatabase($categorycontent,$request);
        return redirect()->route('admincategorycontent')->with('success', 'categorycontent updated!');
    }

    public function updateDatabase(CategoryContent $categorycontent,Request $request){
        $request->validate([
            'name_th'=>'required'
        ]);
        $categorycontent->name_th = $request->input('name_th');
        $categorycontent->name_en = $request->input('name_en');
        $categorycontent->detail_th = $request->input('detail_th');
        $categorycontent->detail_en = $request->input('detail_en');
        $categorycontent->alias = $request->input('alias');
        $categorycontent->image = $request->input('image');
        $categorycontent->order_number = $request->input('order_number');
        $categorycontent->status = True;
        $categorycontent->save();
    }

    public function delete($id){
        $result['result'] = false;
        $categorycontent = CategoryContent::find($id);
//        $countContent = Content::where('categorycontent','=',$id)->count();
//        if ($countContent == 0){
            $categorycontent->status = False;
            $categorycontent->save();
            $result['result'] = true;
//        }
        return $result;
    }

    public function list(Request $request)
    {
        // https://shareurcodes.com/blog/laravel%20datatables%20server%20side%20processing
        $columns = array(
            0 => 'name_th',
            1 => 'name_en',
            2 => 'alias',
            3 => 'id',
        );

        $totalData = CategoryContent::where('status',true)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $categorycontents = CategoryContent::where('status',true)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $categorycontents =  CategoryContent::where('status',true)
                ->orWhere('name_th', 'LIKE',"%{$search}%")
                ->orWhere('name_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = CategoryContent::where('status',true)
                ->orWhere('name_th', 'LIKE',"%{$search}%")
                ->orWhere('name_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($categorycontents))
        {
            foreach ($categorycontents as $categorycontent)
            {
                $edit =  route('admincategorycontentedit',$categorycontent->id);
                $nestedData['name_th'] = $categorycontent->name_th;
                $nestedData['name_en'] = $categorycontent->name_en?:'';
                $nestedData['alias'] = $categorycontent->alias;
                $nestedData['order_number'] = $categorycontent->order_number;
                $nestedData['options'] = "<a href=".$edit." title=\"แก้ไข\" class=\"btn btn-info btn-circle\"><i class=\"fas fa-edit\"></i></a>&emsp;<a href=\"javascript:deleteitem('".$categorycontent->id."','".$categorycontent->alias."');\" title=\"ลบ\" class=\"btn btn-danger btn-circle\"><i class=\"fas fa-trash\"></i></a>";
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}
