<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KendaraanPegawaiResource\Pages;
use App\Models\KendaraanPegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KendaraanPegawaiResource extends Resource
{
    protected static ?string $model = KendaraanPegawai::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Kendaraan Pegawai';
    protected static ?string $modelLabel = 'Kendaraan Pegawai';
    protected static ?string $pluralModelLabel = 'Kendaraan Pegawai';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_jenis_kendaraan')
                    ->relationship('jenisKendaraan', 'name')
                    ->required()
                    ->preload()
                    ->searchable()
                    ->label('Jenis Kendaraan'),
                Forms\Components\TextInput::make('nama_pemilik')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Pemilik'),
                Forms\Components\TextInput::make('plat_nomor')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->label('Plat Nomor')
                    ->placeholder('Contoh: B 1234 ABC'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\Action::make('exportPDF')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function () {
                        $records = KendaraanPegawai::all();
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.kendaraan.report-kendaraan-pegawai', [
                            'records' => $records,
                            'date' => now()->format('d/m/Y'),
                        ]);
                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->stream();
                        }, 'laporan-kendaraan-pegawai.pdf');
                    })
            ])
            ->columns([
                Tables\Columns\TextColumn::make('jenisKendaraan.name')
                    ->sortable()
                    ->searchable()
                    ->label('Jenis Kendaraan'),
                Tables\Columns\TextColumn::make('nama_pemilik')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Pemilik'),
                Tables\Columns\TextColumn::make('plat_nomor')
                    ->searchable()
                    ->sortable()
                    ->label('Plat Nomor'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->label('Status Aktif')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Dibuat'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle')
                    ->label(fn ($record) => $record->is_active ? 'Nonaktifkan' : 'Aktifkan')
                    ->icon(fn ($record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn ($record) => $record->is_active ? 'danger' : 'success')
                    ->action(fn ($record) => $record->update(['is_active' => !$record->is_active]))
                    ->requiresConfirmation(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKendaraanPegawais::route('/'),
            'create' => Pages\CreateKendaraanPegawai::route('/create'),
            'edit' => Pages\EditKendaraanPegawai::route('/{record}/edit'),
        ];
    }
}
