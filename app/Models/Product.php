<?php

namespace App\Models;


use App\Filament\Traits\HasProductForm;
use Filament\Forms;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use HasProductForm;

    protected $guarded = [];


    public function productCategory()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_product_category')->withPivot('level');
    }

    public static function getForm() {
        return [
            Forms\Components\Section::make('Basic Info')
                ->description('Lorem ipsum dolor sit amet.')
                ->schema(
                    self::getBasicInfoArray(),
                )
                ->columns(2),
            Forms\Components\Tabs::make('Tabs')
            ->columnSpanFull()
            ->tabs([
                self::getGeneralFormTab(),
                self::getStockFormTab(),
            
            ])
                   
        ];
    }
}
