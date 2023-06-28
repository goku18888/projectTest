<?php

namespace App\Http\Controllers;

use App\Models\bills;
use App\Models\customers;
use App\Models\order;
use App\Models\products;
use App\Models\producttypes;
use App\Models\statisticals;
use App\Models\suppliers;
use App\Models\threads;
use App\Models\visitors;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class MoneyDashboard extends Controller
{
    public function __construct()
    {
        $routeName=Route::currentRouteName();
        $arre=explode('.',$routeName);
        $arr=array_map('ucfirst',$arre);
        $title=implode('-',$arr);

        View::share('title',$title);
    }
    public function MoneyDashboard(Request $request){
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

        //total
        $product=products::all()->count();
        $customer=customers::all()->count();
        $bill=bills::all()->count();
        $product_views=products::orderBy('product_views','DESC')->take(6)->get();
        
        //money 7 ngay
        $sub7days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $money=statisticals::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->sum('sales');
        //money thang trc
        $dau_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $moneythgtrc=statisticals::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->sum('sales');
        //money thang nay
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $dauthangnay=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $moneythangnay=statisticals::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->sum('sales');
        //money 1 nam
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sub365days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $moneymotnam=statisticals::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->sum('sales');
        //tinh toan tien lai hoac lo
        $suboneyear=Carbon::now('Asia/Ho_Chi_Minh')->startOfYear()->toDateString();
        $tong_tien_mua = [];
        $tong_tien_ban = [];

        for ($year = 2022; $year <= 2023; $year++) {
            $suboneyear = Carbon::createFromDate($year, 1, 1)->startOfYear();
            $now = Carbon::createFromDate($year, 12, 31)->endOfYear();

            $tong_tien_mua[$year] = DB::table('bills')
                ->join('products', 'bills.product_id', '=', 'products.id')
                ->whereBetween('order_date', [$suboneyear, $now])
                ->select(DB::raw('SUM(products.old_price * products.amount) as total'))
                ->value('total');

            $tong_tien_ban[$year] = DB::table('order')
                ->join('bills','bills.order_id','order.id')
                ->whereBetween('order_date', [$suboneyear, $now])
                ->sum('total');
        }

        return view('admin.moneyDashboard',[
            'messages' => $messages,
            'billsenger' => $billsenger,
            'search' => $search,
            'Type' => $Type,
            'Sup' => $Sup,

            'money'=>$money,
            'moneythgtrc'=>$moneythgtrc,
            'moneythangnay'=>$moneythangnay,
            'moneymotnam'=>$moneymotnam,
            
            'product' => $product,
            'customer' => $customer,
            'bill' => $bill,
            'product_views' => $product_views,

            'tong_tien_mua' => $tong_tien_mua,
            'tong_tien_ban' => $tong_tien_ban,
        ]);
    }
    public function filter_by_date(Request $request){
        $data=$request->all();
        $from_date=$data['from_date'];
        $to_date=$data['to_date'];

        $get=statisticals::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        echo $data=json_encode($chart_data);
    }
    public function dashboard_filter(Request $request){
        $data=$request->all();

        $dauthangnay=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value']=='7ngay') {
            $get=statisticals::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        } elseif($data['dashboard_value']=='thangtruoc') {
            $get=statisticals::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        } elseif($data['dashboard_value']=='thangnay') {
            $get=statisticals::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        } else{
            $get=statisticals::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        
        foreach ($get as $key => $val) {
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'quantity'=>$val->quantity,
            );
        }

        echo $data=json_encode($chart_data);
    }

    public function days_order(Request $request){
        $sub30days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();

        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get=statisticals::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'quantity'=>$val->quantity,
            );
        }

        echo $data=json_encode($chart_data);
    }
}
