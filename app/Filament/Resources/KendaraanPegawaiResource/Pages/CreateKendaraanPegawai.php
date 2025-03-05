<?php

namespace App\Filament\Resources\KendaraanPegawaiResource\Pages;

use App\Filament\Resources\KendaraanPegawaiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKendaraanPegawai extends CreateRecord
{
    protected static string $resource = KendaraanPegawaiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
