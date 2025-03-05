<?php

namespace App\Filament\Resources\KendaraanPegawaiResource\Pages;

use App\Filament\Resources\KendaraanPegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKendaraanPegawai extends EditRecord
{
    protected static string $resource = KendaraanPegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
