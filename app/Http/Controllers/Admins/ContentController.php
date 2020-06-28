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
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class ContentController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(){
        return view('Admins.content.index',['navsel'=>'content']);
    }

    public function new(){
        $content = new Content();
        $content->publish_date = now();
        $category = Category::where('status',true)->get();
        return view('Admins.content.form',['navsel' => 'content','mode' => 'new','content' => $content,'category'=>$category]);
    }

    public function edit($id){
        $category = Category::where('status',true)->get();
        return view('Admins.content.form',['navsel' => 'content','mode' => 'edit','content' => Content::find($id),'category'=>$category]);
    }

    public function checkAlias(Request $request){
        $count = Content::where('alias',$request->input('value'))
            ->count();
        $result['result'] = false;
        if($count > 0){
            $result['value'] = true;
        }
        return $result;
    }

    public function create(Request $request){
        $content = New Content();
        $this->updateDatabase($content,$request);
        return redirect()->route('admincontent')->with('success', 'content saved!');

    }

    public function update($id,Request $request){
        $content = Content::find($id);
        $this->updateDatabase($content,$request);
        return redirect()->route('admincontent')->with('success', 'content updated!');
    }

    public function gallery($id){
        return view('Admins.content.form',['navsel' => 'content','content' => Content::find($id)]);
    }

    public function updateDatabase(Content $content,Request $request){
        $content->title_th = $request->input('title_th');
        $content->title_en = $request->input('title_en');
        $content->intro_th = $request->input('intro_th');
        $content->intro_en = $request->input('intro_en');
        $content->detail_th = $request->input('detail_th');
        $content->detail_en = $request->input('detail_en');
        $content->alias = $request->input('alias');
        $content->seokey = $request->input('seokey');
        $content->seodescription = $request->input('seodescription');
        $content->thumbnail = $request->input('thumbnail');
        if($request->input('hilight')  == 'on' ){
            $content->hilight = true;
        }else{
            $content->hilight = false;
        }
        if($request->input('publish')  == 'on' ){
            $content->publish = true;
        }else{
            $content->publish = false;
        }
        $content->publish_date = date_create_from_format('d/m/Y',$request->input('publish_date'));
        $content->category_content = $request->input('category_content');
        $content->status = True;
        $content->save();
    }

    public function delete($id){
        $result['result'] = false;
        $content = Content::find($id);
//        $countContent = Content::where('content','=',$id)->count();
//        if ($countContent == 0){
        $content->status = False;
        $content->save();
        $result['result'] = true;
//        }
        return $result;
    }

    public function publish($id){
        $result['result'] = false;
        $content = Content::find($id);
        if($content->publish){
            $content->publish = false;
        }else{
            $content->publish = true;
        }
        $content->save();
        $result['result'] = true;
        return $result;
    }

    public function list(Request $request)
    {
        // https://shareurcodes.com/blog/laravel%20datatables%20server%20side%20processing
        $columns = array(
            0 => 'title_th',
            1 => 'title_en',
            2 => 'alias',
            3 => 'id',
        );

        $totalData = Content::where('status',true)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $contents = Content::where('status',true)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $contents =  Content::where('status',true)
                ->orWhere('title_th', 'LIKE',"%{$search}%")
                ->orWhere('title_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Content::where('status',true)
                ->orWhere('title_th', 'LIKE',"%{$search}%")
                ->orWhere('title_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($contents))
        {
            foreach ($contents as $content)
            {
                $edit =  route('admincontentedit',$content->id);
                $gallery =  route('admincontentgallery',$content->id);
                $publish = "<a href=\"javascript:publishitem('".$content->id."','ต้องการ Un Publish ".$content->alias." ?');\" title=\"Un Publish\" class=\"btn btn-primary btn-circle\"><i class=\"fas fa-eye\"></i></a>";
                if(!$content->publish){
                    $publish = "<a href=\"javascript:publishitem('".$content->id."','ต้องการ Publish ".$content->alias." ?');\" title=\"Publish\" class=\"btn btn-warning btn-circle\"><i class=\"fas fa-eye-slash\"></i></a>";
                }
                $nestedData['title_th'] = $content->title_th;
                $nestedData['title_en'] = $content->title_en?:'';
                $nestedData['alias'] = $content->alias;
                $nestedData['publish'] = $publish;
                $nestedData['options'] = "
                <a href=".$edit." title=\"แก้ไข\" class=\"btn btn-info btn-circle\"><i class=\"fas fa-edit\"></i></a>&emsp;
                <a href=".$gallery." title=\"Gallery\" class=\"btn btn-primary btn-circle\"><i class=\"fas fa-images\"></i></a>&emsp;
                <a href=\"javascript:deleteitem('".$content->id."','".$content->alias."');\" title=\"ลบ\" class=\"btn btn-danger btn-circle\"><i class=\"fas fa-trash\"></i></a>";
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
