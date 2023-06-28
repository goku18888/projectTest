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
            ]);
     
           $hashedPassword = session()->get('pass_word');
     
            if (Hash::check($request->oldpassword , $hashedPassword )) {
     
                if (!Hash::check($request->newpassword , $hashedPassword)) {
     
                  $users =admins::find(session()->get('id'));
                  $users->pass_word = bcrypt($request->newpassword);
                  admins::where( 'id' , session()->get('id'))->update( array( 'pass_word' =>  $users->pass_word));
     
                  session()->flash('message','password updated successfully');
                  return redirect()->route('ad.profile');
                }
     
                else{
                      session()->flash('message','new password can not be the old password!');
                      return redirect()->back();
                    }
               }
     
            else{
                session()->flash('message','old password doesnt matched ');
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
