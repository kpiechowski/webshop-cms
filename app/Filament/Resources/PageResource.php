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
use Filament\Forms\Components\Grid;
use App\Filament\Traits\HasPageForm;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;


use Filament\Forms\Components\Section;
use App\Livewire\Filament\Page\PageUrl;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Services\PageSectionsService;

class PageResource extends Resource
{
    use HasPageForm;
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Livewire::make(PageUrl::class),

                Grid::make('page_content')
                    ->columns(12)
                    ->schema([
                        Grid::make('page_content_main')
                            ->columnSpan(9)
                            ->schema(self::getPageMainContent()),

                        Grid::make('page_content_side')
                            ->columnSpan(3)
                            ->schema(self::getPageSideForm()),
                    ]),

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
