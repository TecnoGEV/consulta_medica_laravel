<?php

namespace App\Filament\Resources\PlantaoMedicoResource\Pages;

use App\Filament\Resources\PlantaoMedicoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePlantaoMedico extends CreateRecord
{
    protected static string $resource = PlantaoMedicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->disabled(),
        ];
    }
}
