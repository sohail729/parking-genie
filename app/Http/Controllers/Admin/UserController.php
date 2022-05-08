<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Mail\AccountStatusMail;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;


class UserController extends Controller
{
    public function __construct(
        UserContract $userRepository) {
        $this->userRepository       =   $userRepository;
    }

    public function index()
    {

    }
    public function getAdmins()
    {
        $admins = User::whereType('admin')->get();
        return view('admin.admin.index', compact('admins'));
    }

    public function getHosts()
    {
        $hosts = User::whereType('host')->get();
        return view('admin.host.index', compact('hosts'));
    }

    public function getCustomers()
    {
        $customers = User::whereType('user')->get();
        return view('admin.customer.index', compact('customers'));
    }


    public function edit(User $user)
    {
        $countries =  DB::table('countries')->pluck('name', 'name');
        return view('admin.user.form', compact('user', 'countries'));
    }


    public function update(Request $request, $userId)
    {
        $input = $request->all();
        $user = $this->userRepository->getSingle($userId);
        $response = $this->userRepository->update($input, $userId);
        if($input['status'] != $user->status){
             $data = [];
            if($input['status'] != 0){
                $data['body'] = 'Thank you for registering at Parking Genie. Your account has been activated.';            
            }else{
                $data['body'] = 'Your account has been de-activited. Please contact customer care for information.';
            }
            Mail::to($input['email'])->send(new AccountStatusMail($data));
           Toastr::success('Status email sent to user!','', ["progressBar" => "true", "positionClass" => "toast-top-right"]);
        }
        $request->session()->flash('alert-success', 'Record has been updated!');
        return redirect()->back();
    }

    public function destroy($userId)
    {
        $response = $this->userRepository->destroy($userId);
        if($response){
            return true;
        }
        return false;
           
    }
}
