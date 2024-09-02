<?php

namespace App\Filament\Clusters\SettingsCluster;

use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\ThemeOption;
use App\Models\Page as ModelsPage;

use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Clusters\SettingsCluster;

class GeneralSettings extends Page
{

    protected static ?string $title = 'General Settings';
    protected static ?string $navigationLabel = 'General';

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $cluster = SettingsCluster::class;
    protected static string $view = 'filament.clusters.settings-cluster.pages.general-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {

        return $form
            ->schema([

                TextInput::make('site_name')
                    ->label('Site name')
                    ->prefixIcon('heroicon-o-globe-alt')
                    ->default(ThemeOption::value('site_name') ?? '')
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(function (?string $state, $old) {
                        if (empty($state))
                            return;

                        ThemeOption::setValue('site_name', $state);
                        return;
                    }),

                Textarea::make('site_description')
                    ->label('Site description')
                    ->default(ThemeOption::value('site_description') ?? '')
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(function (?string $state, $old) {
                        if (empty($state))
                            return;

                        ThemeOption::setValue('site_description', $state);
                        return;
                    }),
            ])
            ->statePath('data');
    }

}
