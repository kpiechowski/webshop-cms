<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function value(string $key): string
    {
        return ThemeOption::where('key', '=', $key)->firstOrFail()->value;
    }

    public static function setValue(string $key, string $value)
    {
        ThemeOption::create(['key' => $key, 'value' => $value]);

        // $option = new ThemeOption();
        // $option->key = 
    }
}
