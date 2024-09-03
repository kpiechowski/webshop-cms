<?php

namespace App\Filament\Services;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Illuminate\Support\Facades;
use App\Filament\View\Composers;


class PageSectionsService
{

    protected static $viewComposers = [
        'heading' => Composers\HeadingSectionComposer::class,
    ];

    public static function bootViewComposers()
    {

        foreach (self::$viewComposers as $section => $composer) {
            Facades\View::composer("partials.sections.$section.$section", $composer);
        }
    }

    public static function renderSectionBuilder()
    {
        return Forms\Components\Builder::make('page_sections')
            ->blocks(
                self::getPageBlocks()
            )->columnSpanFull()
            ->collapsible()
            ->cloneable();

    }

    public static function getPageBlocks(): array
    {
        return [
            Builder\Block::make('heading')
                ->schema([
                    TextInput::make('content')
                        ->label('Heading')
                        ->required(),
                    Select::make('level')
                        ->options([
                            'h1' => 'Heading 1',
                            'h2' => 'Heading 2',
                            'h3' => 'Heading 3',
                            'h4' => 'Heading 4',
                            'h5' => 'Heading 5',
                            'h6' => 'Heading 6',
                        ])
                        ->required(),
                ])
                ->columns(2),

            Builder\Block::make('paragraph')
                ->schema([
                    Textarea::make('content')
                        ->label('Paragraph')
                        ->required(),
                ]),

            Builder\Block::make('image')
                ->schema([
                    FileUpload::make('url')
                        ->label('Image')
                        ->image()
                        ->required(),
                    TextInput::make('alt')
                        ->label('Alt text')
                        ->required(),
                ]),
        ];
    }

}