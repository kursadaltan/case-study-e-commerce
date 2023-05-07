<?php

namespace App\Services\Format;
use App\Services\Abstracts\DataFormat;

class JsonFormat extends DataFormat
{
    public function parse($data): string
    {
        return $data->toJson();
    }
}