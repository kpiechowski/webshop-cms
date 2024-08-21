<?php

namespace App\Models;

use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    // dodać kolumnę 'poziom/zagnieżdzenie', albo zrobic pivota, albo wsadzić do meta


    public static function getForm() {
        return [
            Forms\Components\Section::make('')
                ->id('category_form_data')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(60)
                    ->columnSpanFull(),
                    
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Select::make('parent_id')
                    ->relationship(name: 'product_categories', titleAttribute: 'name', ignoreRecord: true)
                    ->multiple()
                    ->searchable(['name'])
                    ->native(false),
                    Forms\Components\CheckboxList::make('children')
                        ->getOptionLabelFromRecordUsing(fn(ProductCategory $productCategory) => $productCategory->children()->get() ),
                    
            ])->columns(2),
            
        ];
    }

    public function parent(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function children(){
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    protected $guarded = [];

}
