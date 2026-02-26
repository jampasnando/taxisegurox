<?php

namespace App\Filament\Resources\Propietarios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropietariosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nrodocumento')
                    ->searchable(),
                TextColumn::make('expedido')
                    ->searchable(),
                TextColumn::make('nombres')
                    ->searchable(),
                TextColumn::make('primer_apellido')
                    ->searchable(),
                TextColumn::make('segundo_apellido')
                    ->searchable(),
                TextColumn::make('tercer_apellido')
                    ->searchable(),
                TextColumn::make('celular')
                    ->searchable(),
                TextColumn::make('zona')
                    ->searchable(),
                TextColumn::make('barrio')
                    ->searchable(),
                ImageColumn::make('adjunto_documento')
                    ->label('Documento')
                    ->url(fn ($record) => $record->adjunto_documento)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
