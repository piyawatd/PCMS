<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 18/6/2020 AD
 * Time: 10:32
 */

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('Admins.category.index',['navsel'=>'category']);
    }

    public function new(){
        return view('Admins.category.form',['navsel' => 'category','mode' => 'new','category' => new Category]);
    }

    public function edit($id){
        return view('Admins.category.form',['navsel' => 'category','mode' => 'edit','category' => Category::find($id)]);
    }

    public function checkAlias(Request $request){
        $count = Category::where('alias',$request->input('value'))
            ->count();
        $result['result'] = false;
        if($count > 0){
            $result['value'] = true;
        }
        return $result;
    }

    public function create(Request $request){
        $category = New Category();
        $this->updateDatabase($category,$request);
        return redirect()->route('admincategory')->with('success', 'category saved!');

    }

    public function update($id,Request $request){
        $category = Category::find($id);
        $this->updateDatabase($category,$request);
        return redirect()->route('admincategory')->with('success', 'category updated!');
    }

    public function updateDatabase(Category $category,Request $request){
        $request->validate([
            'name_th'=>'required'
        ]);
        $category->name_th = $request->input('name_th');
        $category->name_en = $request->input('name_en');
        $category->detail_th = $request->input('detail_th');
        $category->detail_en = $request->input('detail_en');
        $category->alias = $request->input('alias');
        $category->image = $request->input('image');
        $category->order_number = $request->input('order_number');
        $category->status = True;
        $category->save();
    }

    public function delete($id){
        $result['result'] = false;
        $category = Category::find($id);
//        $countContent = Content::where('category','=',$id)->count();
//        if ($countContent == 0){
            $category->status = False;
            $category->save();
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

        $totalData = Category::where('status',true)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $categorys = Category::where('status',true)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $categorys =  Category::where('status',true)
                ->orWhere('name_th', 'LIKE',"%{$search}%")
                ->orWhere('name_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Category::where('status',true)
                ->orWhere('name_th', 'LIKE',"%{$search}%")
                ->orWhere('name_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($categorys))
        {
            foreach ($categorys as $category)
            {
                $edit =  route('admincategoryedit',$category->id);
                $nestedData['name_th'] = $category->name_th;
                $nestedData['name_en'] = $category->name_en?:'';
                $nestedData['alias'] = $category->alias;
                $nestedData['order_number'] = $category->order_number;
                $nestedData['options'] = "<a href=".$edit." title=\"แก้ไข\" class=\"btn btn-info btn-circle\"><i class=\"fas fa-edit\"></i></a>&emsp;<a href=\"javascript:deleteitem('".$category->id."','".$category->alias."');\" title=\"ลบ\" class=\"btn btn-danger btn-circle\"><i class=\"fas fa-trash\"></i></a>";
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
