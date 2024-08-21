<?php

namespace App\Models;

use App\HasProductForm;
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

    // dodać wręcz imiennego traita "HasProductForms"
    protected $guarded = [];

    public static function getForm() {
        return [
            Forms\Components\Section::make('Basic Info')
                ->description('Lorem ipsum dolor sit amet.')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label("Product name")
                        ->required()
                        ->maxLength(255)
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            return $set('slug', Str::slug($state));
                        })
                        ->live(),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->readOnly()
                        
                        ->prefix('url/')
                        ->suffix("/")
                        ->maxLength(255), 
        
                            Forms\Components\Textarea::make('short_description')
                                ->label('Short description')
                                ->rows(4)
                                ->columnSpanFull(),
                        ])
                        ->columns(2),
            Forms\Components\Tabs::make('Tabs')
            ->columnSpanFull()
            ->tabs([
                Tab::make('General')
                    ->schema([
                    Forms\Components\Section::make('Price')
                        ->columns(2)
                        ->description('Lorem ipsum dolor sit amet.')
                        ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->label('Regular price')
                            ->inputMode('decimal')
                            ->suffix('zł'),
                        Forms\Components\TextInput::make('promo_price')
                            ->label('Promo price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->suffix('zł'),     
                        
                        Forms\Components\TextInput::make('omnibus_price')
                            ->label('Omnibus price')
                            ->numeric()
                            ->suffix('zł')
                            ->readOnly()
                            ->prefixIcon('heroicon-m-calendar-days')
                            ->inputMode('decimal')
                            ->hint('Will generate automatically')
                            ->hintColor('danger')
                            ->helperText('Lowest price from the past 30 days')
                            ->columnSpanFull(),     
                        ]),
                         
                        Forms\Components\FileUpload::make('featured_image')
                            ->image(),
        
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                    ]),
                Tab::make('Stock')
                ->schema([]),
            ])
                   
        ];
    }
}
