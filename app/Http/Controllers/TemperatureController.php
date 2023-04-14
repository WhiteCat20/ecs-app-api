<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function __invoke(Request $request)
    {
        $temperature = $request->input('temperature');
        $temperatureSensorData = new Temperature(['temperature' => $temperature]);
        $temperatureSensorData->save();

        return response()->json([
            'message' => 'Temperature data stored successfully',
            'data' => $temperature
        ]);
    }
}
