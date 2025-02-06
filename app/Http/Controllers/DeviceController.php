<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    /**
     * Uloží dáta do databázy
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // testovanie pre http://localhost:8000/data.php?id=00650008D&eled=24799&pln=0&vod=123
        Log::info('Prijatá požiadavka: ' . json_encode($request->all()));
        Log::channel('device_log')->info('Prijatá požiadavka: ' . json_encode($request->all())); //testovanie

        // Validácia dát (môžete pridať vlastné validácie)
        $validatedData = $request->validate([
            'id' => 'required|string', // id zariadenia
            'eled' => 'required|integer',
            'pln' => 'required|integer',
            'vod' => 'required|integer',
        ]);

        try {
            /** @phpstan-ignore-next-line Call to an undefined static */ // TODO MK: fix phpstan
            Device::create([
                'id_zakaznik' => $validatedData['id'],
                'eled' => $validatedData['eled'],
                'pln' => $validatedData['pln'],
                'vod' => $validatedData['vod'],
            ]);
            Log::info('Data successfully saved to the database', $validatedData);

            return response()->json(['message' => 'Data successfully saved'], 200);
        } catch (\Exception $e) {
            Log::error('Error saving data: ' . $e->getMessage(), $validatedData);

            return response()->json(['error' => 'Failed to save data'], 500);
        }
    }
}
