<?php

namespace App\Services\Format;
use App\Services\Abstracts\DataFormat;

class XmlFormat extends DataFormat
{
    public function parse($data): string
    {
        $data = is_array($data) ? $data : $data->toArray();
        $xml = new \SimpleXMLElement('<root/>');
        $this->to_xml($xml, $data);
        return $xml->asXML();
    }

    private function to_xml(\SimpleXMLElement $object, array $data) {
        foreach ($data as $key => $value) {
            // if the key is an integer, it needs text with it to actually work.
            $valid_key  = is_numeric($key) ? "id_$key" : $key;
            $new_object = $object->addChild( 
                $valid_key, 
                is_array($value) ? null : htmlspecialchars($value) 
            );
    
            if (is_array($value)) {
                $this->to_xml($new_object, $value);
            }
        }
    }
}