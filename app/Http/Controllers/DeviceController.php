<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\Device;
use App\Models\Measurement;
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
        $cas = now()->toDateTimeString();

        // Validácia dát (môžete pridať vlastné validácie)
        $validatedData = $request->validate([
            'id' => 'required|string', // id zariadenia
            'eled' => 'required|integer',
            'pln' => 'required|integer',
            'vod' => 'required|integer',
            'temp' => 'required|integer',
        ]);

        try {
            // Výpočet rozdielov a ukladanie do tabuľky Calculation
            $lastMeasurement = Measurement::where('device_id', $validatedData['id'])
                ->latest('time')  // Ukladáme v chronologickom poradí
                ->first();
            // Ak existuje posledný záznam, vypočítať rozdiely
            if ($lastMeasurement) {
                $electricityDifference = $validatedData['eled'] - $lastMeasurement->electricity;
                $gasDifference = $validatedData['pln'] - $lastMeasurement->gas;
                $waterDifference = $validatedData['vod'] - $lastMeasurement->water;

                // Uložiť rozdiely do tabuľky `calculation`
                Calculation::create([
                    'deviceCalc_id' => $validatedData['id'],
                    'electricityCalc' => $electricityDifference,
                    'gasCalc' => $gasDifference,
                    'waterCalc' => $waterDifference,
                    'outside_temperatureCalc' => $validatedData['temp'],
                    'time' => $cas,
                ]);
                Log::info('Calculation data successfully saved to the database', $validatedData);
            }
            // Uloženie do tabuľky Measurement
            Measurement::create([
                'device_id' => $validatedData['id'],
                'electricity' => $validatedData['eled'],
                'gas' => $validatedData['pln'],
                'water' => $validatedData['vod'],
                'outside_temperature' => $validatedData['temp'],
                'time' => $cas,
            ]);
            Log::info('Data successfully saved to the database', $validatedData);
            return response()->json(['message' => 'Data successfully saved'], 200);
        } catch (\Exception $e) {
            Log::error('Error saving data: ' . $e->getMessage(), $validatedData);
            return response()->json(['error' => 'Failed to save data'], 500);
        }
    }
}
