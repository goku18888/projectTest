<?php

namespace App\Http\Controllers\Cilent;

use App\Http\Controllers\Controller;
use App\Models\bills;
use App\Models\customers;
use App\Models\order;
use App\Models\products;
use App\Models\shipping;
use App\Models\statisticals;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction(Request $request)
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

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        //add bills
        $shippingFee = session()->get('fee');
        $customer = session()->get('user_login_id');
        $cart = session()->get('cart');
        //lay total
        $totalPrice = 0;
        foreach ($cart as $item) {
            $price = $item['price_product'];
            $amount = $item['amount'];
            $subtotal = $price * $amount;
            $totalPrice += $subtotal;
        }
        //PayPal
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('us.successTransaction'),
                "cancel_url" => route('us.cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format(($totalPrice + $shippingFee)/23000 ,2)
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('us.createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('us.createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        //add bills
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
        //lay total
        $totalPrice = 0;
        foreach ($cart as $item) {
            $price = $item['price_product'];
            $amount = $item['amount'];
            $subtotal = $price * $amount;
            $totalPrice += $subtotal;
        }
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
            $totalOrder = bills::where('order_date', now()->format('Y-m-d'))->get()->count();
            
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
            );
            Mail::send('cilent.mail.mail',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array],
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
            );
            Mail::send('admin.mail.mail_admin',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'bill_fee'=>$bill_fee],
            function($message)use($title_mail,$data){
                $message->to('hoctap438@gmail.com')->subject($title_mail);
                $message->from($data['email'],$title_mail);
            });
            // quen cart
            Session::forget('cart');
            Session::forget('fee');
        //PayPal
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('us.createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('us.createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('us.createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}

