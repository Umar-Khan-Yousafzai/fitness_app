<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FootStepStoreRequest;
use App\Models\FootStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FootStepController extends Controller
{

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
