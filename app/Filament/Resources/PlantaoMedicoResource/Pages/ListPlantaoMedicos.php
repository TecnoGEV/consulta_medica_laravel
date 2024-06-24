<?php

namespace App\Filament\Resources\PlantaoMedicoResource\Pages;

use App\Filament\Resources\PlantaoMedicoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlantaoMedicos extends ListRecords
{
    protected static string $resource = PlantaoMedicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make()->createAnother(false),
        ];
    }
}
