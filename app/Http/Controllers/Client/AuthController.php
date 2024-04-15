<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Searchable\ModelSearchAspect;
use App\Models\Film;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        if(!$request->isMethod('post')){
            return view('client.page.login');
        }

        $validate = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:4', 'max:64'],
            'password' => ['required', 'string', 'min:4', 'max:200']
        ], [
            'username.required' => 'Tài khoản không được bỏ trống',
            'username.string' => 'Tài khoản không hợp lệ',
            'username.regex' => 'Tài khoản chứa ký tự không hợp lệ',
            'username.min' => 'Tài khoản phải có 4 ký tự trở lên',
            'username.max' => 'Tài khoản không được vượt quá 64 ký tự',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.string' => 'Mật khẩu không hợp lệ',
            'password.regex' => 'Mật khẩu chứa ký tự không hợp lệ',
            'password.min' => 'Mật khẩu phải có 4 ký tự trở lên',
            'password.max' => 'Mật khẩu không được vượt quá 200 ký tự'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($validate->fails()) {
            return  back()->with('error',$validate->errors()->first());
        }elseif(!$user)
        {
            return back()->with('error','Tài khoản này không tồn tại');
        } elseif (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return  back()->with('success','Đăng nhập thành công');
        } else {
            return  back()->with('error',"Mật khẩu không đúng");
        }
    }

    public function Register(Request $request)
    {
        if(!$request->isMethod('post')){
        return view('client.page.register');
        }

        $validate = Validator::make($request->all(), [
            'name' => ['required','string', 'min:4', 'max:64'],
            'username' => ['required','string', 'min:4', 'max:64', 'unique:users,username'],
            'password' => ['required', 'string', 'min:5'],
            're-password'=>['required','string','min:5','same:password'],
        ],[
            'name.required' => 'Họ và tên không được bỏ trống',
            'name.string' => 'Họ và tên phải là một string',
            'name.min' => 'Họ và tên phải có 4 - 64 ký tự',
            'name.max' => 'Họ và tên không được vượt quá 64 ký tự',
            'username.required' => 'Tên đăng nhập không được bỏ trống',
            'username.string' => 'Tên đăng nhập phải là một string',
            'username.min' => 'Tên đăng nhập phải có 4 - 64 ký tự',
            'username.max' => 'Tên đăng nhập không được vượt quá 64 ký tự',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.string' => 'Mật khẩu phải là một string',
            'password.min' => 'Mật khẩu phải có 5 ký tự trở lên',
            're-password.required' => 'Mật khẩu xác nhận không được bỏ trống',
            're-password.string' => 'Mật khẩu xác nhận phải là một string',
            're-password.min' => 'Mật khẩu xác nhận phải có 5 ký tự trở lên',
            're-password.same' => 'Mật khẩu xác nhận không chính xác',
        ]);

        if ($validate->fails()) {
            return back()->with('error',$validate->errors()->first());
        }else {
            $save = User::create([
                'name'    => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            if ($save) {
                Auth::login($save);
                return  back()->with('success','Đăng ký tài khoản thành công');
            } else {
                return  back()->with('error','Đăng ký tài khoản thất bại');
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
