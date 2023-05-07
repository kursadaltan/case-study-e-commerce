<?php

namespace App\Services\Format;
use App\Services\Abstracts\DataFormat;

class CsvFormat extends DataFormat
{
    public function parse($data): string
    {
        $data = is_array($data) ? $data : $data->toArray();
        $csv = '';
        foreach ($data as $row) {
            $csv .= implode(',', $row) . "\n";
        }
        return $csv;
    }
}