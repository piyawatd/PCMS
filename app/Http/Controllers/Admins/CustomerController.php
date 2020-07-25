<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 19/7/2020 AD
 * Time: 16:43
 */

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\Models\Amphure;
use App\Models\Customer;
use App\Models\Addresses;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;

class CustomerController extends Controller
{
    public function index(){
        return view('Admins.customer.index',['navsel'=>'customer']);
    }

    public function new(){
        $customer = new Customer();
        $customer->local = 'th';
        //shipping
        $shipping = new Addresses();
        $shippingprovince = Province::all();
        $shippingamphure = [];
        $shippingdistrict = [];
        //billing
        $billing = new Addresses();
        $billingprovince = Province::all();
        $billingamphure = [];
        $billingdistrict = [];
        return view('Admins.customer.form',['navsel' => 'customer','mode' => 'new','customer' => $customer,'shipping'=>$shipping,'billing'=>$billing,'shipprovince'=>$shippingprovince,'shipamphure'=>$shippingamphure,'shipdistrict'=>$shippingdistrict,'billprovince'=>$billingprovince,'billamphure'=>$billingamphure,'billdistrict'=>$billingdistrict]);
    }

    public function edit($id){
        $shippingprovince = [];
        $billingprovince = [];
        $shippingamphure = [];
        $billingamphure = [];
        $shippingdistrict = [];
        $billingdistrict = [];
        $customer = Customer::find($id);
        $lang = $customer->local;
        $selfield = '';
        if($lang == 'th'){
            $selfield = 'name_th';
        }else{
            $selfield = 'name_en';
        }
        //shipping
        $shipping = $customer->shipping;
        $shippingprovince = Province::all();
        if(!$shipping){
            $shipping = new Addresses();
            $shippingamphure = getAmphureByProvinceId($shippingprovince[0]->id);
            $shippingdistrict = getDistrictByAmphureId($shippingamphure[0]->id);
        }else{
            $shippingamphure = getAmphureByProvinceName($shippingprovince,$shipping->province,$selfield);
            $shippingdistrict = getDistrictByAmphureName($shippingamphure,$shipping->amphure,$selfield);
        }
        //billing
        $billing = $customer->billing;
        $billingprovince = Province::all();
        if(!$billing){
            $billing = new Addresses();
            $billingamphure = getAmphureByProvinceId($billingprovince[0]->id);
            $billingdistrict = getDistrictByAmphureId($billingamphure[0]->id);
        }else{
            $billingamphure = getAmphureByProvinceName($billingprovince,$billing->province,$selfield);
            $billingdistrict = getDistrictByAmphureName($billingamphure,$billing->amphure,$selfield);
        }
        return view('Admins.customer.form',['navsel' => 'customer','mode' => 'edit','customer' => $customer,'shipping'=>$shipping,'billing'=>$billing,'shipprovince'=>$shippingprovince,'shipamphure'=>$shippingamphure,'shipdistrict'=>$shippingdistrict,'billprovince'=>$billingprovince,'billamphure'=>$billingamphure,'billdistrict'=>$billingdistrict]);
    }

    public function checkEmail(Request $request){
        $count = Customer::where('email',$request->input('value'))
            ->count();
        $result['result'] = false;
        if($count > 0){
            $result['value'] = true;
        }
        return $result;
    }

    public function create(Request $request){
        $customer = New Customer();
        $billing = New Addresses();
        $shipping = New Addresses();
        $this->updateDatabase($customer,$billing,$shipping,$request);
        return redirect()->route('admincustomer')->with('success', 'customer saved!');

    }

    public function update($id,Request $request){
        $customer = Customer::find($id);
        $billing = Addresses::where('customer',$customer->id)
            ->where('type','billing')
            ->first();
        $shipping = Addresses::where('customer',$customer->id)
            ->where('type','shipping')
            ->first();
        $this->updateDatabase($customer,$billing,$shipping,$request);
        return redirect()->route('admincustomer')->with('success', 'customer updated!');
    }

    public function updateDatabase(CustomerController $customer, Addresses $billing, Addresses $shipping, Request $request){
        $request->validate([
            'email'=>'required'
        ]);
        $customer->email = $request->input('email');
        if(!empty($request->input('password')))
        {
            $customer->password = Hash::make($request->input('password'));
        }
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        $customer->phone = $request->input('phone');
        $customer->status = True;
        $customer->save();
        //shipping
        $shipping->address = $request->input('shipping_address');
        $shipping->province = $request->input('shipping_province');
        $shipping->amphure = $request->input('shipping_amphure');
        $shipping->district = $request->input('shipping_district');
        $shipping->zipcode = $request->input('shipping_zipcode');
        $shipping->type = 'shipping';
        $shipping->customer = $customer->id;
        $shipping->save();
        //billing
        $billing->address = $request->input('billing_address');
        $billing->province = $request->input('billing_province');
        $billing->amphure = $request->input('billing_amphure');
        $billing->district = $request->input('billing_district');
        $billing->zipcode = $request->input('billing_zipcode');
        $billing->type = 'billing';
        $billing->customer = $customer->id;
        $shipping->save();
    }

    public function delete($id){
        $result['result'] = false;
        $customer = Customer::find($id);
//        $countContent = Content::where('customer','=',$id)->count();
//        if ($countContent == 0){
        $customer->status = False;
        $customer->save();
        $result['result'] = true;
//        }
        return $result;
    }

    public function list(Request $request)
    {
        // https://shareurcodes.com/blog/laravel%20datatables%20server%20side%20processing
        $columns = array(
            0 => 'firstname',
            1 => 'lastname',
            2 => 'email',
            3 => 'phone',
        );

        $totalData = Customer::where('status',true)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $customers = Customer::where('status',true)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $customers =  Customer::where('status',true)
                ->orWhere('firstname', 'LIKE',"%{$search}%")
                ->orWhere('lastname', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('phone', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = Customer::where('status',true)
                ->orWhere('firstname', 'LIKE',"%{$search}%")
                ->orWhere('lastname', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('phone', 'LIKE',"%{$search}%")
                ->count();
        }

        $data = array();
        if(!empty($customers))
        {
            foreach ($customers as $customer)
            {
                $edit =  route('admincustomeredit',$customer->id);
                $fullname = $customer->firstname." ".$customer->lastname;
                $nestedData['firstname'] = $customer->firstname;
                $nestedData['lastname'] = $customer->lastname;
                $nestedData['email'] = $customer->email;
                $nestedData['phone'] = $customer->phone?:'';
                $nestedData['options'] = "<a href=".$edit." title=\"แก้ไข\" class=\"btn btn-info btn-circle\"><i class=\"fas fa-edit\"></i></a>&emsp;<a href=\"javascript:deleteitem('".$customer->id."','".$fullname."');\" title=\"ลบ\" class=\"btn btn-danger btn-circle\"><i class=\"fas fa-trash\"></i></a>";
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
