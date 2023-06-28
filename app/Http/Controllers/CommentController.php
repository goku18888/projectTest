<?php

namespace App\Http\Controllers;

use App\Models\bills;
use App\Models\Comment;
use App\Models\customers;
use App\Models\order;
use App\Models\products;
use App\Models\producttypes;
use App\Models\suppliers;
use App\Models\threads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    public function __construct()
    {
        $routeName=Route::currentRouteName();
        $arre=explode('.',$routeName);
        $arr=array_map('ucfirst',$arre);
        $title=implode('-',$arr);

        View::share('title',$title);
    }
    public function list_comment(Request $request){
        $search=$request->get('comment');

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

        $comment=Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('id','DESC')->where('customer_name','like','%'.$search.'%')->get();
        $comment_rep=Comment::with('product')->where('comment_parent_comment','>',0)->orderBy('id','DESC')->get();
        return view('admin.comment.viewComment',[
            'comment'=>$comment,
            'comment_rep'=>$comment_rep,
            'messages' => $messages,
            'billsenger' => $billsenger,
            'search' => $search,
            'Type' => $Type,
            'Sup' => $Sup,
        ]);
    }
    public function allow_comment(Request $request){
        $data=$request->all();
        $comment=Comment::find($data['comment_id']);
        $comment->comment_status=$data['comment_status'];
        $comment->save();
    }
    public function reply_comment(Request $request){
        $data=$request->all();
        $comment=new Comment();
        $comment->comment=$data['comment'];
        $comment->product_id=$data['product_id'];
        $comment->comment_parent_comment=$data['comment_id'];
        $comment->comment_status=0;
        $comment->customer_name='Vinh Shop';
        $comment->save();
    }
    public function delete_comment($id){
        Comment::where('id', $id)->delete();
        return redirect()->route('ad.list_comment');
    }
}
