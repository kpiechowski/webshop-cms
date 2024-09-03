<?php

namespace App\Filament\Traits;

use App\Enums\Panel\PageStatus;
use Filament\Forms;
use PhpParser\Builder;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Services\PageSectionsService;

trait HasPageForm
{


    public static function getPageMainContent(): array
    {
        return [

            Section::make('Page')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label("Product name")
                        ->required()
                        ->maxLength(255)
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            return $set('slug', Str::slug($state));
                        })
                        ->live()
                        ->debounce(),

                    TextInput::make('slug')
                        ->required()
                        ->readOnly()
                        ->hintAction(
                            Action::make('edit')
                                ->icon('heroicon-m-clipboard')
                                ->requiresConfirmation()
                                ->action(function () {

                                })
                        )
                        ->suffixIcon('heroicon-o-rectangle-stack'),
                    Hidden::make('author')
                        ->required()
                        ->default(fn() => Auth::id()),
                ]),

            Forms\Components\Section::make('page_sections_wrap')
                ->label('Page Sections')
                ->columnSpanFull()
                ->schema([

                    PageSectionsService::renderSectionBuilder()

                ])


        ];
    }

    public static function getPageSideForm()
    {
        return [
            Section::make()
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options(fn() => PageStatus::toArray())
                        ->default(fn(Get $get) => $get('status'))
                ])
                ->live()
                ->columnSpan(2)
                ->grow(false),
        ];
    }






}
