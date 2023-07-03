<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckLoginMiddleware;
use App\Models\admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $search=$request->get('ab');
        $admins = admins::all();
        return view('admin.profile.index', [
            'search' => $search,
            'admins' => $admins,
        ]);
    }
    public function edit(Request $request,$id)
    {
        $search=$request->get('ab');
        $admins = admins::where('id',$id)->first();
        return view('admin.profile.edit', [
            'search' => $search,
            'admins' => $admins,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => ['required', 'regex:/^0\d{9}$/'],
            'email' => ['required', 'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/'],
        ]);

        $admin = admins::findOrFail($id);
        // Xử lý ảnh
        if ($request->hasFile('file_avatar')) {
            // Xóa ảnh cũ
            Storage::disk('public')->delete('img/admin/' . $admin->avatar);
        
            // Lưu ảnh mới
            $img_admin = Storage::disk('public')->put('img/admin/', $request->file('file_avatar'));
        
            // Cập nhật trường img_customer
            $admin->avatar = $img_admin;
        }
        // Kiểm tra trường `name_admin` mới va cap nhap
        $admin->name_admin = $request->input('name_admin');
        $admin->phone = $request->input('phone');
        $admin->email = $request->input('email');
        $admin->address = $request->input('address');
        // Kiểm tra trùng lặp trong cơ sở dữ liệu
        $existingAdmin = admins::where('name_admin', $admin->name_admin)
        ->where('id', '!=', $admin->id)
        ->first();

        if ($existingAdmin) {
            return back()->with('error', 'Tên admin đã tồn tại trong cơ sở dữ liệu.');
        }
        // Cập nhật trường `name_customer`
        $admin->save();
        return redirect('admin/profile');
    }
    public function destroy($id)
    {
        admins::where('id', $id)->delete();
        return redirect()->route('ad.profile');
    }
}
