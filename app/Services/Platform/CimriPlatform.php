<?php 

namespace App\Services\Platform;
use App\Services\Abstracts\Platform;

class CimriPlatform extends Platform
{
    public function __construct(protected array $properties = [])
    {
        $select = ["id", "name", "price", "category"];
        parent::__construct($properties, $select);
    }

    /**
     * Get Products
     *
     * @return string|array
     */
    public function getProducts(): string|array
    {
        return $this->dataFormat->parse($this->products);
    }
}