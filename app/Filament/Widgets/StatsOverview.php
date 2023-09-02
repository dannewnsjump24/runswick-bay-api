<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Trips', Trip::query()->count()),
            Stat::make('Users', User::query()->count()),
            Stat::make('Locations', Location::query()->count()),
        ];
    }
}
