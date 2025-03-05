<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FuelResource\Pages;
use App\Filament\Resources\FuelResource\RelationManagers;
use App\Models\Fuel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FuelResource extends Resource
{
    protected static ?string $model = Fuel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Bahan Bakar';
    protected static ?string $modelLabel = 'Bahan Bakar';
    protected static ?string $pluralModelLabel = 'Bahan Bakar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('id_master_fuel')
                            ->relationship('masterFuel', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Master Fuel'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter fuel name')
                            ->label('Fuel Name'),
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Enter fuel code')
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('Rp')
                            ->mask('999999999'),
                        Forms\Components\Textarea::make('desc')
                            ->label('Description')
                            ->placeholder('Enter description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Status')
                            ->default(true),
                    ])->columns(2)
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
                        $records = Fuel::with('masterFuel')->get();
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.fuel.report-fuel', [
                            'records' => $records,
                            'date' => now()->format('d/m/Y'),
                        ]);
                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->stream();
                        }, 'laporan-bahan-bakar.pdf');
                    })
            ])
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('masterFuel.name')
                    ->label('Master Fuel')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('desc')
                    ->label('Description')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFuels::route('/'),
            'create' => Pages\CreateFuel::route('/create'),
            'edit' => Pages\EditFuel::route('/{record}/edit'),
        ];
    }
}
