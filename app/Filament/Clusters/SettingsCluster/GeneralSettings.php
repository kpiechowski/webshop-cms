<?php

namespace App\Filament\Clusters\SettingsCluster;

use Filament\Pages\Page;
use App\Filament\Clusters\SettingsCluster;

class GeneralSettings extends Page
{

    protected static ?string $title = 'General Settings';
    protected static ?string $navigationLabel = 'General';

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $cluster = SettingsCluster::class;
    protected static string $view = 'filament.clusters.settings-cluster.pages.general-settings';

}
