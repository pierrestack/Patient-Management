<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Resources\Concerns\HasTabs;

class Settings extends Page
{
    use HasTabs;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?string $navigationGroup = 'System management';

    protected static string $view = 'filament.pages.settings';
}
