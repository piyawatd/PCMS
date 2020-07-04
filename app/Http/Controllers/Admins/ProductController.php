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
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class ProductController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(){
        return view('Admins.product.index',['navsel'=>'product']);
    }

    public function new(){
        $product = new Product();
        $product->publish_date = now();
        $category = Category::where('status',true)->get();
        return view('Admins.product.form',['navsel' => 'product','mode' => 'new','product' => $product,'category'=>$category]);
    }

    public function edit($id){
        $category = Category::where('status',true)->get();
        return view('Admins.product.form',['navsel' => 'product','mode' => 'edit','product' => Product::find($id),'category'=>$category]);
    }

    public function checkAlias(Request $request){
        $count = Product::where('alias',$request->input('value'))
            ->count();
        $result['result'] = false;
        if($count > 0){
            $result['value'] = true;
        }
        return $result;
    }

    public function create(Request $request){
        $product = New Product();
        $this->updateDatabase($product,$request);
        return redirect()->route('adminproduct')->with('success', 'บันทึกสินค้าสำเร็จ!');

    }

    public function update($id,Request $request){
        $product = Product::find($id);
        $this->updateDatabase($product,$request);
        return redirect()->route('adminproduct')->with('success', 'อัพเดทสินค้าสำเร็จ!');
    }

    public function gallery($id){
        $product = Product::find($id);
        $gallery = ProductGallery::where('product',$id)->get();
        return view('Admins.product.gallery',['navsel' => 'product','product'=>$product,'gallery' => $gallery]);
    }

    public function galleryupdate($id,Request $request){
        $product = Product::find($id);
        $gallery = ProductGallery::where('product',$id)->get();
        foreach ($gallery as $item) {
            $item->delete();
        }
        $imageg = $request->input('image');
        for($i = 0; $i <= sizeof($imageg)-1;$i++) {
            $qobj = new ProductGallery;
            $qobj->image = $imageg[$i];
            $qobj->product = $id;
            $qobj->save();
        }
        return redirect()->route('adminproduct')->with('success', 'บันทึก Gallery สำเร็จ');
    }

    public function updateDatabase(Product $product,Request $request){
        $product->title_th = $request->input('title_th');
        $product->title_en = $request->input('title_en');
        $product->intro_th = $request->input('intro_th');
        $product->intro_en = $request->input('intro_en');
        $product->detail_th = $request->input('detail_th');
        $product->detail_en = $request->input('detail_en');
        $product->alias = $request->input('alias');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->seokey = $request->input('seokey');
        $product->seodescription = $request->input('seodescription');
        $product->thumbnail = $request->input('thumbnail');
        if($request->input('hilight')  == 'on' ){
            $product->hilight = true;
        }else{
            $product->hilight = false;
        }
        if($request->input('publish')  == 'on' ){
            $product->publish = true;
        }else{
            $product->publish = false;
        }
        $product->publish_date = date_create_from_format('d/m/Y',$request->input('publish_date'));
        $product->category = $request->input('category');
        $product->status = True;
        $product->save();
    }

    public function delete($id){
        $result['result'] = false;
        $product = Product::find($id);
//        $countProduct = Product::where('product','=',$id)->count();
//        if ($countProduct == 0){
        $product->status = False;
        $product->save();
        $result['result'] = true;
//        }
        return $result;
    }

    public function publish($id){
        $result['result'] = false;
        $product = Product::find($id);
        if($product->publish){
            $product->publish = false;
        }else{
            $product->publish = true;
        }
        $product->save();
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

        $totalData = Product::where('status',true)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $products = Product::where('status',true)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $products =  Product::where('status',true)
                ->orWhere('title_th', 'LIKE',"%{$search}%")
                ->orWhere('title_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Product::where('status',true)
                ->orWhere('title_th', 'LIKE',"%{$search}%")
                ->orWhere('title_en', 'LIKE',"%{$search}%")
                ->orWhere('alias', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($products))
        {
            foreach ($products as $product)
            {
                $edit =  route('adminproductedit',$product->id);
                $gallery =  route('adminproductgallery',$product->id);
                $publish = "<a href=\"javascript:publishitem('".$product->id."','ต้องการ Un Publish ".$product->alias." ?');\" title=\"Un Publish\" class=\"btn btn-primary btn-circle\"><i class=\"fas fa-eye\"></i></a>";
                if(!$product->publish){
                    $publish = "<a href=\"javascript:publishitem('".$product->id."','ต้องการ Publish ".$product->alias." ?');\" title=\"Publish\" class=\"btn btn-warning btn-circle\"><i class=\"fas fa-eye-slash\"></i></a>";
                }
                $nestedData['title_th'] = $product->title_th;
                $nestedData['title_en'] = $product->title_en?:'';
                $nestedData['alias'] = $product->alias;
                $nestedData['publish'] = $publish;
                $nestedData['options'] = "
                <a href=".$edit." title=\"แก้ไข\" class=\"btn btn-info btn-circle\"><i class=\"fas fa-edit\"></i></a>&emsp;
                <a href=".$gallery." title=\"Gallery\" class=\"btn btn-primary btn-circle\"><i class=\"fas fa-images\"></i></a>&emsp;
                <a href=\"javascript:deleteitem('".$product->id."','".$product->alias."');\" title=\"ลบ\" class=\"btn btn-danger btn-circle\"><i class=\"fas fa-trash\"></i></a>";
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
