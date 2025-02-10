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
        // testovanie pre http://localhost:8000/data.php?id=00650008D&eled=24799&pln=0&vod=123
        Log::info('Prijatá požiadavka: ' . json_encode($request->all()));
        Log::channel('device_log')->info('Prijatá požiadavka: ' . json_encode($request->all())); //testovanie

        try {
            $validatedData = $request->validate([
                'id' => 'required|string',
                'eled' => 'required|integer',
                'pln' => 'required|integer',
                'vod' => 'required|integer',
//                'temp' => 'required|integer',
            ]);
        } catch (Exception $e) {
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
                'outside_temperature' => $validatedData['temp'],
                'time' => now()->toDateTimeString(),
            ]);
            Log::info('Data successfully saved to the database', $validatedData);

            return response()->json(['message' => 'Data successfully saved']);
        } catch (Exception $e) {
            Log::error('Error saving data: ' . $e->getMessage(), $validatedData);

            return response()->json([
                'message' => 'Failed to save data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
