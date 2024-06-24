<?php

namespace App\Filament\Resources\PlantaoMedicoResource\Pages;

use App\Filament\Resources\PlantaoMedicoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlantaoMedico extends EditRecord
{
    protected static string $resource = PlantaoMedicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
