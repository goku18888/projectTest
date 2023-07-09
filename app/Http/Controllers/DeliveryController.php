<?php

namespace App\Http\Controllers;

use App\Models\admins;
use App\Models\bills;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\customers;
use App\Models\producttypes;
use App\Models\Province;
use App\Models\suppliers;
use App\Models\threads;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\order;
use App\Models\shipping;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $routeName = Route::currentRouteName();
        $arre = explode('.', $routeName);
        $arr = array_map('ucfirst', $arre);
        $title = implode('-', $arr);

        View::share('title', $title);
    }
    public function select_feeship(Request $request){
        $feeship=Feeship::with('city')->orderBy('fee_id','DESC')->get();
        $output='';
        $output.='<div class="table-responsive">
        <table class="table table-bordered">
            <thread>
                <tr>
                    <th>Ten Thanh Pho</th>
                    <th>Ten Quan Huyen</th>
                    <th>Ten Xa Phuong</th>
                    <th>Phi Ship</th>
                </tr>
            </thread>
        <tbody>
        ';
        foreach($feeship as $key => $fee){  
            $output.='
            <tr>
                <td>'.$fee->city->name_city.'</td>
                <td>'.$fee->province->name_quanhuyen.'</td>
                <td>'.$fee->wards->name_xaphuong.'</td>
                <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_ship_edit">'.$fee->fee_feeship.'</td>
            </tr>';
        }
        $output.='
        </tbody>
        </table>
        </div>';
        echo $output;
    }
    public function update_delivery(Request $request){
        $feeship_id = $request->input('feeship_id');
        $fee_value = $request->input('fee_value');
        $feeship = Feeship::where('fee_id', $feeship_id)->first();

        if (!$feeship) {
            return response()->json(['message' => 'Không tìm thấy bản ghi với id cụ thể'], 404);
        }
        $feeship->fee_feeship = $fee_value;
        $feeship->save();
        return response()->json(['message' => 'Cập nhật thành công']);
    }
    public function update_code_delivery(Request $request)
    {
        $order_id = $request->input('order_id');
        $order_value = $request->input('order_value');
        $codeShip = order::where('id', $order_id)->first();
    
        if (!$codeShip) {
            return response()->json(['message' => 'Không tìm thấy bản ghi với id cụ thể'], 404);
        }
    
        $codeShip->code_ship = $order_value;
        $codeShip->status = 1;
        $codeShip->save();
    
        // Send mail confirmation to client
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Đơn Hàng Đang Trên Đường" . ' ' . $now;
        $customer = customers::select('email')->find($codeShip->customer_id);
    
        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy thông tin khách hàng'], 404);
        }
    
        $data = ['order_id' => $order_id, 'order_value' => $order_value];
    
        Mail::send('admin.mail.code_ship', $data, function ($message) use ($title_mail, $customer) {
            $message->to($customer->email)->subject($title_mail);
            $message->from(env('MAIL_USERNAME'), $title_mail);
        });
    
        return response()->json(['message' => 'Cập nhật thành công']);
    }
    
    public function delivery(Request $request)
    {
        $search = $request->get('comment');

        $Type = producttypes::all();
        $Sup = suppliers::all();

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

        $city = City::orderBy('matp', 'ASC')->get();
        $province = Province::orderBy('maqh', 'ASC')->get();
        $wards = Wards::orderBy('xaid', 'ASC')->get();
        return view('admin.delivery.add_delivery', [
            'messages' => $messages,
            'billsenger' => $billsenger,
            'search' => $search,
            'Type' => $Type,
            'Sup' => $Sup,
            'city' => $city,
            'province' => $province,
            'wards' => $wards,
        ]);
    }
    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                $output .= '<option>---chon quan huyen---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            }
            else{
                $select_wards=Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---chon xa phuong---</option>';
                foreach($select_wards as $key => $ward) {
                    $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function insert_delivery(Request $request){
        $data=$request->all();
        $fee_ship=new Feeship();
        $fee_ship->fee_matp=$data['city'];
        $fee_ship->fee_maqh=$data['province'];
        $fee_ship->fee_xaid=$data['wards'];
        $fee_ship->fee_feeship=$data['fee_ship'];
        $fee_ship->save();
    }
    // BEN CILENT ////
    public function calculate_fee(Request $request){
        $data = $request->all();
        if ($data['matp']) {
            $feeship=Feeship::where('fee_matp',$data['matp'])
            ->where('fee_maqh',$data['maqh'])
            ->where('fee_xaid',$data['xaid'])
            ->get();
            if($feeship){
                $count_feeship=$feeship->count();
                if($count_feeship>0){
                    foreach ($feeship as $key => $fee) {
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{
                    Session::put('fee',25000);
                    Session::save();
                }
            }
        }
    }
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                $output .= '<option>---chon quan huyen---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            }
            else{
                $select_wards=Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---chon xa phuong---</option>';
                foreach($select_wards as $key => $ward) {
                    $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
}
