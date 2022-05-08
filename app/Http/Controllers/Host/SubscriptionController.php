<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Stripe;
use App\Contracts\UserContract;
use App\Mail\AdminMail;
use App\Mail\StripeConnectMail;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    protected  $userRepository;
    protected  $stripe;
    public function __construct( UserContract $userRepository) {
        $this->userRepository       =   $userRepository;
        $this->stripe = Stripe::make(config('services.stripe.secret'));
    }


    public function index()
    {
        $subscription = auth()->user()->subscription;
        $plans = Plan::all()->groupBy('type');

        return view('host.subscription.index', compact('subscription', 'plans'));
    } 

    public function subsPayment(Request $request)
    {
        $plan = Plan::whereStripeProdId($request->pid)->first();

        return view('host.subscription.payment', compact('plan'));
    } 

    public function cancel(Request $request)
    {
        $subscription = Subscription::whereStripeCusId($request->cid)->first();
        $freePlan = Plan::whereType('free')->first();
        if($subscription){

            $this->stripe->subscriptions()->cancel($subscription->stripe_cus_id, $subscription->stripe_subs_id);

            $subscription->last_stripe_prod = $subscription->stripe_prod_id;
            $subscription->stripe_prod_id = $freePlan->stripe_prod_id;
            $subscription->last_stripe_subs = $subscription->stripe_subs_id;
            $subscription->stripe_subs_id = null;
            $subscription->status = 'unsubscribed';            
            $subscription->save();

            if($subscription->host->stripe_status != 'completed'){
                $subscription->host->update(['stripe_status' => 'pending']);
            }

            return response()->json(['status'=> true, 'message' => 'Subscription Cancelled!']);
        }
        return response()->json(['status'=> false, 'message' => 'Something went wrong!']);
    } 

    public function newSubscription(Request $request)
    {
       $input = $request->all();
       $plan_price = Plan::getPlanPriceId($input['pid']);
       if(isset(auth()->user()->subscription)){
        $subscription = Subscription::whereStripeCusId(auth()->user()->subscription->stripe_cus_id)->first();

        $subsResponse = $this->stripe->subscriptions()->create(auth()->user()->subscription->stripe_cus_id,
            [ 'items' => [ ['price' => $plan_price]] ]
        );
        $invoice = $this->stripe->invoices()->find($subsResponse['latest_invoice']);

            if($subscription){
                $subscription->last_stripe_prod = $subscription->stripe_prod_id;
                $subscription->stripe_prod_id = $subsResponse['plan']['product'];
                $subscription->last_stripe_subs = $subscription->last_stripe_subs;
                $subscription->stripe_subs_id = $subsResponse['id'];
                $subscription->status = 'subscribed';
                $subscription->next_billing = Carbon::parse($subsResponse['current_period_end'])->format('Y-m-d H:i:s');
                $subscription->receipt = $invoice['hosted_invoice_url'];
                $subscription->save();

                if($subscription->host->stripe_status != 'completed'){
                    $subscription->host->update(['stripe_status' => 'pending']);
                }

                $request->session()->flash('alert-success', 'Subscription Successful!');
                return redirect()->back();
            }
            $request->session()->flash('alert-danger', 'Something went wrong.');
            return redirect()->back();
       }

       $customer = $this->stripe->customers()->create(['email' => auth()->user()->email, 'name' => $input['card_name']]);
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


       $subscription = $this->stripe->subscriptions()->create($customer['id'],
           [ 'items' => [ ['price' => $plan_price]] ]
       );
       $user = User::find(auth()->user()->id);
       $user->subscriber()->create([
            'stripe_cus_id' => $customer['id'],
            'card_last_four' => substr($input['number'], -4)                
        ]);
        $invoice = $this->stripe->invoices()->find($subscription['latest_invoice']);

         $this->userRepository->createSubscription($subscription, auth()->user()->id, $invoice);

           $account = $this->stripe->account()->create(['type' => 'express', 'email' => auth()->user()->email]);
           $stripeLink = $this->stripe->account()->accountLinks()->create([
               'account' => $account['id'],
               'refresh_url' => url('/stripe/reauth'),
               'return_url' => url('/stripe/return'),
               'type' => 'account_onboarding',
           ]);       
   
           $user->update([
               'stripe_connect_id' => $account['id'],
               'stripe_connect_link' => $stripeLink['url'],
               'stripe_status' => 'pending'
           ]);

           $stripeLink = route('user.redirectToStripe',[
               'a' => $account['id'],
               'id' => auth()->user()->email
           ]);

           //Send mail to admin
           $data['to'] = 'info@parkinggenie.com';
           $data['from'] = 'no-reply@parkinggenie.com';
           $data['subject'] = 'New Subscription | Parking Genie';
           $data['body'] = "New subscription made through {{ auth()->user()->email }}";
           Mail::to($data['to'])->send(new AdminMail($data));

           //Send mail to new user
           Mail::to(auth()->user()->email)->send(new StripeConnectMail($stripeLink));

           $request->session()->flash('alert-success', 'Subscription Successful!');
           return redirect()->route('host.dashboard.index');
        }
}
