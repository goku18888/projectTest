<?php

namespace App\Http\Controllers;

use App\Models\admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit()
    {
        $users = admins::find(session()->get('id'));
        return view('admin.profile.changepassword',compact('users'));
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
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'password_confirmation' => 'required',
        ]);
    
        $user = admins::find(session()->get('id'));
    
        // Kiểm tra mật khẩu cũ
        if (Hash::check($request->oldpassword, $user->pass_word)) {
            // Kiểm tra mật khẩu mới và xác nhận mật khẩu
            if ($request->newpassword === $request->password_confirmation) {
                $user->pass_word = bcrypt($request->newpassword);
                $user->save();
    
                session()->flash('message', 'Mật khẩu đã được cập nhật thành công');
                return redirect()->route('ad.profile');
            } else {
                session()->flash('message', 'Mật khẩu mới không trùng khớp với xác nhận mật khẩu');
                return redirect()->back();
            }
        } else {
            session()->flash('message', 'Mật khẩu cũ không đúng');
            return redirect()->back();
        }
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
}
