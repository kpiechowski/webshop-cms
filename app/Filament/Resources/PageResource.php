<?php

namespace App\Filament\Resources;

use App\Enums\Panel\PageStatus;
use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\PageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PageResource\RelationManagers;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([



                    Forms\Components\Section::make('Page')
                        ->grow(true)
                        ->columns(2)
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
                            Forms\Components\Select::make('status')
                                ->label("Page status")
                                ->options(PageStatus::toArray())
                                ->native(false)
                        ])->grow(false),

                ])->from('md')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
