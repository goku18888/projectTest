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
        $authAdmin = admins::where('id', Session::get('id'))->first();
        if ($request->hasFile('file_avatar')) {
            $file = $request->file_avatar;
            $fileName = time() . '.' . $file->getClientOriginalName('file_avatar');
            Storage::disk('public')->put('img/admin/'. $fileName, File::get($file));
            $request->merge([
                'avatar' => $fileName
            ]);
        }
        // Kiểm tra trường `name_customer` mới
        $newNameAdmin = $request->input('name_admin');
        // Kiểm tra trùng lặp trong cơ sở dữ liệu
        $existingAdmin = admins::where('name_admin', $newNameAdmin)
        ->where('id', '!=', $authAdmin->id)
        ->first();

        if ($existingAdmin) {
            return back()->with('error', 'Tên admin đã tồn tại trong cơ sở dữ liệu.');
        }
        // Cập nhật trường `name_customer`
        $authAdmin->name_admin = $newNameAdmin;
        $authAdmin->save();
    }
    public function destroy($id)
    {
        admins::where('id', $id)->delete();
        return redirect()->route('ad.profile');
    }
}
