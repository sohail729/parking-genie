<?php

namespace App\Http\Controllers\User;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Mail\AdminMail;
use App\Mail\StripeConnectMail;
use App\Mail\StripeConnectRefreshMail;
use App\Models\Plan;
use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Models\User;
use Cartalyst\Stripe\Exception\StripeException;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected  $userRepository;
    protected  $stripe;
    public function __construct( UserContract $userRepository) {
        $this->userRepository       =   $userRepository;
        $this->stripe = Stripe::make(config('services.stripe.secret'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        if(!empty($input['plan']) && (!empty($input['ptype']) && $input['ptype'] != 'free')){
            $customer = $this->stripe->customers()->create([ 'email' => $input['email'], 'name' => $input['card_name']]);
            $input['stripe_cus_id'] = $customer['id'];
            $input['card_last_four'] = $input['number'];
            $input['expiry'] = explode("/", $input['exp']);
    
            try {
                $token = $this->stripe->tokens()->create([
                    'card' => [
                        'number'    => $input['number'],
                        'exp_month' => trim(current( $input['expiry'])),
                        'cvc'       => $input['cvc'],
                        'exp_year'  => trim(end( $input['expiry'])),
                    ],
                ]);    
            } catch (CardErrorException $e) {
                $message = $e->getMessage();
                $request->session()->flash('alert-danger', $message);
                return redirect()->back()->withInput($input);                
            } 
            
            $this->stripe->cards()->create($customer['id'], $token['id']);
            $plan_price = Plan::getPlanPriceId($input['plan']);
            $subscription = $this->stripe->subscriptions()->create($customer['id'],
                [ 'items' => [ ['price' => $plan_price]] ]
            );
            $invoice = $this->stripe->invoices()->find($subscription['latest_invoice']);
            $userId = $this->userRepository->userSignup($input);
            $this->userRepository->createSubscription($subscription, $userId, $invoice);

            if($userId){
                $account = $this->stripe->account()->create(['type' => 'express', 'email' => $input['email']]);
                $stripeLink = $this->stripe->account()->accountLinks()->create([
                    'account' => $account['id'],
                    'refresh_url' => url('/stripe/reauth'),
                    'return_url' => url('/stripe/return'),
                    'type' => 'account_onboarding',
                ]);       
        
                $user = User::find($userId)->update([
                    'stripe_connect_id' => $account['id'],
                    'stripe_connect_link' => $stripeLink['url'],
                    'stripe_status' => 'pending'
                ]);

                $stripeLink = route('user.redirectToStripe',[
                    'a' => $account['id'],
                    'id' => $input['email']
                ]);

                //Send mail to admin
                $data['to'] = 'info@parkinggenie.com';
                $data['from'] = 'no-reply@parkinggenie.com';
                $data['subject'] = 'New User Registered | Parking Genie';
                $data['body'] = 'A new user registered.';
                Mail::to($data['to'])->send(new AdminMail($data));

                //Send mail to new user
                Mail::to($input['email'])->send(new StripeConnectMail($stripeLink));

                return redirect()->route('front.signup.success', ['stripeLink' => $stripeLink]);
            }

        }else{
            $userId = $this->userRepository->userSignup($input);
            if($userId){
                return redirect()
                ->route('front.home')
                ->with('toastr.success','Congrats! You will be notified when our team approves your account.');
            }

        }       
        
    }

    public function signupSuccess(Request $request)
    {
        $stripeLink = $request->stripeLink;
        if($stripeLink){
            return view('front.signup-success', compact('stripeLink'));
        }
        return redirect()->route('front.home');
    } 

    public function edit()
    {
        $user = auth()->user();
        $countries =  DB::table('countries')->pluck('name', 'code');
        return view('user.profile.form', compact('user', 'countries'));
    } 

    public function update(Request $request)
    {
        $input = $request->all();
        $user = auth()->user()->id;
        $this->userRepository->update($input, $user);
        return redirect()->route('user.profile.edit')->with('toastr.success', 'Profile updated successfully!'); 
    } 



    public function refresh(Request $request)
    {
        try {
            // $this->stripe->account()->update(auth()->user()->stripe_connect_id,[
            //     'email' => auth()->user()->email
            // ]);

            $stripeLink = $this->stripe->account()->accountLinks()->create([
                'account' =>   auth()->user()->stripe_connect_id,
                'refresh_url' => url('/stripe/reauth'),
                'return_url' => url('/stripe/return'),
                'type' => 'account_onboarding',
            ]); 

        } catch (StripeException $e) {
            $message = $e->getMessage();
            $request->session()->flash('alert-danger', $message);
            return redirect()->back(); 
        }

        $user = User::find(auth()->user()->id)->update([
            'stripe_connect_link' => $stripeLink['url']
        ]);

        $stripeLink = route('user.redirectToStripe',[
            'a' => auth()->user()->stripe_connect_id,
            'id' => auth()->user()->email
        ]);

         //Send mail to new user
         Mail::to(auth()->user()->email)->send(new StripeConnectRefreshMail($stripeLink));

        $request->session()->flash('alert-success', 'Stripe Connect Link has been refreshed!');
        return redirect()->route('host.dashboard.index');
    }

    public function reauth()
    {
        return redirect()
        ->route('front.home')
        ->with('toastr.error','Expired link!');
    }

    public function return(Request $request)
    {
        User::whereId(auth()->user()->id)->update([ 'stripe_status' => 'completed' ]);
        auth()->logout();
        return redirect()
        ->route('front.home')
        ->with('toastr.success', 'Account setup completed! You may now start listing parking spaces.');
    }

    public function verifyEmail(Request $request)
    {
        $response = User::whereEmail($request->email)->first();
        if($response){
            return 'false';
        }
        return 'true';       
    }

    public function choosePlan()
    {
        $plans = Plan::all()->groupBy('type');
        // $plans = collect($this->stripe->plans()->all()['data']);
        // $plans =  $plans->sortBy('created')->groupBy('name');
        return view('front.choose-plan', compact('plans'));
    }

    public function showSignup(Request $request)
    {
        $plan = $request->p ?? '';
        $type = $request->t ?? '';
        $plantypes = Plan::all()->pluck('type')->toArray();
        if($type!='')  $plan=Plan::where('type',$type)->get();
        $countries =  DB::table('countries')->pluck('name', 'code');
        return view('front.signup', compact('countries','plan', 'type','plantypes'));
    }
}
