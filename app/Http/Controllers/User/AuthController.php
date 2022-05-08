<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        UserContract $userRepository
    ) {
        $this->userRepository       =   $userRepository;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->get('remember'))) {
            if (Auth::check() && Auth::user()->status == 0) {
                Auth::logout();
                $request->session()->flash('modal-alert-danger', 'Your account is not active.');
                return redirect()->back();
            } else {
                if(Auth::user()->hasRole(['super','admin'])){
                    return redirect()->route('admin.dashboard.index');
                }elseif(Auth::user()->hasRole('host')){
                    return redirect()->route('host.dashboard.index');
                }elseif(Auth::user()->hasRole('user')){
                    return redirect()->route('front.find-space');
                }
                return redirect()->intended('/')
                ->with('toastr.success','You\'re Logged In Successfully!');
            }
        } else {
            $request->session()->flash('modal-alert-danger', 'Incorrect email or password!');
            return redirect()->back();
        }
    }

    public function showChangePassword() {
        return view('dashboard.change-password');
    }

    public function redirectToStripe(Request $request) {

        $user = User::whereStripeConnectId($request->a)->first();
        auth()->login($user);
        return redirect()->to($user->stripe_connect_link);
    }

    public function changePassword(Request $request) {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->withErrors(["error"=>"Your current password does not matches with the password."]);
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->withErrors(["error"=>"New Password cannot be same as your current password."]);
        }

        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ],[],['current-password' => 'current password', 'new-password' => 'new password']);

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        $request->session()->flash('alert-success', "Password successfully changed!");
        return redirect()->back();
    }
}
