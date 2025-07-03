<?php

namespace App\Filament\Resources\ExperienceGroupResource\Pages;

use App\Filament\Resources\ExperienceGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExperienceGroup extends EditRecord
{
    protected static string $resource = ExperienceGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
