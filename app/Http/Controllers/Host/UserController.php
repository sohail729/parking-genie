<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Contracts\UserContract;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    protected  $userRepository;
    public function __construct( UserContract $userRepository) {
        $this->userRepository       =   $userRepository;
    }

    public function edit()
    {
        $user = auth()->user();
        $countries =  DB::table('countries')->pluck('name', 'code');
        return view('host.profile.form', compact('user', 'countries'));
    } 

    public function update(Request $request)
    {
        $input = $request->all();
        $user = auth()->user()->id;
        $this->userRepository->update($input, $user);
        return redirect()->route('host.profile.edit')->with('toastr.success', 'Profile updated successfully!'); 
    } 
}
