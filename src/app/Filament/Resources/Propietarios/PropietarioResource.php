<?php

namespace App\Filament\Resources\Propietarios;

use App\Filament\Resources\Propietarios\Pages\CreatePropietario;
use App\Filament\Resources\Propietarios\Pages\EditPropietario;
use App\Filament\Resources\Propietarios\Pages\ListPropietarios;
use App\Filament\Resources\Propietarios\Pages\ViewPropietario;
use App\Filament\Resources\Propietarios\RelationManagers\PropietarioVehiculosRelationManager;
use App\Filament\Resources\Propietarios\Schemas\PropietarioForm;
use App\Filament\Resources\Propietarios\Schemas\PropietarioInfolist;
use App\Filament\Resources\Propietarios\Tables\PropietariosTable;
use App\Models\Propietario;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PropietarioResource extends Resource
{
    protected static ?string $model = Propietario::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'propietario';

    public static function form(Schema $schema): Schema
    {
        return PropietarioForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PropietarioInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropietariosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            PropietarioVehiculosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropietarios::route('/'),
            'create' => CreatePropietario::route('/create'),
            'view' => ViewPropietario::route('/{record}'),
            'edit' => EditPropietario::route('/{record}/edit'),
        ];
    }
}
