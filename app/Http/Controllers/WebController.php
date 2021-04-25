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
use App\Models\CategoryContent;
use App\Models\Contactus;
use App\Models\Content;
use App\Models\ContentGallery;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Lang;
use Session;

class WebController extends Controller
{
    public function index(Request $request){
//        App::setLocale('th');
//        session(['page' => 'index']);
//        $category = new Category;
//        $category->fill(['name_th' => 'ไทย', 'name_en' => 'eng']);
//        $category->save();
//        $category = Category::all()->first();
//        echo $category->name;
//        App::setLocale('th');
//        echo $category->name;
//        $product = Product::all()->first();
        $slidecate = CategoryContent::where('alias','slide')
        	->where('status',1)->get()->first();
        $slideObj = Content::where('category',$slidecate->id)
            ->where('publish',1)
            ->where('publish_date','<',now())
            ->where('status',1)
            ->orderBy('created_at','desc')
            ->get()->first();
        $slides = ContentGallery::where('content',$slideObj->id)->get();
        $products = Product::where('publish',1)
            ->where('publish_date','<',now())
            ->where('status',1)
            ->limit(3)
            ->orderBy('created_at','desc')
            ->get();
        $contentcate = CategoryContent::where('alias','customer')->where('status',1)->get()->first();
        $contents = Content::where('category',$contentcate->id)
        	->where('status',1)
            ->where('publish',1)
            ->where('publish_date','<',now())
            ->limit(3)
            ->orderBy('created_at','desc')
            ->get();

        return view('web.index',['slides'=>$slides,'products'=>$products,'contents'=>$contents,'address'=>$this->getAddress()]);
    }

    public function getAddress(){
        $address = Content::where('alias','address')->where('status',1)->get()->first();
        return $address?:new Content();
    }

    public function contentcategory(){
        return view('web.contentcategory');
    }

    public function category(Request $request){
        return view('web.category',['alias'=>$request->input('alias')]);
    }

    public function product(Request $request){
        $categoryList = Category::where('status',1)
                        ->orderBy('order_number')->get();
        return view('web.product',['categoryList'=>$categoryList,'address'=>$this->getAddress()]);
    }

    public function categoryproduct($alias,Request $request){
//        return view('web.category',['alias'=>$request->input('alias')]);
        $total = 0;
        $data = array();
        if ($alias == 'all')
        {
//            $category = Category::where('alias',$alias)->get()->first();
            $total = Product::where('status',1)->count();
            $start = (intval($request->input('pageNumber')) - 1) * intval($request->input('pageSize'));
            $contents = Product::where('publish',1)
                ->where('publish_date','<',now())
                ->where('status',1)
                ->offset($start)
                ->limit(intval($request->input('pageSize')))
                ->orderBy('created_at','desc')
                ->get();
            if(!empty($contents))
            {
                foreach ($contents as $content)
                {
                    $linkUrl =  route('productdetail',['alias'=>$content->alias]);
                    $thumbnail = '/images/default-thumbnail.jpg';
                    if($content->thumbnail != ''){
                        $thumbnail = $content->thumbnail;
                    }
                    $htmltext = '<div class="col-md-6 col-lg-4 mb-6">';
                    $htmltext = $htmltext.'<div class="box">';
                    $htmltext = $htmltext.'<div class="store card border-0 rounded-0">';
                    $htmltext = $htmltext.'<div class="position-relative store-image">';
                    $htmltext = $htmltext.'<a href="'.$linkUrl.'">';
                    $htmltext = $htmltext.'<img src="'.$thumbnail.'" alt="'.$content->title.'" class="card-img-top rounded-0"></a></div>';
                    $htmltext = $htmltext.'<div class="card-body px-0 pb-0 pt-3">';
                    $htmltext = $htmltext.'<a href="'.$linkUrl.'" class="card-title h5 text-dark d-inline-block mb-2">';
                    $htmltext = $htmltext.'<span class="letter-spacing-25">'.$content->title.'</span></a>';
                    $htmltext = $htmltext.'<div class="media">';
                    $htmltext = $htmltext.'<div class="media-body lh-14 font-size-sm">';
                    $htmltext = $htmltext.''.$content->intro;
                    $htmltext = $htmltext.'</div></div></div></div></div></div>';
                    array_push($data,$htmltext);
                }
            }
        }else{
            $category = Category::where('alias',$alias)->where('status',1)->get()->first();
            $total = Product::where('category',$category->id)->where('status',1)->count();
            $start = (intval($request->input('pageNumber')) - 1) * intval($request->input('pageSize'));
            $contents = Product::where('category',$category->id)
            	->where('status',1)
                ->where('publish',1)
                ->where('publish_date','<',now())
                ->offset($start)
                ->limit(intval($request->input('pageSize')))
                ->orderBy('created_at','desc')
                ->get();
            if(!empty($contents))
            {
                foreach ($contents as $content)
                {
                    $linkUrl =  route('productdetail',['alias'=>$content->alias]);
                    $thumbnail = '/public/img/blank.jpg';
                    if($content->thumbnail != ''){
                        $thumbnail = $content->thumbnail;
                    }
                    $htmltext = '<div class="col-md-6 col-lg-4 mb-6">';
                    $htmltext = $htmltext.'<div class="box">';
                    $htmltext = $htmltext.'<div class="store card border-0 rounded-0">';
                    $htmltext = $htmltext.'<div class="position-relative store-image">';
                    $htmltext = $htmltext.'<a href="'.$linkUrl.'">';
                    $htmltext = $htmltext.'<img src="'.$thumbnail.'" alt="'.$content->title.'" class="card-img-top rounded-0"></a></div>';
                    $htmltext = $htmltext.'<div class="card-body px-0 pb-0 pt-3">';
                    $htmltext = $htmltext.'<a href="'.$linkUrl.'" class="card-title h5 text-dark d-inline-block mb-2">';
                    $htmltext = $htmltext.'<span class="letter-spacing-25">'.$content->title.'</span></a>';
                    $htmltext = $htmltext.'<div class="media">';
                    $htmltext = $htmltext.'<div class="media-body lh-14 font-size-sm">';
                    $htmltext = $htmltext.''.$content->intro;
                    $htmltext = $htmltext.'</div></div></div></div></div></div>';
                    array_push($data,$htmltext);
                }
            }
        }
        $json_data = array(
            "total"            => $total,
            "items"            => $data
        );
        echo json_encode($json_data);
    }

    public function productdetail($alias,Request $request){
        $product = Product::where('alias',$alias)->first();
        if($product)
        {
            $category = Category::find($product->category);
            $gallery = ProductGallery::where('product',$product->id)->get();
            $related = Product::where('category',$category->id)
                ->where('id','<>',$product->id)
                ->where('publish',1)
                ->where('publish_date','<',now())
                ->where('status',1)
                ->limit(10)
                ->orderBy('created_at','desc')
                ->get();
            return view('web.productdetail',['product'=>$product,'category'=>$category,'gallery'=>$gallery,'related'=>$related,'address'=>$this->getAddress()]);
        }
        else{
            return redirect()->route('notfound');
        }
    }

    public function categorycontent($alias,Request $request){
        $data = array();
        $category = CategoryContent::where('alias',$alias)->where('status',1)->get()->first();
        $total = Content::where('category',$category->id)->count();
        $start = (intval($request->input('pageNumber')) - 1) * intval($request->input('pageSize'));
        $contents = Content::where('category',$category->id)
	        ->where('status',1)
            ->where('publish',1)
            ->where('publish_date','<',now())
            ->offset($start)
            ->limit(intval($request->input('pageSize')))
            ->orderBy('created_at','desc')
            ->get();
        if(!empty($contents))
        {
            foreach ($contents as $content)
            {
                $linkUrl =  route('clientdetail',['alias'=>$content->alias]);
                $thumbnail = '/images/default-thumbnail.jpg';
                if($content->thumbnail != ''){
                    $thumbnail = $content->thumbnail;
                }
                $htmltext = '<div class="col-md-6 col-lg-4 mb-6"><div class="card border-0">';
                $htmltext = $htmltext.'<a href="'.$linkUrl.'" class="hover-scale">';
                $htmltext = $htmltext.'<img src="'.$thumbnail.'" alt="'.$content->title.'" class="card-img-top image"></a>';
                $htmltext = $htmltext.'<h5 class="card-title lh-13 letter-spacing-25">';
                $htmltext = $htmltext.'<a href="'.$linkUrl.'" class="link-hover-dark-primary text-capitalize">'.$content->title;
                $htmltext = $htmltext.'</a></h5></div></div></div>';
                array_push($data,$htmltext);
            }
        }
        $json_data = array(
            "total"            => $total,
            "items"            => $data
        );
        echo json_encode($json_data);
    }

    public function contentdetail($alias,Request $request){
        return view('web.productdetail',['content'=>Content::where('alias',$alias)->first()]);
    }

    public function client(){
        return view('web.client',['address'=>$this->getAddress()]);
    }

    public function clientcontent($alias,Request $request){
        $data = array();
        $category = CategoryContent::where('alias',$alias)->where('status',1)->get()->first();
        $total = Content::where('category',$category->id)->count();
        $start = (intval($request->input('pageNumber')) - 1) * intval($request->input('pageSize'));
        $contents = Content::where('category',$category->id)
        	->where('status',1)
            ->where('publish',1)
            ->where('publish_date','<',now())
            ->offset($start)
            ->limit(intval($request->input('pageSize')))
            ->orderBy('created_at','desc')
            ->get();
        if(!empty($contents))
        {
            foreach ($contents as $content)
            {
                $linkUrl =  route('clientdetail',['alias'=>$content->alias]);
                $thumbnail = '/images/default-thumbnail.jpg';
                if($content->thumbnail != ''){
                    $thumbnail = $content->thumbnail;
                }
                $htmltext = '<div class="col-md-6 col-lg-4 mb-6"><div class="card border-0">';
                $htmltext = $htmltext.'<a href="'.$linkUrl.'" class="hover-scale">';
                $htmltext = $htmltext.'<img src="'.$thumbnail.'" alt="'.$content->title.'" class="card-img-top image"></a>';
                $htmltext = $htmltext.'<h5 class="card-title lh-13 letter-spacing-25">';
                $htmltext = $htmltext.'<a href="'.$linkUrl.'" class="link-hover-dark-primary text-capitalize">'.$content->title;
                $htmltext = $htmltext.'</a></h5></div></div></div>';
                array_push($data,$htmltext);
            }
        }
        $json_data = array(
            "total"            => $total,
            "items"            => $data
        );
        echo json_encode($json_data);
    }

    public function clientdetail($alias,Request $request){
        $content = Content::where('alias',$alias)->first();
        if($content) {
            $category = CategoryContent::find($content->category);
            $heroimage = ContentGallery::where('content', $content->id)->get()->first();
            return view('web.clientdetail', ['content' => $content, 'heroimage' => $heroimage ?: new ContentGallery(), 'category' => $category, 'address' => $this->getAddress()]);
        }else{
            return redirect()->route('notfound');
        }
    }

    public function notfound(Request $request){
        return view('web.notfound',['address' => $this->getAddress()]);
    }

    public function aboutus(){
        $content = Content::where('alias','aboutus')->first();
        if($content) {
            return view('web.aboutus', ['content' => $content, 'address' => $this->getAddress()]);
        }else{
            return redirect()->route('notfound');
        }
    }

    public function career(){
        $category = CategoryContent::where('alias','career')->where('status',1)->get()->first();
        $contents = Content::where('category',$category->id)
        	->where('status',1)
            ->where('publish',1)
            ->where('publish_date','<',now())
            ->orderBy('created_at','desc')
            ->get();
        return view('web.career',['contents'=>$contents,'address'=>$this->getAddress()]);
    }

    public function careerdetail($alias,Request $request){
        $content = Content::where('alias',$alias)->first();
        if($content) {
            $category = CategoryContent::find($content->category);
            $related = Content::where('category',$category->id)
                ->where('id','<>',$content->id)
                ->where('publish',1)
                ->where('publish_date','<',now())
                ->where('status',1)
                ->limit(3)
                ->orderBy('created_at','desc')
                ->get();
            return view('web.careerdetail', ['content' => $content, 'related' => $related, 'category' => $category, 'address' => $this->getAddress()]);
        }else{
            return redirect()->route('notfound');
        }
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

    public function checkout(){
        $carts = $this->viewCart();
        return view('web.checkout',['carts'=>$carts]);
    }

    public function checkoutsave(){
        $order = new Order();
        $order->order_no = 'NO01';
        $order->customer = 1;
        $order->note = 'note';
        $order->total = 10000;
        $order->grand_total = 10000;
        $order->discount = 0;
        $order->discountpercent = 0;
        $order->net = 10000;
        $order->local = App::getLocale();
        $order->save();
        if(session()->has('cart')){
            $cart = session()->get('cart');
            foreach($cart as $key=>$value) {
                $orderItem = new OrderItem();
                $orderItem->order = $order->id;
                $orderItem->title_th = $cart[$key]['title_th'];
                $orderItem->title_en = $cart[$key]['title_en'];
                $orderItem->sku = $cart[$key]['sku'];
                $orderItem->quantity = $cart[$key]['quantity'];
                $orderItem->price = $cart[$key]['price'];
                $orderItem->totalline = $cart[$key]['quantity'] * $cart[$key]['price'];
                $orderItem->save();
            }
            //Remove Cart Item
            Session::forget('cart');
        }
        return redirect()->route('home')->with('success', Lang::get('web_alert.checkoutsuccess'));
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
                $item['sku'] = $cart[$key]['sku'];
                $item['quantity'] = $cart[$key]['quantity'];
                $item['price'] = $cart[$key]['price'];
                $item['thumbnail'] = $cart[$key]['thumbnail'];
                $linetotal = $cart[$key]['quantity'] * $cart[$key]['price'];
                $item['total'] = $linetotal;
                $total += $linetotal;
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
                    "sku" => $product->sku,
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
            "sku" => $product->sku,
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
