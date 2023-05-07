<?php

namespace App\Services\Abstracts;

abstract class DataFormat
{
    abstract public function parse($data);
}