<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Measurement;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    /**
     * Uloží dáta do databázy
     *
     * @param Request $request
     * @return JsonResponse|null
     */
    public function store(Request $request): ?JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|string',
                'eled' => 'required|integer',
                'pln' => 'required|integer',
                'vod' => 'required|integer',
            ]);
        } catch (Exception $e) {
            Log::channel('device_measurement')->error('Error validating data: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to validate data',
                'error' => $e->getMessage(),
            ], 400);
        }

        try {
            Measurement::create([
                'device_id' => Device::where('serial_number', $validatedData['id'])->firstOrFail()->id,  // TODO MK: cache
                'electricity' => $validatedData['eled'],
                'electricity_panel' => -1,  // TODO JL: fix
                'gas' => $validatedData['pln'],
                'water' => $validatedData['vod'],
                'outside_temperature' => -1,
                'time' => now()->toDateTimeString(),
            ]);

            return response()->json(['message' => 'Data successfully saved']);
        } catch (Exception $e) {
            Log::channel('device_measurement')->error('Error saving data: ' . $e->getMessage(), $validatedData);

            return response()->json([
                'message' => 'Failed to save data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
