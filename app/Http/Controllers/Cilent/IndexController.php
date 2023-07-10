<?php

namespace App\Http\Controllers\Cilent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping\ShippingRequest;
use App\Mail\SendMailCreateThreadToSuccess;
use App\Models\admins;
use App\Models\bills;
use App\Models\City;
use App\Models\Comment;
use App\Models\customers;
use App\Models\imgproducts;
use App\Models\order;
use App\Models\products;
use App\Models\Province;
use App\Models\ratings;
use App\Models\shipping;
use App\Models\statisticals;
use App\Models\threads;
use App\Models\Wards;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use function GuzzleHttp\Promise\all;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->get('search_index_user');
        $user = DB::table('products')
        ->select('products.id', 'name_product','price_product','amount','depscribe','img_product','name_supplier','email','phone','name_producttype')
        ->join('suppliers', 'suppliers.id', 'products.supplier_id')
        ->join('producttypes', 'producttypes.id', 'products.producttype_id')
        ->where('name_product','like','%'.$search.'%')
        ->where('amount','>',0)
        ->paginate(6);
        $user->appends(['search_index_user'=>$search]);
        return view('cilent.index',['user'=>$user,'search' => $search,]);
    }
    public function autocomplete_ajax_indexuser(Request $request){
        $data=$request->all();
        if ($data['query']) {
            $product=products::where('name_product','LIKE','%'.$data['query'].'%')->get();
            $output='<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($product as $key => $val) {
                $output.='<li class="li_search_ajax_indexuser"><a href="#">'.$val->name_product.'</a></li>';
            }
            $output.='</ul>';
            echo $output;
        }
    }
    public function about(Request $request){
        $search=$request->get('abc');
        $user = DB::table('products')
        ->select('products.id', 'name_product','price_product','amount','depscribe','img_product','name_supplier','email','phone','name_producttype')
        ->join('suppliers', 'suppliers.id', 'products.supplier_id')
        ->join('producttypes', 'producttypes.id', 'products.producttype_id')
        ->where('name_product','like','%'.$search.'%')
        ->paginate(9);
        $user->appends(['abc'=>$search]);
        return view('cilent.about',['user'=>$user,'search' => $search,]);
    }
    public function contact(Request $request){
        $search=$request->get('abc');
        $user = DB::table('products')
        ->select('products.id', 'name_product','price_product','amount','depscribe','img_product','name_supplier','email','phone','name_producttype')
        ->join('suppliers', 'suppliers.id', 'products.supplier_id')
        ->join('producttypes', 'producttypes.id', 'products.producttype_id')
        ->where('name_product','like','%'.$search.'%')
        ->paginate(9);
        $user->appends(['abc'=>$search]);
        return view('cilent.contact',['user'=>$user,'search' => $search,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cilent.login.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function small(){
        $carts=session()->get('cart');
        if(isset($carts)){
            return view('cilent.layouts.topbar',[
                'carts'=>$carts,
            ]);
        }else{
            return redirect()->route('us.index')->with('1','adasdsadsda');
        }
     }
    public function details(Request $request,$id){
        $search=$request->get('ab');
        $product=products::find($id);
        if(!$product) abort(404);

        $user = DB::table('products')
        ->select('products.id', 'name_product','price_product','amount','depscribe','img_product','name_supplier','email','phone','name_producttype')
        ->join('suppliers', 'suppliers.id', 'products.supplier_id')
        ->join('producttypes', 'producttypes.id', 'products.producttype_id')
        ->where('name_product','like','%'.$search.'%')
        ->where('products.id', $id)
        ->first();

        $imageProduct = imgproducts::where('products_id', $id)->get();
        $pro=products::where('id',$id)->get();
        //sao
        $rating=ratings::where('product_id',$user->id)->avg('rating');
        $rating=round($rating);
        //dem luot xem san pham
        $product=products::where('id',$id)->first();
        $product->product_views=$product->product_views+1;
        $product->save();

        return view('cilent.detail',[
            'product'=>$product,
            'imageProduct'=>$imageProduct,
            'search' => $search,
            'pro' => $pro,
            'user'=>$user,
            'rating'=>$rating,
        ]);
    }
    public function viewfeedback(){
        return view('cilent.contact');
    }
    public function storefeedback(Request $request, customers $user)
     {
        if(session('user_login_id')){
            $thread = threads::create([
                'customer_id' => session()->get('user_login_id'),
                'subject' => request('subject'),
                'something' => request('something')
            ]);   
        }else{
            return redirect()->route('us.userLogin')->with('chuadangnhap','You must login to send feedback !!!');
        }
          
         // send mail to creator thread
         Mail::to('hoctap438@gmail.com')->send(new SendMailCreateThreadToSuccess($user, $thread));
 
         return back()
                 ->with('flash', 'Your thread has been published');
     }

     public function addToCart($id){
        // session()->flush();
        $product=products::join('producttypes', 'products.producttype_id', 'producttypes.id')->find($id);
        $cart=session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['amount']=$cart[$id]['amount']+1;
        }else{
            $cart[$id]=[
                'serie'=>$product->serie,
                'name_product'=>$product->name_product,
                'price_product'=>$product->price_product,
                'product_type'=>$product->name_producttype,
                'img_product'=>$product->img_product,
                'amount'=>1,
            ];
        }
        session()->put('cart',$cart);
        return response()->json([
            'code'=>200,
            'messenger'=>'success',
        ],200);
     }
     public function showCart(Request $request){
        //kiem tra nguoi dung ton tai hay khong
        $customer = session()->get('user_login_id');
        $shippingInfo = customers::where('id',$customer)->first();
        //hien city,quan huyen
        $city = City::orderBy('matp', 'ASC')->get();
        $province = Province::orderBy('maqh', 'ASC')->get();
        $wards = Wards::orderBy('xaid', 'ASC')->get();
        $search=$request->get('ab');
        $carts=session()->get('cart');
        if($carts){
            return view('cilent.cart',[
                'carts'=>$carts,
                'search'=>$search,
                'city'=>$city,
                'province'=>$province,
                'wards'=>$wards,
                'shippingInfo'=>$shippingInfo,
            ]);
        }else{
            return redirect()->route('us.index')->with('1','Bạn chưa đặt hàng hoặc chưa có tài khoản,vui lòng kiểm tra !!!');
        }
     }
     public function preview_Cart(Request $request){
        //kiem tra nguoi dung ton tai hay khong
        $customer = session()->get('user_login_id');
        $shippingInfo = customers::where('id',$customer)->first();
        //hien city,quan huyen
        $city = City::orderBy('matp', 'ASC')->get();
        $province = Province::orderBy('maqh', 'ASC')->get();
        $wards = Wards::orderBy('xaid', 'ASC')->get();
        $search=$request->get('ab');
        $carts=session()->get('cart');
        if($carts){
            return view('cilent.preview_cart',[
                'carts'=>$carts,
                'search'=>$search,
                'city'=>$city,
                'province'=>$province,
                'wards'=>$wards,
                'shippingInfo'=>$shippingInfo,
            ]);
        }else{
            return redirect()->route('us.index')->with('1','Bạn chưa đặt hàng hoặc chưa có tài khoản,vui lòng kiểm tra !!!');
        }
     }
     public function updateCart(Request $request){
        $search=$request->get('abc');
        if($request->id && $request->amount){
            $carts=session()->get('cart');
            $carts[$request->id]['amount']=$request->amount;
            session()->put('cart',$carts);
            $carts=session()->get('cart');

            return response()->json(['cart'=>$carts,'code'=>200],200);
        }
     }

     public function deleteCart(Request $request){
        $search=$request->get('abc');
        if($request->id){
            $carts=session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart',$carts);
            $carts=session()->get('cart');
            
            return response()->json(['cart'=>$carts,'code'=>200],200);
        }
     }

    public function addBill(Request $request)
    {
        $shippingFee = session()->get('fee');
        $customer = session()->get('user_login_id');
        $cart = session()->get('cart');
        $shippingInfo = customers::where('id',$customer)->first();
        $shippingName=$request->shipping_name ? $request->shipping_name : $shippingInfo->name_customer;
        $shippingEmail=$request->shipping_email ? $request->shipping_name : $shippingInfo->name_customer;
        $shippingPhone=$request->shipping_phone ? $request->shipping_name : $shippingInfo->name_customer;
        //validate
        $validated = $request->validate([
            // 'shipping_name' => 'bail|required|max:255',
            // 'shipping_email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'],
            'shipping_address' => ['required'],
            // 'shipping_phone' => ['required', 'regex:/^0\d{9}$/'],
            'shipping_note' => 'required',
        ]);
        //create order_date
        $order_date=Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        //tao bang shipping
        $ship = shipping::create([
            'customer_id' => session('user_login_id'),
            'shipping_name' => $shippingName,
            'shipping_email' => $shippingEmail,
            'shipping_address' => $request->shipping_address,
            'shipping_phone' => $shippingPhone,
            'shipping_note' => $request->shipping_note,
            'status' => 0,
        ]);
        //lay total
        $totalPrice = 0;
        foreach ($cart as $item) {
            $price = $item['price_product'];
            $amount = $item['amount'];
            $subtotal = $price * $amount;
            $totalPrice += $subtotal;
        }
        //tao bang order
        $order = order::create([
        'customer_id' => session('user_login_id'),
        'shipping_id' => $request->shipping_name,
        'total' => $totalPrice,
        'shipping_id' => $ship->id,
        ]);
        //tao bang tu bill->order_details
        $dataStatistical = [];
        foreach ($cart as $key => $item) {
            $results = [
                'product_id' => $key,
                'order_id' => $order->id,
                'total_product' => $item['amount'],
                'name_product' => $item['name_product'],
                'product_type' => $item['product_type'],
                'total_money' => $item['price_product']*$item['amount'],
                'money_ship' => $shippingFee,
                'order_date'=> $order_date,
            ];

            $dataStatistical[] = $results;

            $checkamount = products::find($key);

            if($checkamount->amount > 0){
                $checkamount->update([
                    'amount' => $checkamount->amount - $item['amount']
                ]);
                $itemBill = bills::create($results);
            } else {
                return redirect()->route('us.showCart')->with('outofstock','sorry our '.$checkamount->name_product.' is out of stock');
            }
        };
        //luu vao bang statictical
        $totalSales = 0;
        $totalQuantity = 0;
        $totalOrder = order::where('created_at', now()->format('Y-m-d'))->get()->count();
        
        foreach ($dataStatistical as $value) {
            $totalSales += $value['total_money'];
            $totalQuantity += $value['total_product'];
        }

        $statistic = statisticals::where('order_date', now()->format('Y-m-d'))->first();

        statisticals::updateOrCreate([
            'order_date' => now()->format('Y-m-d')
        ], [
            'sales' => $totalSales + ($statistic->sales ?? 0),
            'quantity' => $totalQuantity + ($statistic->quantity ?? 0),
            'total_order' => $totalOrder + count($dataStatistical),
        ]);
        // send mail confirm cho cilent
        $now=Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail="Don Hang Xac Nhan Ngay".''.$now;
        $customer_find=customers::find(session('user_login_id'));
        $order_id=$order->id;
        $data['email'][]=$customer_find->email;
        if ($cart==true) {
            foreach ($cart as $key => $cart_mail) {
                $cart_array[]=array(
                    'name_product'=>$cart_mail['name_product'],
                    'price_product'=>$cart_mail['price_product'],
                    'amount'=>$cart_mail['amount'],
                );
            }
        }
        $shipping_array=array(
            'name_customer'=>$customer_find->name_customer,
            'shipping_name'=>$request->shipping_name,
            'shipping_email'=>$request->shipping_email,
            'shipping_address'=>$request->shipping_address,
            'shipping_phone'=>$request->shipping_phone,
            'shipping_note'=>$request->shipping_note,
            'status'=>$ship->status,
        );
        Mail::send('cilent.mail.mail',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'order_id'=>$order_id],
        function($message)use($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });
        // send mail thong bao cho admin
        $bill_fee=order::with('customers')
        ->where('customer_id',session('user_login_id'))
        ->join('bills','order.id','bills.order_id')
        ->orderBy('bills.id','DESC')
        ->first('money_ship');
        
        $title_mail="San Pham Da Co Nguoi mua".''.$now;
        if ($cart==true) {
            foreach ($cart as $key => $cart_mail) {
                $cart_array[]=array(
                    'name_product'=>$cart_mail['name_product'],
                    'price_product'=>$cart_mail['price_product'],
                    'amount'=>$cart_mail['amount'],
                );
            }
        }
        $shipping_array=array(
            'name_customer'=>$customer_find->name_customer,
            'shipping_name'=>$request->shipping_name,
            'shipping_email'=>$request->shipping_email,
            'shipping_address'=>$request->shipping_address,
            'shipping_phone'=>$request->shipping_phone,
            'shipping_note'=>$request->shipping_note,
            'status'=>$ship->status,   
        );
        Mail::send('admin.mail.mail_admin',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'bill_fee'=>$bill_fee,'order'=>$order],
        function($message)use($title_mail,$data){
            $message->to('hoctap438@gmail.com')->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });
        //quen cart
        Session::forget('cart');
        Session::forget('fee');

        return redirect()->route('us.index');
    }

    public function load_comment(Request $request){
        $product_id=$request->product_id;
        $comment=Comment::where('product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',0)->get();
        $comment_rep=Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output='';
        foreach($comment as $key=>$comm ){
            $output.='
                    <div class="col-md-2">
                        <img src="'.url('product_images/-image-166305923637.png" class="figure-img img-fluid rounded').'" style="width: 100px"> 
                    </div>
                    <div class="col-md-10">
                        <p style="color: blue">@'.$comm->customer_name.'</p>
                        <p style="color: pink">'.$comm->created_at.'</p>
                        <p>'.$comm->comment.'</p>
                        <hr />
                    </div>
                    ';

                    foreach($comment_rep as $key => $rep_comment){
                    if($rep_comment->comment_parent_comment==$comm->id){
                    $output.=' <div style="margin:5px 50px">
                        <br><div class="col-md-2">
                            <img src="'.url('product_images/admin.png" class="figure-img img-fluid rounded').'" style="width: 50px"> 
                        </div>
                        <div class="col-md-10">
                            <p style="color: green">@Admin</p>
                            <p style="color: pink">'.$rep_comment->comment.'</p>
                            <p></p>
                            <hr />
                        </div>
                    </div>';
                        }
                    }
        }
        echo $output;
    }
    public function send_comment(Request $request){
        //check xem co tai khoan chua
        $customer_name_require=session()->get('name_customer');
        if(!$customer_name_require){
            return redirect()->route('us.userLogin');
        }
        //xu li du lieu
        $product_id=$request->product_id;
        // $customer_name=$request->customer_name;
        $comment_content=$request->comment_content;
        $comment=new Comment();
        $comment->comment=$comment_content;
        $comment->customer_name=$customer_name_require;
        $comment->product_id=$product_id;
        $comment->comment_status=1;
        $comment->comment_parent_comment=0;
        $comment->save();
        echo 'done';
    }
    public function insert_rating(Request $request){
        $customer_id=session()->get('user_login_id');
        //check xem co tai khoan chua
        if(!session()->has('user_login_id')){
            return redirect()->route('us.userLogin');
        }
        //xu li du lieu           
        $data=$request->all();
        $rating=new ratings();
        $rating->product_id=$data['product_id'];
        $rating->customer_id=$customer_id;
        $rating->rating=$data['index'];
        $rating->save();
        echo 'done';
    }
}
