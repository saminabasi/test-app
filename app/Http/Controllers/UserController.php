<?php

namespace App\Http\Controllers;

use App\Models\logincode;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\ConfirmUserRequest;
use App\AppRepository\User\UserRepository;
use App\Http\Requests\LoginOrRegisterRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application as FoundationApplication;

class UserController extends Controller implements UserRepository
{

    public function showLoginForm(): View|FoundationApplication|Factory|Application
    {
        return view('login');
    }

    public function showConfirmForm(User $user)
    {
        return view('confirm');
    }

    public function loginOrRegister(LoginOrRegisterRequest $request)
    {
        $mobile = $request->input('mobile');
        $user = User::where('mobile', $mobile)->first();

        if(!$user) {
            $user = User::create([
                'mobile' => $mobile,
            ]);
        }
        if (!LoginCode::where('user_id', $user->id)->where('created_at', '>', Carbon::now()->subMinutes(2))->exists()) {
            $loginCode = rand(100000,999999);

            LoginCode::create([
                'user_id' => $user->id,
                'code' => $loginCode,
            ]);
        }
        return redirect()->route('confirm', ['user'=>$user->id]);
    }

    public function confirmAndLogin(ConfirmUserRequest $request, User $user)
    {
        $loginCode = LoginCode::where('user_id', $user->id)->where('created_at', '>', Carbon::now()->subMinutes(2))->first();

        if ($loginCode) {
            $userCode = $request->input('code');
            if ($userCode === $loginCode->code) {
                Auth::login($user);
                $request->session()->flash('status', "ورود با موفقیت انجام شد");
            } else {
                $request->session()->flash('status', "کد وارد شده نامعتبر است");
            }
        } else {
            $newLoginCode = rand(100000,999999);
            LoginCode::create([
                'user_id' => $user->id,
                'code' => $newLoginCode,
            ]);
            $request->session()->flash('status', "کد لاگین جدید ارسال شد");
        }
        return view('confirm');
    }
}
