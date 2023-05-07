<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PlatformFormatRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private string $platform = "")
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return match ($this->platform) {
            "cimri" => $value === "json" || $value === "xml",
            "n11" => $value === "json" || $value === "csv",
            "google" => $value === "json",
            "facebook" => $value === "json" || $value === "csv" || $value === "xml",
            default => false,
        };
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The format is not acceptable for this platform.';
    }
}
