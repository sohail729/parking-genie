<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\PlanContract;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct(
        PlanContract $planRepository) {
        $this->planRepository       =   $planRepository;
    }


    public function index()
    {
        $plans = Plan::all();
        return view('admin.plan.index', compact('plans'));
    }  

    public function create(Request $request)
    {
        return  view('admin.plan.form');

    }

    public function store(Request $request)
    {
        $input = $request->all();
        if(isset($input['image'])){
            $planImage = $this->fileUpload($input['image'], 'plans');
            $input['image'] = $planImage;
        }
        $response = $this->planRepository->store($input);
        if($response){
            return redirect()->route('admin.plans.index');
        }

    }

    public function show()
    {
        $plans = Plan::all();
        return view('admin.plan.index', compact('plans'));
    }  

    public function edit(Plan $plan)
    {
        return  view('admin.plan.modal.edit', compact('plan'))->render();

    }

    public function update(Request $request, Plan $plan)
    {
        $input =  $request->all();
        if(isset($input['image'])){
        $planImage = $this->fileUpload($input['image'], 'plans');
        $input['image'] = $planImage;
        }
        $response = $this->planRepository->update($input, $plan);
        if($response){
            return redirect()->route('admin.plans.index');
        }
    }

    public function destroy(Plan $plan)
    {
        $response = $plan->delete();
        if($response){
            return true;
        }
        return false;
    }
}
