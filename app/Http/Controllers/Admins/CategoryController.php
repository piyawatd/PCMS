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
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(){
        return view('Admins.category.index',['navsel'=>'category']);
    }

    public function new(){
        return view('Admins.category.form',['navsel' => 'category','mode' => 'new','category' => new Category]);
    }

    public function edit($id){
        return view('Admins.category.form',['navsel' => 'category','mode' => 'edit','category' => Category::find($id)]);
    }

    public function create(Request $request){
        $request->validate([
            'name_th'=>'required'
        ]);
        $category = New Category();
        $category->name_th = $request->input('name_th');
        $category->name_en = $request->input('name_en');
        $category->detail = $request->input('detail');
        $category->save();
        return redirect()->route('admincategory')->with('success', 'category saved!');

    }

    public function update($id,Request $request){
        $request->validate([
            'title'=>'required'
        ]);
        $category = Category::find($id);
        $category->title = $request->input('title');
        $category->detail = $request->input('detail');
        $category->save();
        return redirect()->route('admincategory')->with('success', 'category updated!');
    }

    public function delete($id){
        $category = Category::find($id);
        $countContent = Content::where('category','=',$id)->count();
        if ($countContent > 0){
            $json_data = array(
                "result" => false
            );
            echo json_encode($json_data);
        }else{
            $category->delete();
            $json_data = array(
                "result" => true
            );
            echo json_encode($json_data);
        }
    }

    public function all(Request $request)
    {
        // https://shareurcodes.com/blog/laravel%20datatables%20server%20side%20processing
        $columns = array(
            0 => 'title',
            1 => 'id',
        );

        $totalData = Category::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $categorys = Category::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $categorys =  Category::where('id','LIKE',"%{$search}%")
                ->orWhere('title', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Category::where('title','LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($categorys))
        {
            foreach ($categorys as $category)
            {
                $edit =  route('categoryedit',$category->id);

                $nestedData['id'] = $category->id;
                $nestedData['title'] = $category->title;
                $nestedData['options'] = "&emsp;<a href='{$edit}' title='แก้ไข' class='btn btn-default'><span class='glyphicon glyphicon-edit'></span></a>
                                          &emsp;<a href='javascript:void(0);' title='ลบ' class='btn btn-danger'><span class='glyphicon glyphicon-trash' onclick=\"deleteitem('".$category->id."','".$category->title."');\"></span></a>";
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
