<?php

namespace App\Http\Controllers\Cilent;

use App\Http\Controllers\Controller;
use App\Models\bills;
use App\Models\customers;
use App\Models\order;
use App\Models\producttypes;
use App\Models\suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Termwind\Components\Raw;

class UserProfileController extends Controller
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
        $a=session()->get('user_login_id');
        $users = customers::where('id', $a)->first();

        return view('cilent.profile.index', [
            'search' => $search,
            'users' => $users,
        ]);
    }
    public function showBill(Request $request,$id){
        $search=$request->get('ab');
        $bill=DB::table('order')
        ->select('order.id','customer_id','total','order.created_at','order.status')
        ->orderBy('created_at','DESC')
        ->where('order.customer_id',$id)
        ->paginate('7');

        $Type=producttypes::all();
        $Sup=suppliers::all();

        return view('cilent.profile.showBill',[
            'bill'=>$bill,
            'search'=>$search,
            'Type'=>$Type,
            'Sup'=>$Sup,
        ]);
    }
    public function billDetails(Request $request,$id){
        $search=$request->get('ab');
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
        return view('cilent.profile.billDetails',[
            'detail'=>$detail,
            'bill'=>$bill,
            'search'=>$search,
        ]);
    }
    public function delete_order(Request $request){
        $data=$request->all();
        $order=order::find($data['order_id']);
        $order->destroy=$data['lydo'];
        $order->status=$data['status'];
        $order->save();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(Request $request,$id)
    {
        $search=$request->get('ab');
        $users = customers::where('id',$id)->first();
        return view('cilent.profile.edit', [
            'search' => $search,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $request->validate([
            'phone' => ['required', 'regex:/^0\d{9}$/'],
            'email' => ['required', 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/'],
        ]);

        $customer = customers::findOrFail($id);
        // Xử lý ảnh
        if ($request->hasFile('file_avatar')) {
            // Xóa ảnh cũ
            Storage::disk('public')->delete('img/cilent/' . $customer->img_customer);
        
            // Lưu ảnh mới
            $img_customer = Storage::disk('public')->put('img/cilent/', $request->file('file_avatar'));
        
            // Cập nhật trường img_customer
            $customer->img_customer = $img_customer;
        }

        // Kiểm tra trường `name_customer` mới va cap nhap
        $customer->name_customer = $request->input('name_customer');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');

        // Kiểm tra trùng lặp trong cơ sở dữ liệu
        $existingUser = customers::where('name_customer', $customer->name_customer)
            ->where('id', '!=', $customer->id)
            ->first();

        if ($existingUser) {
            return back()->with('error', 'Tên người dùng đã tồn tại trong cơ sở dữ liệu.');
        }

        // Cập nhật trường `name_customer`
        $customer->save();

        return redirect()->route('us.profile');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('dada');
        customers::where('id',$id)->delete();
        return redirect()->route('us.userLogin');
    }
}
