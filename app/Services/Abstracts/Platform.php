<?php

namespace App\Services\Abstracts;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

abstract class Platform
{

    protected Collection $products;
    public function __construct(protected array $properties = [])
    {
        $this->products = Product::query()
            ->when(count($properties), function ($query, $properties) {
                return $query->where($properties);
            })
            ->get();
    }
}