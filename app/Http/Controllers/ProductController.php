<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductIndexRequest;
use App\Services\Format\CsvFormat;
use App\Services\Format\JsonFormat;
use App\Services\Format\XmlFormat;
use App\Services\Platform\CimriPlatform;
use App\Services\Platform\FacebookPlatform;
use App\Services\Platform\GooglePlatform;
use App\Services\Platform\N11Platform;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request)
    {
        $filters = Arr::except($request->validated(), ['format', 'platform']);

        $format = match($request->input('format')) {
            'json' => new JsonFormat(),
            'xml' => new XmlFormat(),
            'csv' => new CsvFormat(),
            default => new JsonFormat()
        };

        $platform = match($request->input('platform')) {
            'cimri' => new CimriPlatform($filters),
            'google' => new GooglePlatform($filters),
            'facebook' => new FacebookPlatform($filters),
            'n11' => new N11Platform($filters),
            default => new CimriPlatform()
        };

        $response = $platform->format($format);
        return response($response->getProducts(), 200, ['Content-Type' => $response->getContentType()]);
        
    }
}
