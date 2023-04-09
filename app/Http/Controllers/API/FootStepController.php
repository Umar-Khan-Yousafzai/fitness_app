<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FootStepStoreRequest;
use App\Models\FootStep;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FootStepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getFootSteps()
    {

         $footSteps = FootStep::where('start_time', '<=', Carbon::now()->format('Y-m-d H:i:s'))
                            ->where('end_time', '>=', Carbon::now()->format('Y-m-d H:i:s'))->limit(20)->get();

        foreach($footSteps as $footStep)
        {
            $user = User::select('name','imageUrl')->where('id',$footStep->user_id)->first();
            $footStep->user_name = $user->name;
            $footStep->user_image = $user->imageUrl;
        }
        if (count($footSteps)>0) {
            return response()->json(['status' => true, 'message' => "Record Fetched Successfully", 'data' => $footSteps], 200);
        } else {
            return response()->json(['status' => false, 'message' => "No Record Found", 'data' => []], 400);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FootStepStoreRequest $request)
    {

        $data = $request->all();
        $footStep = new FootStep();
        $footStep =  $footStep->create([
            'user_id' => Auth::user()->id,
            'steps_count' =>  $data['stepsCount'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);

        if ($footStep) {
            return response()->json(['status' => true, 'message' => "Record Inserted Successfully", 'data' => $footStep], 200);
        } else {
            return response()->json(['status' => false, 'message' => "Record failed to insert", 'data' => []], 400);
        }
    }
}
