<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function value(string $key): string|null
    {
        $value = ThemeOption::where('key', '=', $key)->first('value');


        return $value?->value;
    }

    public static function setValue(string $key, string $value)
    {

        $existingOption = ThemeOption::where('key', $key)->first();

        if (!$existingOption) {
            ThemeOption::create(['key' => $key, 'value' => $value]);
            return;
        }


        $existingOption->value = $value;
        $existingOption->save();




        // $option = new ThemeOption();
        // $option->key = 
    }
}
