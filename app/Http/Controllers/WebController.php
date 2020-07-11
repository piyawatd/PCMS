<?php
/**
 * Created by IntelliJ IDEA.
 * User: piyawat
 * Date: 9/6/2020 AD
 * Time: 13:24
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contactus;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Lang;
use Session;

class WebController extends Controller
{
    public function index(Request $request){
        App::setLocale('th');
        session(['page' => 'index']);
//        $category = new Category;
//        $category->fill(['name_th' => 'ไทย', 'name_en' => 'eng']);
//        $category->save();
//        $category = Category::all()->first();
//        echo $category->name;
        App::setLocale('th');
//        echo $category->name;
        $product = Product::all()->first();
        return view('web.index',['tvalue'=>$this->testGetVal(),'product'=>$product]);
    }

    public function contentcategory(){
        App::setLocale('en');
        return view('web.contentcategory');
    }

    public function category(Request $request){
        return view('web.category',['page'=>'category','alias'=>$request->input('alias')]);
    }

    public function product($alias,Request $request){
        $request->session()->flush();
        return view('web.product',['page'=>'product','product'=>Product::where('alias',$alias)->first()]);
    }

    public function contactus(){
        return view('web.contactus',['page'=>'contactus']);
    }

    public function contactussave(Request $request){
        $contact = new Contactus();
        $contact->fullname = $request->input('fullname');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->detail = $request->input('detail');
        $contact->save();
        return redirect()->route('contactus')->with('success', Lang::get('web_alert.contactsuccess'));
    }

    public function signup(){
        return view('web.register',['page'=>'register']);
    }

    public function signupsave(Request $request){
        $customer = new Customer();
        $customer->username = $request->input('username');
        $customer->password = Hash::make($request->input('password'));
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->save();
        return redirect()->route('signup')->with('success', Lang::get('web_alert.signupsuccess'));
    }

    public function changeLanguage(Request $request){
        App::setLocale($request->input('language'));
        $result['result'] = true;
        return $result;
    }

    public function testGetVal(){
        return '/ hello from function';
    }

    public function viewCart(){
        $cart = session()->get('cart');
        $cartArray = [];
        $total = 0;
        if(session()->has('cart')){
            foreach($cart as $key=>$value) {
                $item['id'] = $key;
                if (App::getLocale() == 'th'){
                    $item['title'] = $cart[$key]['title_th'];
                }else{
                    $item['title'] = $cart[$key]['title_en'];
                }
                $item['quantity'] = $cart[$key]['quantity'];
                $item['price'] = $cart[$key]['price'];
                $item['thumbnail'] = $cart[$key]['thumbnail'];
                $item['total'] = $cart[$key]['quantity'] * $cart[$key]['price'];
                $total += $cart[$key]['quantity'] * $cart[$key]['price'];
                array_push($cartArray,$item);
            }
        }
        $result['total'] = $total;
        $result['cart'] = $cartArray;
        return $result;
    }

    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }
        $result["result"] = true;
        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "id" => $id,
                    "title_th" => $product->title_th,
                    "title_en" => $product->title_en,
                    "quantity" => 1,
                    "price" => $product->price,
                    "thumbnail" => $product->thumbnail
                ]
            ];
            session()->put('cart', $cart);
            return $result["result"];
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return $result["result"];
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "title_th" => $product->title_th,
            "title_en" => $product->title_en,
            "quantity" => 1,
            "price" => $product->price,
            "thumbnail" => $product->thubmnail
        ];
        session()->put('cart', $cart);
        return $result["result"];
    }

    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeCart(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
}
