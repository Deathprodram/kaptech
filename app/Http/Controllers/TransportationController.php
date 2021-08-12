<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\Transportation\Transportation;

class TransportationController extends Controller
{

    public function calculate_transport_sum(Request $request) {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
            'weight' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 401);
        }

        return Transportation::calculateTransportationSum(
            $request->company_id,
            $request->weight
        );
    }
}
