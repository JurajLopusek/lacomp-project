<?php

namespace App\Http\Controllers;

class TextToJson extends Controller
{
    private String $split_text_symbol = '&';
    private String $split_record_symbol = '=';

    /**
     * @param string $text
     * @return array<string, string>
     */
    public function textToJson(String $text) : array
    {
        $json = [];
        $split_text = explode($this->split_text_symbol, $text);

        foreach ($split_text as $record) {
            $record = explode($this->split_record_symbol, $record);
            $json[$record[0]] = $record[1];
        }

        return $json;
    }
}
