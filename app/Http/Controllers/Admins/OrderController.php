<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 15/7/2020 AD
 * Time: 17:54
 */

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        return view('Admins.order.index',['navsel'=>'order']);
    }

    public function new(){
        $order = new Order();
        $order->publish_date = now();
        $category = Category::where('status',true)->get();
        return view('Admins.order.form',['navsel' => 'order','mode' => 'new','order' => $order,'category'=>$category]);
    }

    public function edit($id){
        $order = Order::find($id);
        $orderItems = $order->Items;
        $billing = $order->Billing;
        $shipping = $order->Shipping;
        $customer = $order->CustomerData;
        return view('Admins.order.form',['navsel' => 'order','mode' => 'edit','order' => $order,'orderItems'=>$orderItems,'$billing'=>$$billing,'$shipping'=>$shipping,'customer'=>$customer]);
    }

    public function checkAlias(Request $request){
        $count = Order::where('alias',$request->input('value'))
            ->count();
        $result['result'] = false;
        if($count > 0){
            $result['value'] = true;
        }
        return $result;
    }

    public function create(Request $request){
        $order = New Order();
        $this->updateDatabase($order,$request);
        return redirect()->route('adminorder')->with('success', 'บันทึกสินค้าสำเร็จ!');

    }

    public function update($id,Request $request){
        $order = Order::find($id);
        $this->updateDatabase($order,$request);
        return redirect()->route('adminorder')->with('success', 'อัพเดทสินค้าสำเร็จ!');
    }

    public function gallery($id){
        $order = Order::find($id);
        $gallery = OrderGallery::where('order',$id)->get();
        return view('Admins.order.gallery',['navsel' => 'order','order'=>$order,'gallery' => $gallery]);
    }

    public function galleryupdate($id,Request $request){
        $order = Order::find($id);
        $gallery = OrderGallery::where('order',$id)->get();
        foreach ($gallery as $item) {
            $item->delete();
        }
        $imageg = $request->input('image');
        for($i = 0; $i <= sizeof($imageg)-1;$i++) {
            $qobj = new OrderGallery;
            $qobj->image = $imageg[$i];
            $qobj->order = $id;
            $qobj->save();
        }
        return redirect()->route('adminorder')->with('success', 'บันทึก Gallery สำเร็จ');
    }

    public function updateDatabase(Order $order,Request $request){
        $order->title_th = $request->input('title_th');
        $order->title_en = $request->input('title_en');
        $order->intro_th = $request->input('intro_th');
        $order->intro_en = $request->input('intro_en');
        $order->detail_th = $request->input('detail_th');
        $order->detail_en = $request->input('detail_en');
        $order->alias = $request->input('alias');
        $order->sku = $request->input('sku');
        $order->price = $request->input('price');
        $order->seokey = $request->input('seokey');
        $order->seodescription = $request->input('seodescription');
        $order->thumbnail = $request->input('thumbnail');
        if($request->input('hilight')  == 'on' ){
            $order->hilight = true;
        }else{
            $order->hilight = false;
        }
        if($request->input('publish')  == 'on' ){
            $order->publish = true;
        }else{
            $order->publish = false;
        }
        $order->publish_date = date_create_from_format('d/m/Y',$request->input('publish_date'));
        $order->category = $request->input('category');
        $order->status = True;
        $order->save();
    }

    public function delete($id){
        $result['result'] = false;
        $order = Order::find($id);
//        $countOrder = Order::where('order','=',$id)->count();
//        if ($countOrder == 0){
        $order->status = False;
        $order->save();
        $result['result'] = true;
//        }
        return $result;
    }

    public function publish($id){
        $result['result'] = false;
        $order = Order::find($id);
        if($order->publish){
            $order->publish = false;
        }else{
            $order->publish = true;
        }
        $order->save();
        $result['result'] = true;
        return $result;
    }

    public function list(Request $request)
    {
        // https://shareurcodes.com/blog/laravel%20datatables%20server%20side%20processing
        $columns = array(
            0 => 'order_no',
            1 => 'order_date',
            2 => 'customername',
            3 => 'grand_total',
        );

        $totalData = Order::where('status',true)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $orders = Order::join('customers', 'orders.customer', '=', 'customers.id')
                ->select(
                    'orders.id',
                    'orders.order_no',
                    'orders.order_date',
                    'orders.grand_total',
                    'orders.status',
                    DB::raw("CONCAT(customers.firstname,' ',customers.lastname) AS customername")
                )
                ->where('orders.status',true)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $orders = Order::join('customers', 'orders.customer', '=', 'customers.id')
                ->select(
                    'orders.id',
                    'orders.order_no',
                    'orders.order_date',
                    'orders.grand_total',
                    'orders.status',
                    'customers.firstname',
                    'customers.lastname',
                    DB::raw("CONCAT(customers.firstname,' ',customers.lastname) AS customername")
                )
                ->where('orders.status',true)
                ->orWhere('order_no', 'LIKE',"%{$search}%")
                ->orWhere('customers.firstname', 'LIKE',"%{$search}%")
                ->orWhere('customers.lastname', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Order::join('customers', 'orders.customer', '=', 'customers.id')
                ->where('orders.status',true)
                ->orWhere('order_no', 'LIKE',"%{$search}%")
                ->orWhere('customers.firstname', 'LIKE',"%{$search}%")
                ->orWhere('customers.lastname', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($orders))
        {
            foreach ($orders as $order)
            {
                $edit =  route('adminorderedit',$order->id);
                $nestedData['order_no'] = $order->order_no;
                $nestedData['order_date'] = $order->order_date?date('d/m/Y H:i', strtotime($order->order_date)):'';
                $nestedData['customername'] = $order->customername;
                $nestedData['grand_total'] = number_format($order->grand_total);
                $nestedData['options'] = "
                <a href=".$edit." title=\"แก้ไข\" class=\"btn btn-info btn-circle\"><i class=\"fas fa-edit\"></i></a>&emsp;
                <a href=\"javascript:deleteitem('".$order->id."','".$order->alias."');\" title=\"ลบ\" class=\"btn btn-danger btn-circle\"><i class=\"fas fa-trash\"></i></a>";
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
