<?php

namespace App\Filament\Resources\PlantaoMedicoResource\Pages;

use App\Filament\Resources\PlantaoMedicoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPlantaoMedico extends ViewRecord
{
    protected static string $resource = PlantaoMedicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
