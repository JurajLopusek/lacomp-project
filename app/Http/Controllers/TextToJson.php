<?php

namespace App\Http\Controllers;

class TextToJson extends Controller
{
    /** @var non-empty-string */
    private readonly string $split_text_symbol;

    /** @var non-empty-string */
    private readonly string $split_record_symbol;

    public function __construct()
    {
        $this->split_text_symbol = '&';
        $this->split_record_symbol = '=';
    }

    /**
     * @param string $text
     * @return array<string, string>
     */
    public function textToJson(string $text): array
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
