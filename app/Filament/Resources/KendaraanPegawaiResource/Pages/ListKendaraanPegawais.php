<?php

namespace App\Filament\Resources\KendaraanPegawaiResource\Pages;

use App\Filament\Resources\KendaraanPegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKendaraanPegawais extends ListRecords
{
    protected static string $resource = KendaraanPegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
