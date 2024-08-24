<?php

namespace App\Filament\Traits;

use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Str;
use Filament\Forms\Set;

trait HasProductForm
{


    public static function getBasicInfoArray():array
    {
        return [ 
        Forms\Components\TextInput::make('name')
            ->label("Product name")
            ->required()
            ->maxLength(255)
            ->afterStateUpdated(function (Set $set, ?string $state) {
                return $set('slug', Str::slug($state));
            })
            ->live()
            ->debounce(),
        Forms\Components\TextInput::make('slug')
            ->required()
            ->readOnly()
            
            ->prefix('url/')
            ->suffix("/")
            ->maxLength(255), 
        Forms\Components\Textarea::make('short_description')
                ->label('Short description')
                ->rows(4)
                ->columnSpanFull()];
    }

    public static function getStockFormTab():Tab
    {
        return Tab::make('Stock')
            ->schema([

            ]);
    }

    public static function getGeneralFormTab():Tab {
        return Tab::make('General')
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
                            ->hintColor('info')
                            ->helperText('Lowest price from the past 30 days')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\FileUpload::make('featured_image')
                    ->image(),

                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
            ]);
        
    }


}
