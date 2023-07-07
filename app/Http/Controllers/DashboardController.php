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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $routeName=Route::currentRouteName();
        $arre=explode('.',$routeName);
        $arr=array_map('ucfirst',$arre);
        $title=implode('-',$arr);

        View::share('title',$title);
    }
    public function index(Request $request){
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

        //get ip address
        $user_ip_address=$request->ip();
        $early_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $oneyears=Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month
        $visitor_of_lastmonth=visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
        $visitor_last_month_count=$visitor_of_lastmonth->count();

        //total this month
        $visitor_of_thismonth=visitors::whereBetween('date_visitor',[$early_this_month,$now])->get();
        $visitor_this_month_count=$visitor_of_thismonth->count();

        //total one year
        $visitor_of_year=visitors::whereBetween('date_visitor',[$oneyears,$now])->get();
        $visitor_year_count=$visitor_of_year->count();

        //current online
        $visitors_current=visitors::where('ip_address',$user_ip_address)->get();
        $visitor_count=$visitors_current->count();
        if ($visitor_count<1) {
            $visitor=new visitors();
            $visitor->ip_address=$user_ip_address;
            $visitor->date_visitor=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        //total visitors
        $visitors=visitors::all();
        $visitors_total=$visitors->count();

        //total
        $product=products::all()->count();
        $customer=customers::all()->count();
        $bill=bills::all()->count();
        $product_views=products::orderBy('product_views','DESC')->take(8)->get(); 

        return view('admin.dashboard',[
            'messages' => $messages,
            'billsenger' => $billsenger,
            'search' => $search,
            'Type' => $Type,
            'Sup' => $Sup,

            'visitors_total'=>$visitors_total,
            'visitor_count'=>$visitor_count,
            'visitor_last_month_count'=>$visitor_last_month_count,
            'visitor_this_month_count'=>$visitor_this_month_count,
            'visitor_year_count'=>$visitor_year_count,
            
            'product' => $product,
            'customer' => $customer,
            'bill' => $bill,
            'product_views' => $product_views,
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
