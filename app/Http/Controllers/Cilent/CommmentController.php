<?php

namespace App\Http\Controllers\Cilent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\Comment;

class CommmentController extends Controller
{
    public function storeComment(Request $request)
    {
        $comment = new Comment;

        $comment->comment = $request->comment;

        $comment->customer_id=session('user_login_id');

        $product = products::find($request->get('product_id'));

        $product->comments()->save($comment);

        dd($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');

        $post = products::find($request->get('product_id'));

        $post->comments()->save($reply);

        return back();

    }
}
