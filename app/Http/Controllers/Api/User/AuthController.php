<?php
namespace App\Http\Controllers\Api\User;

use Auth;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Authentication extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'mobile'           => 'mobile',
            'password'         => 'required|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20',
        ]);

        $user = [
            'mobile'   => $request->get('mobile'),
            'email'    => $request->get('email'),
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
        ];
        $user  = User::create($user);
        $token = Auth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'mobile'   => 'required|exists:users',
            'password' => 'required|string|min:6|max:20',
        ]);

        $credentials = $request->only(['mobile', 'password']);

        return (($token = Auth::guard('api')->attempt($credentials))
            ? response()->json(['token' => 'bearer ' . $token], 201)
            : response()->json(['error' => '账号或密码错误'], 401));
    }

    public function info()
    {
        return response()->json(Auth::user());
    }
}
