<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\bills;
use App\Models\customers;
use App\Models\imgproducts;
use App\Models\order;
use App\Models\products;
use App\Models\producttypes;
use App\Models\shipping;
use App\Models\statisticals;
use App\Models\suppliers;
use App\Models\threads;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $routeName=Route::currentRouteName();
        $arre=explode('.',$routeName);
        $arr=array_map('ucfirst',$arre);
        $title=implode('-',$arr);

        View::share('title',$title);
    }
    public function index(Request $request)
    {
        $search=$request->get('ab');
        $admin = DB::table('products')
        ->select('products.id', 'name_product', 'serie', 'old_price','price_product','amount','depscribe','img_product','name_supplier','email','phone','name_producttype')
        ->join('suppliers', 'suppliers.id', 'products.supplier_id')
        ->join('producttypes', 'producttypes.id', 'products.producttype_id')
        ->where('name_product','like','%'.$search.'%')
        ->paginate(6);
        $admin->appends(['ab'=>$search]);

        $Type=producttypes::all();
        $Sup=suppliers::all();

        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();

        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();

        return view('admin.index', [
            'admin' => $admin,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'search' => $search,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $update = threads::find($request->id)->update(['status' => 1]);
    }
    public function updateBillV(Request $request)
    {
        $update = bills::find($request->id)->update(['status' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $search=$request->get('ab');
        $suppliers = suppliers::select('id', 'name_supplier')->get();
        $producttypes = producttypes::select('id', 'name_producttype')->get();
        $search=$request->get('ab');
        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();
        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();

        $Type=producttypes::all();
        $Sup=suppliers::all();

        return view('admin.CRUD.add', [
            'suppliers' => $suppliers,
            'producttypes' => $producttypes,
            'search' => $search,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateRandomSerie()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $length = strlen($chars);
    
        $serie = '';
        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, $length - 1);
            $serie .= $chars[$index];
        }
    
        return $serie;
    }
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $img_product = Storage::disk('public')->put('img/products', $request->img_product);
            $productData = array_merge($request->validated(), ['img_product' => $img_product]);
    
            // Tạo mã series ngẫu nhiên
            $serie = $this->generateRandomSerie();
            $productData['serie'] = $serie;
    
            $product = products::create($productData);
    
            if ($request->has('imgs_product')) {
                foreach ($request->file('imgs_product') as $image) {
                    $imageName = '-image-' . time() . rand(1, 1000) . '.' . $image->extension();
                    $image->move(public_path('product_images'), $imageName);
                    imgproducts::create([
                        'imgs_product' => $imageName,
                        'products_id' => $product->id,
                    ]);
                }
            }
    
            DB::commit();
            return redirect('admin/products')->with('success', 'Added');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/add')->with('success', 'Added');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(products $product) {

        return view('cilent.post.single',compact('product'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $search=$request->get('ab');
        $suppliers = suppliers::select('id', 'name_supplier')->get();
        $producttypes = producttypes::select('id', 'name_producttype')->get();
        $products = products::where('id',$id)->first();

        $Type=producttypes::all();
        $Sup=suppliers::all();

        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();
        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();

        return view('admin.CRUD.update', [
            'products' => $products,
            'search' => $search,
            'suppliers' => $suppliers,
            'producttypes' => $producttypes,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        if (!session()->has('name_admin')) {
            // Người dùng chưa đăng nhập, bạn có thể xử lý theo ý muốn, ví dụ:
            return redirect()->route('login');
        }
        // Lấy thông tin sản phẩm cần cập nhật
        $product = products::findOrFail($id);
    
        // Xử lý ảnh sản phẩm chính
        if ($request->hasFile('img_product')) {
            // Xóa ảnh cũ
            Storage::disk('public')->delete($product->img_product);
    
            // Lưu ảnh mới
            $img_product = Storage::disk('public')->put('img/products', $request->img_product);
    
            // Cập nhật trường img_product
            $product->img_product = $img_product;
        }
    
        // Xử lý ảnh sản phẩm phụ
        if ($request->hasFile('imgs_product')) {
            // Xóa tất cả ảnh phụ cũ
            imgproducts::where('products_id', $id)->delete();
    
            // Lưu ảnh phụ mới
            foreach ($request->file('imgs_product') as $image) {
                $imageName = '-image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('product_images'), $imageName);
    
                $create = imgproducts::create([
                    'imgs_product' => $imageName,
                    'products_id' => $id,
                ]);
            }
        }
    
        // Cập nhật thông tin sản phẩm
        $product->name_product = $request->name_product;
        $product->old_price = $request->old_price;
        $product->price_product = $request->price_product;
        $product->amount = $request->amount;
        $product->depscribe = $request->depscribe;
        $product->supplier_id = $request->supplier_id;
        $product->producttype_id = $request->producttype_id;
        $product->save();
        return redirect('admin/products');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        products::where('id', $id)->delete();
        return redirect('admin/products');
    }
    public function images(Request $request,$id){
        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();
        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();
        $search=$request->get('ab');
        $product=products::find($id);
        if(!$product) abort(404);

        $Type=producttypes::all();
        $Sup=suppliers::all();

        $imageProduct = imgproducts::where('products_id', $id)->get();
        return view('admin.CRUD.images',[
            'product'=>$product,
            'imageProduct'=>$imageProduct,
            'search' => $search,
            'Type' => $Type,
            'Sup' => $Sup,
            'messages' => $messages,
            'billsenger' => $billsenger,
        ]);
    }
    public function user(Request $request){
        $search=$request->get('search-user');//sua lai ten va them search
        $user=DB::table('customers')->where('name_customer','like','%'.$search.'%')->get();

        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();
        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();

        $Type=producttypes::all();
        $Sup=suppliers::all();

        return view('admin.CRUD.viewUser',[
            'user'=>$user,
            'search'=>$search,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }
    public function userDelete($id){
        customers::where('id', $id)->delete();
        return redirect()->route('ad.user');
    }
    public function userBill(Request $request,$id){
        $search=$request->get('search-bill');
        $bill=order::orderByRaw('order_status = 1')
        ->orderBy('created_at','DESC')
        ->select('order.id','order.customer_id','total','order.created_at','order.status as order_status','destroy','shipping.status as shipping_status')
        ->join('shipping','order.shipping_id','shipping.id')
        ->where('order.customer_id',$id)
        ->paginate(6);

        $Type=producttypes::all();
        $Sup=suppliers::all();

        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();
        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();

        return view('admin.CRUD.viewBill',[
            'bill'=>$bill,
            'search'=>$search,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }
    public function billDetails(Request $request,$id){
        $search=$request->get('ab');
        //chi tiet hoa don
        $detail=DB::table('order')
        ->select('order.id','order.customer_id','total','order.created_at','order.status','name_customer','shipping_address','customers.phone','address')
        ->where('order.id',$id)
        ->join('bills','order.id','bills.order_id')
        ->join('shipping','shipping.id','order.shipping_id')
        ->join('customers','customers.id','order.customer_id')
        ->join('products','products.id','bills.product_id')
        ->first();
        $bill=DB::table('bills')
        ->where('order_id',$id)
        ->join('products','bills.product_id','products.id')
        ->join('order','bills.order_id','order.id')
        ->select('bills.name_product','order.id','bills.total_product','products.price_product','order.total','bills.money_ship')
        ->get();
        //header
        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();
        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();
        $Type=producttypes::all();
        $Sup=suppliers::all();
        return view('admin.CRUD.billDetails',[
            'detail'=>$detail,
            'bill'=>$bill,
            'search'=>$search,
            'messages'=>$messages,
            'billsenger'=>$billsenger,
            'Type'=>$Type,
            'Sup'=>$Sup,
        ]);
    }
    public function billDelete($id){
        $user=customers::all()->first();
        $bill=order::where('id', $id)->delete();
        return redirect()->route('ad.userBill',['id'=>$user->id]);
    }
    //Status change
    public function status_change(Request $request){
        $data=$request->all();
        $status=order::find($data['order_id']);
        $status->status=$data['status'];
        $status->save();
    }
    public function viewBillAll(Request $request){
        $search=$request->get('search-bill');
        $billAll=bills::orderBy('bills.created_at','DESC')
        ->select('order.id','product_id','customer_id','name_customer','address','total_product','bills.name_product','product_type','total','money_ship','bills.created_at')
        ->join('products','products.id','bills.product_id')
        ->join('order','order.id','bills.order_id')
        ->join('customers','order.customer_id','customers.id')
        ->where('customer_id','like','%'.$search.'%')
        ->paginate(6);

        $Type=producttypes::all();
        $Sup=suppliers::all();

        $messages = threads::select(
            'threads.id',
            'threads.status as threads_status',
            'customers.status as customers_status',
            'threads.subject',
            'threads.created_at',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'threads.customer_id', 'customers.id')->where('threads.status', 0)->get();
        $billsenger = order::select(
            'bills.id',
            'bills.status as status',
            'customers.status as customers_status',
            'bills.order_date',
            'customers.name_customer',
            'customers.img_customer',
        )->join('customers', 'order.customer_id', 'customers.id')
        ->join('bills', 'bills.order_id', 'order.id')->where('bills.status', 0)
        ->get();

        return view('admin.CRUD.viewBillAll',[
            'billAll'=>$billAll,
            'search'=>$search,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }
    public function deleteBillAll($id){
        $bill=bills::where('id',$id)->delete();
        return redirect()->route('ad.viewBillAll');
    }

    //in PDF
    public function print_bill($id){
        $pdf=App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_bill_convert($id));
        return $pdf->stream();
    }
    public function print_bill_convert($id){
    $bill=order::where('id',$id)->get();
    foreach ($bill as $key => $order) {
        $customer_id=$order->customer_id;
        $shipping_id=shipping::where('id',$order->shipping_id)->get();
    }
    $customer=customers::where('id',$customer_id)->first();
    $shipping=DB::table('order')
    ->join('shipping','shipping.id','order.shipping_id')
    ->where('shipping.id',$order->shipping_id)
    ->first();
    //goi bang order
    $bill_detail=order::where('order.id',$id)
    ->join('bills','bills.order_id','order.id')
    ->join('products','bills.product_id','products.id')
    ->get();

    $output='';
    $output.='
    <style>
    body{
        font-family:DejaVu Sans;
    }
    .table-styling{
        border:1px solid #000;
    }
    .table-styling tr td{
        border:1px solid #000;
    }
    </style>
    <h1><center>Công Ty TNHH Một Thành Viên SHOP.</center></h1>
    <h4><center>Độc Lập - Tự Do - Hạnh Phúc</center></h4>
    <p>Người Đặt Hàng</p>
    <table class="table-styling">
        <thead>
            <tr>
                <th>Tên Khách Hàng</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>';
    $output.='
            <tr>
                <td>'.$customer->name_customer.'</td>
                <td>'.$customer->phone.'</td>
                <td>'.$customer->email.'</td>
            </tr>';
    $output.='
        </tbody>
    </table>
    
    <p>Ship Hàng Tới</p>
    <table class="table-styling">
        <thead>
            <tr>
                <th>Tên Người Nhận</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Ghi Chú</th>
            </tr>
        </thead>
        <tbody>';
    $output.='
            <tr>
                <td>'.$shipping->shipping_name.'</td>
                <td>'.$shipping->shipping_address.'</td>
                <td>'.$shipping->shipping_phone.'</td>
                <td>'.$shipping->shipping_email.'</td>
                <td>'.$shipping->shipping_note.'</td>
            </tr>';
    $output.='
        </tbody>
    </table>

    <p>Đơn Đặt Hàng</p>
    <table class="table-styling">
        <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá Sản Phẩm</th>
                <th>Tổng Tiền Hàng</th>
            </tr>
        </thead>
        <tbody>';
        $final=0;
        foreach ($bill_detail as $key => $value) {
        $total_money_product=$value->price_product*$value->total_product;
        $final+=$total_money_product;
    $output.='
            <tr>
                <td>'.$value->name_product.'</td>
                <td>'.$value->total_product.'</td>
                <td>'.number_format($value->price_product, 0, ',', '.').'VND</td>
                <td>'.number_format($total_money_product, 0, ',', '.').'VND</td>
            </tr>';
        }
    $output.='
    <tr>
       <td colspan="2">
        <p>Phí Ship:'.number_format($value->money_ship, 0, ',', '.').'VND</p>
       </td>
       <td colspan="2">
       <p>Thành Tiền:'.number_format($final+$value->money_ship, 0, ',', '.').'VND</p>
      </td> 
    </tr>
    ';
    $output.='
        </tbody>
    </table>
    <p style="text-align: center;">Ký Tên</p>
        <table>
            <thead>
                <tr>
                    <th width="200px">Người Lập Phiếu</th>
                    <th width="800px">Người Nhận</th>
                </tr>
            </thead>
            <tbody>';
    $output.='</tbody>
    </table>';
    return $output;
    }
    
    //tu dong tim kiem search
    public function autocomplete_ajax(Request $request){
        $data=$request->all();
        if ($data['query']) {
            $product=products::where('name_product','LIKE','%'.$data['query'].'%')->get();
            $output='<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($product as $key => $val) {
                $output.='<li class="li_search_ajax_topbar"><a href="#">'.$val->name_product.'</a></li>';
            }
            $output.='</ul>';
            echo $output;
        }
    }
    public function autocomplete_ajax_viewuser(Request $request){
        $data=$request->all();
        if ($data['query']) {
            $product=customers::where('name_customer','LIKE','%'.$data['query'].'%')->get();
            $output='<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($product as $key => $val) {
                $output.='<li class="li_search_ajax_viewuser"><a href="#">'.$val->name_customer.'</a></li>';
            }
            $output.='</ul>';
            echo $output;
        }
    }
}
