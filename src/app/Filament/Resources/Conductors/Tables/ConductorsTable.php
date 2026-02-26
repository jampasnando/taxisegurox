<?php

namespace App\Filament\Resources\Conductors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConductorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nrodocumento')
                    ->searchable(),
                TextColumn::make('expedido')
                    ->searchable(),
                TextColumn::make('tipo')
                    ->searchable(),
                TextColumn::make('nombres')
                    ->searchable(),
                TextColumn::make('primer_apellido')
                    ->searchable(),
                TextColumn::make('segundo_apellido')
                    ->searchable(),
                TextColumn::make('tercere_apellido')
                    ->searchable(),
                TextColumn::make('celular')
                    ->searchable(),
                TextColumn::make('zona')
                    ->searchable(),
                TextColumn::make('barrio')
                    ->searchable(),
                TextColumn::make('tic')
                    ->searchable(),
                TextColumn::make('categoria')
                    ->searchable(),
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
