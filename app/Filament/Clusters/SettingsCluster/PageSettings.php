<?php

namespace App\Filament\Clusters\SettingsCluster;

use Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\ThemeOption;
use Filament\Forms\Components\Select;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use App\Filament\Clusters\SettingsCluster;
use App\Models\Page as ModelsPage;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class PageSettings extends Page implements HasForms
{

    use InteractsWithForms;


    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.settings-cluster.pages.page-settings';

    protected static ?string $cluster = SettingsCluster::class;


    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {

        return $form
            ->schema([
                KeyValue::make('meta')
                    ->editableValues(false),
                Select::make('theme_option')
                    ->label('Theme Option')
                    ->options(ModelsPage::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

}
