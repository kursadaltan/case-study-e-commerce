<?php

namespace App\Services\Abstracts;
use App\Models\Product;
use App\Services\Format\CsvFormat;
use App\Services\Format\JsonFormat;
use App\Services\Format\XmlFormat;
use Illuminate\Database\Eloquent\Collection;

abstract class Platform
{
    protected Collection $products;

    protected DataFormat $dataFormat;
    public function __construct(protected array $properties = [], protected array $select = ['*'])
    {
        $this->dataFormat = new JsonFormat();

        $this->products = Product::query()
            ->select($select)
            ->when(count($properties), function ($query) use ($properties) {
                return $query->where($properties);
            })
            ->get();
    }

    /**
     * Set the data format
     *
     * @param DataFormat $format
     * @return Platform
     */
    public function format(DataFormat $format): Platform
    {
        $this->dataFormat = $format;
        return $this;
    }

    abstract function getProducts();

    public function getContentType(): string
    {
        return match(get_class($this->dataFormat)) {
            JsonFormat::class => 'application/json',
            XmlFormat::class => 'application/xml',
            CsvFormat::class => 'text/csv',
            default => 'text/plain',
        };
    }

}