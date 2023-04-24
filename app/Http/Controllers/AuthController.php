<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function getLogin()
    {
        session()->put('previousUrl', url()->previous());
        return view('login');
    }
    public function getSignup()
    {
        return view('signup');
    }

    public function store(UserRequest $request)
    {
        if (User::where('email', $request->email)->doesntExist()) {
            $newUser = $request->validated();
            if ($newUser['avatar']) {
                $file = $newUser['avatar'];
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = Str::random(5) . "." . $fileExtension;
                $file->move("uploads", $fileName);
            }
            $newUser['password'] = bcrypt($request->password);
            $newUser['avatar'] = $fileName;

            User::create($newUser);
            return redirect('/dang-ky')->with('message', 'Đăng ký thành công xin mời đăng nhập');
        } else {
            return redirect('/dang-ky')->with('message', 'Tài khoản đã tồn tại xin mời đăng nhập');
        }
    }
    public function checkLogin(Request $request)
    {
        $rule = [
            'email' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'required' => 'Trường bắt buộc phải nhập'
        ];
        $user = $request->validate($rule, $messages);
        $remember = $request->remember;
        if (Auth::attempt(['email' => $user['email'], 'password' => $user['password']], $remember)) {
            if ($remember == 'on') {
                $user = User::find(Auth::user()->id);
                $user->remember_token = Str::random(60);
                $user->update();
            } else {
                $user = User::find(Auth::user()->id);
                $user->remember_token = null;
                $user->update();
            }
            if (Auth::user()->role == 0 || Auth::user()->role == 3) {
                return redirect('admin/index')->with('message', 'Đăng nhập thành công');
            } else if (Auth::user()->role == 2) {
                Auth::logout();
                return redirect('/')->with('message', 'Tài khoản đã bị khoá không thể sử dụng các tính năng của website , hãy liên hệ
                admin để nhận trợ giúp');
            } else {
                return redirect('/');
            }
        } else {
            return redirect()->route('login')->with('message', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function logout()
    {
        Auth::logout();
        return back()->with('message', 'Đăng xuất thành công');
    }
}
