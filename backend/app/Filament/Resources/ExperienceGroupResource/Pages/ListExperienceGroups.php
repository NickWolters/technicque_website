<?php

namespace App\Filament\Resources\ExperienceGroupResource\Pages;

use App\Filament\Resources\ExperienceGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExperienceGroups extends ListRecords
{
    protected static string $resource = ExperienceGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
