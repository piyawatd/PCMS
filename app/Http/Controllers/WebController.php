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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        return view('web.index',['tvalue'=>$this->testGetVal()]);
    }

    public function product(){
        App::setLocale('en');
        return view('web.product');
    }

    public function testGetVal(){
        return '/ hello from function';
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->photo
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
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
