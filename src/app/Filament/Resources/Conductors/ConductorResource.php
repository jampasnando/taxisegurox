<?php

namespace App\Filament\Resources\Conductors;

use App\Filament\Resources\Conductors\Pages\CreateConductor;
use App\Filament\Resources\Conductors\Pages\EditConductor;
use App\Filament\Resources\Conductors\Pages\ListConductors;
use App\Filament\Resources\Conductors\Pages\ViewConductor;
use App\Filament\Resources\Conductors\Schemas\ConductorForm;
use App\Filament\Resources\Conductors\Schemas\ConductorInfolist;
use App\Filament\Resources\Conductors\Tables\ConductorsTable;
use App\Models\Conductor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConductorResource extends Resource
{
    protected static ?string $model = Conductor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'conductor';
    protected static ?string $label = 'Conductor';
    protected static ?string $pluralLabel = 'Conductores';

    public static function form(Schema $schema): Schema
    {
        return ConductorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ConductorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConductorsTable::configure($table);
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
            'index' => ListConductors::route('/'),
            'create' => CreateConductor::route('/create'),
            'view' => ViewConductor::route('/{record}'),
            'edit' => EditConductor::route('/{record}/edit'),
        ];
    }
}
