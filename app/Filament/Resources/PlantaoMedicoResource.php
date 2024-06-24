<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantaoMedicoResource\Pages;
use App\Filament\Resources\PlantaoMedicoResource\RelationManagers;
use App\Models\PlantaoMedico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlantaoMedicoResource extends Resource
{
    protected static ?string $model = PlantaoMedico::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('inicio_plantao')
                    ->required(),
                Forms\Components\DateTimePicker::make('fim_plantao')
                    ->required(),
                Forms\Components\Select::make('doctor_id')
                    ->relationship('users', 'name')
                    ->label('Nome do Médico')
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inicio_plantao')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fim_plantao')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('excedente_plantao')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPlantaoMedicos::route('/'),
            // 'create' => Pages\CreatePlantaoMedico::route('/create'),
            'view' => Pages\ViewPlantaoMedico::route('/{record}'),
            // 'edit' => Pages\EditPlantaoMedico::route('/{record}/edit'),
        ];
    }
}
