<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EnergyController extends Controller
{
    public function storeData(Request $request)
    {
        // Kontrola či bolo niečo poslané
        if (empty($request->query())) {
            return response()->json(['message' => 'Nic sa neposlalo'], 400);
        }

        // Logovanie
        $log = substr($request->getRequestUri(), 0, 200);
        $cas = now()->format('d.m.Y H:i:s');
        $file = fopen(storage_path('logs/data_log.txt'), 'a'); // Logovanie do vlastného súboru
        $riadok = $cas . "; " . $log . "\n";
        fwrite($file, $riadok);
        fclose($file);

        // Kontrola na id zakaznika

        if (!$request->has('id')) {
            Log::warning("Nebolo poslane id zakaznika.");

            return response()->json(['message' => 'Nebolo poslane id zakaznika'], 400);
        }

        // Získanie údajov z GET a zabezpečenie proti XSS
        $vstup = [
            'id' => htmlspecialchars($request->input('id'), ENT_QUOTES, "UTF-8"),
            'eled' => $request->input('eled', 0),
            'elen' => $request->input('elen', 0),
            'pln' => $request->input('pln', 0),
            'vod' => $request->input('vod', 0),
            'tepvn' => $request->input('tepvn', 0),
        ];

        // Kontrola na regularne vyrazy
        $error = 0;
        if (!preg_match("/^[a-zA-Z0-9]+$/", $vstup['id'])) {
            $error = 1;
        }
        if (!preg_match("/^\\d+\$/", $vstup['eled'])) {
            $error = 1;
        }
        if (!preg_match("/^\\d+\$/", $vstup['elen'])) {
            $error = 1;
        }
        if (!preg_match("/^\\d+\$/", $vstup['pln'])) {
            $error = 1;
        }
        if (!preg_match("/^\\d+\$/", $vstup['vod'])) {
            $error = 1;
        }
        if (!preg_match("/^-?\\d+\$/", $vstup['tepvn'])) {
            $error = 1;
        }

        if ($error == 1) {
            Log::warning("Vstup nepresiel kontrolou regularnych vyrazov.");

            return response()->json(['message' => 'Vstup nepresiel kontrolou regularnych vyrazov'], 400);
        }

        return response()->json(['message' => 'OK']);
        // Zápis do databázy
        /*
        try {
            DB::table('udaje')->insert([
                //'id_zakaznik' => $vstup['id'],
                'eled' => $vstup['eled'],
                'elen' => $vstup['elen'],
                'pln' => $vstup['pln'],
                'vod' => $vstup['vod'],
                'tepvn' => $vstup['tepvn'],
                'data_all' => http_build_query($request->query()),
            ]);

            Log::info("Údaje úspešne uložené.");
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error("Zápis do databázy neuspel: " . $e->getMessage());
            return response()->json(['message' => 'Zápis do databázy neuspel'], 500);
        }*/
    }
}
