<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class SettingsController extends Controller
{
    public function __construct(
        UserContract $userRepository) {
        $this->userRepository       =   $userRepository;
    }

    public function showProfile()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    } 

    public function editProfile()
    {
        $user = auth()->user();
        $countries =  DB::table('countries')->pluck('name', 'code');
        return view('admin.profile.form', compact('user', 'countries'));
    } 

    public function updateProfile(Request $request)
    {
        $input = $request->all();
        $user = auth()->user()->id;
        $this->userRepository->update($input, $user);
        return redirect()->route('admin.profile.show')->with('alert-success', 'Profile updated successfully!'); 
    } 
}
