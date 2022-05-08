<div class="row g-gs">
  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Name</label>
          <div class="form-control-wrap">
             <div class="form-control">{{ $subscription->subscriber_info->fname }} {{ $subscription->subscriber_info->lname }}</div>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Email</label>
          <div class="form-control-wrap">
             <div class="form-control">{{ $subscription->subscriber_info->email }}</div>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Stripe Customer ID </label>
          <div class="form-control-wrap">
            <div class="form-control"> {{ $subscription->stripe_cus_id }}</div>
          </div>
      </div>
  </div>

  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Current Plan</label>
          <div class="form-control-wrap">
             <div class="form-control">{{ $subscription->info->plan->name }}</div>
          </div>
      </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Stripe Product ID </label>
        <div class="form-control-wrap">
          <div class="form-control"> {{ $subscription->stripe_prod_id }}</div>
        </div>
    </div>
</div>
<div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Stripe Price ID</label>
          <div class="form-control-wrap">
            <div class="form-control"> {{  $subscription->info->plan->id }} </div>
          </div>
      </div>
  </div>    
  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Subscription Date</label>
          <div class="form-control-wrap">
             <div class="form-control">{{ getFormattedDate($subscription->info->current_period_start, 'dS M Y') }}</div>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Next Billing Date</label>
          <div class="form-control-wrap">
             <div class="form-control">{{ getFormattedDate($subscription->info->current_period_end, 'dS M Y') }}</div>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Last Stripe Invoice ID</label>
          <div class="form-control-wrap">
             <div class="form-control">{{ $subscription->info->latest_invoice }}</div>
          </div>
      </div>
  </div>                               
          

  <div class="col-md-6">
      <div class="form-group">
          <label class="form-label">Stripe Subscription ID </label>
          <div class="form-control-wrap">
            <div class="form-control"> {{ $subscription->stripe_subs_id }}</div>
          </div>
      </div>
  </div>  
  <div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Amount</label>
        <div class="form-control-wrap">
          <div class="form-control"> ${{format_stripe_amount($subscription->info->plan->amount)}} </div>
        </div>
    </div>
</div>                                   
<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Intervel</label>
        <div class="form-control-wrap">
          <div class="form-control"> {{ $subscription->info->plan->interval }}</div>
        </div>
    </div>
</div>                                   
<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Status</label>
        <div class="form-control-wrap">
          <div class="form-control"> {{ $subscription->info->status }}</div>
        </div>
    </div>
</div>                                                         
</div>