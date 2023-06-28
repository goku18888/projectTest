<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Models\bills;
use App\Models\order;
use App\Models\producttypes;
use App\Models\suppliers;
use App\Models\threads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class SupplierController extends Controller
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
        $supplier=DB::table('suppliers')
        ->select('suppliers.id','name_supplier','email','phone')
        ->where('name_supplier','like','%'.$search.'%')
        ->get();

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

        return view('admin.Supplier.index',[
            'supplier'=>$supplier,
            'search'=>$search,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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

        return view('admin.Supplier.Supplier',[
            'search'=>$search,
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
    public function store(StoreRequest $request)
    {
        $suppliers = suppliers::create(array_merge($request->validated()));
        return redirect('admin/products');
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
        $suppliers = suppliers::where('id',$id)->first();

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

        return view('admin.Supplier.update', [
            'suppliers' => $suppliers,
            'search' => $search,
            'suppliers' => $suppliers,
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
        suppliers::where('id',$id)->update(array_merge($request->validated()));
        return redirect('admin/suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        suppliers::where('id', $id)->delete();
        return redirect('admin/suppliers');
    }
}
