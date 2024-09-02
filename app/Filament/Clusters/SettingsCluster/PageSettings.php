<?php

namespace App\Filament\Clusters\SettingsCluster;

use Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\ThemeOption;
use App\Models\Page as ModelsPage;

use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use App\Filament\Clusters\SettingsCluster;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class PageSettings extends Page implements HasForms
{

    use InteractsWithForms;

    public ?array $data = [];

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

                Select::make('home_page_id')
                    ->label('Home Page')
                    ->helperText('Sets the default page under "/" url ')
                    ->prefixIcon('heroicon-o-home')
                    ->options(ModelsPage::all()->pluck('name', 'id'))
                    ->searchable()
                    ->hint(new HtmlString('<a href="' . route('home') . '" class="text-blue-400">See Page</a>'))
                    ->default(ThemeOption::value('home_page_id'))
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (?string $state, $old) {
                        ThemeOption::setValue('home_page_id', $state);
                        return;
                    }),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form);
    }

}
