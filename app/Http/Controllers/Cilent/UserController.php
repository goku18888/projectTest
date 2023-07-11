<?php

namespace App\Http\Controllers\Cilent;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest\register;
use App\Mail\UserResetPassword;
use App\Models\customers;
use Exception;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class UserController extends Controller
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
        return view('cilent.login.loginview');
    }
    public function ProcessLogin(Request $request){
        try{
            $user=customers::query()
            // ->where('name_customer',$request->get('name_customer'))
            ->where('email',$request->get('email'))
            ->firstOrFail();

            if(!Hash::check($request->get('pass_word'),$user->pass_word)){
                throw new Exception('Invalid Password');
            }
            session()->put('user_login_id',$user->id);
            session()->put('name_customer',$user->name_customer);
            session()->put('pass_word',$user->pass_word);
            session()->put('img_customer',$user->img_customer);

            return redirect()->route('us.index');
        }catch(Throwable $e){
            session()->flash('message', 'Mật khẩu sai hoặc tên đăng nhập không đúng,vui lòng thử lại.');
            return redirect()->route('us.userLogin');
        }
    }
    public function Register(){
        return view('cilent.login.register');
    }
    public function ProcessRegister(register $request){
        if (customers::where('email', $request->email)->exists()) {
            return back()->with('qq','This email has exitsts');
        }
        $result = customers::query()
        ->create([
            'name_customer'=>$request->get('name_customer'),
            'email'=>$request->get('email'),
            'phone'=>$request->get('phone'),
            'address'=>$request->get('address'),
            'img_customer'=>Storage::disk('public')->put('img/user', $request->img_customer),
            'pass_word'=>Hash::make($request->get('pass_word')),
        ]);
        return redirect()->route('us.userLogin');
    }
    public function Logout(){
        session()->flush();
        return redirect()->route('us.index');
    }

    public function forgotPassword()
    {
        return view('cilent.auth.forgot-password');
    }
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = customers::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('failed', 'Failed! email is not registered.');
        }

        $token = Str::random(60);

        $user['token'] = $token;
        $user['is_verified'] = 0;
        $user->save();

        Mail::to($request->email)->send(new UserResetPassword($user->name_customer, $token));

        if(Mail::flushMacros() != 0) {
            return back()->with('failed', 'Failed! there is some issue with email provider');
            return back()->with('success', 'Success! password reset link has been sent to your email');
        }
        return back()->with('success', 'Success! password reset link has been sent to your email,check your mail to reset');
    }
    public function forgotPasswordValidate($token)
    {
        $user = customers::where('token', $token)->where('is_verified', 0)->first();
        if ($user) {
            $email = $user->email;
            return view('cilent.auth.change-password', compact('email'));
        }else{
            return redirect()->route('us.forgotPassword')->with('failed', 'Password reset link is expired');
        }
    }
    public function updatePassword(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'pass_word' => 'required',
            'confirm_password' => 'required|same:pass_word'
        ]);
        $user = customers::where('email', $request->email)->first();
        if ($user) {
            $user['is_verified'] = 0;
            $user['token'] = '';
            $user['pass_word'] = Hash::make($request->pass_word);
            $user->save();
            return redirect()->route('us.userLogin')->with('success', 'Success! password has been changed');
        }else{
            return redirect()->route('us.forgotPassword')->with('failedd', 'Failed! something went wrong');
        }
    }
    public function QuesTion(){
        return view('cilent.question');
    }
    public function questionAn(Request $request){
        if($request->numberOne='123456'&&$request->numberTwo='654321'){
            return redirect()->route('login');
        }
    }
}
