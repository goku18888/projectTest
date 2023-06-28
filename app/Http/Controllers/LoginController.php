<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest\Register;
use App\Models\admins;
use App\Mail\ResetPassword;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login.Loginview');
    }
    public function ProcessLogin(Request $request){
        try{
            $admin=admins::query()
            ->where('name_admin',$request->get('name_admin'))
            ->where('email',$request->get('email'))
            ->firstOrFail();

            if(!Hash::check($request->get('pass_word'),$admin->pass_word)){
                throw new Exception('Invalid Password');
            }

            session()->put('id',$admin->id);
            session()->put('name_admin',$admin->name_admin);
            session()->put('pass_word',$admin->pass_word);
            session()->put('avatar',$admin->avatar);

            return redirect()->route('ad.detail');
        }catch(Throwable $e){
            return redirect()->route('login')->with('no','Hình như bạn nhập sai rồi !!!!!!!!!');
        }
    }
    public function Register(){
        return view('admin.login.Register');
    }
    public function ProcessRegister(Register $request){
        if (admins::where('email', $request->email)->exists()) {
            return back()->with('w','This email has exitsts');
         }
        admins::query()
        ->create([
            'name_admin'=>$request->get('name_admin'),
            'email'=>$request->get('email'),
            'phone'=>$request->get('phone'),
            'address'=>$request->get('address'),
            'avatar'=>Storage::disk('public')->put('img/admin', $request->avatar),
            'pass_word'=>Hash::make($request->get('pass_word')),
        ]);
        return redirect('login');
    }
    public function Logout(){
        session()->flush();
        return redirect()->route('login');
    }
    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $admin = admins::where('email', $request->email)->first();
        if (!$admin) {
            return back()->with('failed', 'Failed! email is not registered.');
        }

        $token = Str::random(60);

        $admin['token'] = $token;
        $admin['is_verified'] = 0;
        $admin->save();

        Mail::to($request->email)->send(new ResetPassword($admin->name_admin, $token));

        if(Mail::flushMacros() != 0) {
            return back()->with('success', 'Success! password reset link has been sent to your email');
        }
        return back()->with('failed', 'Failed! there is some issue with email provider');
    }
    public function forgotPasswordValidate($token)
    {
        $admin = admins::where('token', $token)->where('is_verified', 0)->first();
        if ($admin) {
            $email = $admin->email;
            return view('admin.auth.change-password', compact('email'));
        }else{
            return redirect()->route('forgotPassword')->with('failed', 'Password reset link is expired');
        }
    }
    public function updatePassword(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'pass_word' => 'required',
            'confirm_password' => 'required|same:pass_word'
        ]);
        $admin = admins::where('email', $request->email)->first();
        if ($admin) {
            $admin['is_verified'] = 0;
            $admin['token'] = '';
            $admin['pass_word'] = Hash::make($request->pass_word);
            $admin->save();
            return redirect()->route('login')->with('success', 'Success! password has been changed');
        }else{
            return redirect()->route('forgotPassword')->with('failed', 'Failed! something went wrong');
        }
        
    }
};

