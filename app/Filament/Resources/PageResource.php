<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\PageMeta;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ThemeOption;
use Illuminate\Support\Str;
use App\Enums\Panel\PageStatus;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Filament\Page\PageUrl;
use Filament\Forms\Components\Livewire;


use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Services\PageSectionsService;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Livewire::make(PageUrl::class),

                Forms\Components\Split::make([
                    Forms\Components\Section::make('Page')
                        // ->extraAttributes(['class' => 'grow-[4]'])
                        ->columns(2)
                        ->columnSpan(3)
                        ->schema([
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
                                ->hintAction(
                                    Action::make('edit')
                                        ->icon('heroicon-m-clipboard')
                                        ->requiresConfirmation()
                                        ->action(function () {

                                        })
                                )
                                ->suffixIcon('heroicon-o-rectangle-stack'),
                            Forms\Components\Hidden::make('author')
                                ->required()
                                ->default(fn() => Auth::id()),
                        ]),


                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\Placeholder::make('status')
                                ->content(fn(Get $get) => $get('status'))
                        ])
                        ->live()
                        ->columnSpan(2)
                        ->grow(false)
                ])

                    ->from('md')->columnSpanFull(),


                Forms\Components\Section::make('page_sections_wrap')
                    ->label('Page Sections')
                    ->schema([

                        // TODO all from service based on page's theme 
                        Forms\Components\Builder::make('page_sections')
                            ->blocks(
                                PageSectionsService::getPageBlocks()
                            )->columnSpanFull()
                            ->collapsible()
                            ->cloneable()
                        ,
                    ])->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->suffix(function ($record, ) {
                        if ($record->id == ThemeOption::value('home_page_id'))
                            return ' -- home page';
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                ,
                Tables\Columns\TextColumn::make('author')
                    ->getStateUsing(fn($record) => $record->getAuthorName())
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
