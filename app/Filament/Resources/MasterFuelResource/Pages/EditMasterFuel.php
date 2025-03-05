<?php

namespace App\Filament\Resources\MasterFuelResource\Pages;

use App\Filament\Resources\MasterFuelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterFuel extends EditRecord
{
    protected static string $resource = MasterFuelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
