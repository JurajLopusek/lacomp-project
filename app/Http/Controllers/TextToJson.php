<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextToJson extends Controller
{
    private String $split_text_symbol = '&';
    private String $split_record_symbol = '=';

    public function textToJson(String $text) : Array {
        $json = [];
        $split_text = explode($this->split_text_symbol, $text);

        foreach ($split_text as $record) {
            $record = explode($this->split_record_symbol, $record);
            $json[$record[0]] = $record[1];
        }

        return $json;
    }

}
