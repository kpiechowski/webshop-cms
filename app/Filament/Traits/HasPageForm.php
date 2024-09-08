<?php

namespace App\Filament\Traits;

use Filament\Forms;
use PhpParser\Builder;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use App\Enums\Panel\PageStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Services\PageSectionsService;
use Livewire\Livewire;
use Livewire\Component;

trait HasPageForm
{


    public static function getPageMainContent(): array
    {
        return [

            Section::make('Page')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label("Page name")
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255)
                        ->afterStateUpdated(function (Set $set, ?string $state, Component $livewire) {
                            $slug = Str::slug($state);
                            // dd($livewire);
                            $livewire->dispatch('slugUpdated', $slug);
                            return $set('slug', $slug);
                        })
                        ->reactive()
                        ->live()
                        ->debounce(),

                    TextInput::make('slug')
                        ->required()
                        ->readOnly()
                        ->live()
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


            PageSectionsService::sections(),

        ];
    }

    public static function getPageSideForm()
    {
        return [
            Section::make()
                ->schema([

                    Forms\Components\Radio::make('status')
                        ->enum(PageStatus::class)
                        ->options(PageStatus::class)
                        ->default(fn(Get $get) => $get('status'))
                        ->required(),

                    Actions::make([
                        Action::make('Save')
                            ->icon('heroicon-m-star')
                            ->requiresConfirmation()
                            ->action(function ($action) {
                                $action->halt();
                            }),

                        Action::make('Delete')
                            ->icon('heroicon-m-x-mark')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->action(function ($action) {
                                $action->halt();
                            }),
                    ]),
                ])
                ->live()
                ->columnSpan(2)
                ->grow(false),
        ];
    }






}
