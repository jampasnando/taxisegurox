<?php

namespace App\Filament\Resources\Operadors;

use App\Filament\Resources\Operadors\Pages\CreateOperador;
use App\Filament\Resources\Operadors\Pages\EditOperador;
use App\Filament\Resources\Operadors\Pages\ListOperadors;
use App\Filament\Resources\Operadors\Pages\ViewOperador;
use App\Filament\Resources\Operadors\Schemas\OperadorForm;
use App\Filament\Resources\Operadors\Schemas\OperadorInfolist;
use App\Filament\Resources\Operadors\Tables\OperadorsTable;
use App\Models\Operador;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OperadorResource extends Resource
{
    protected static ?string $model = Operador::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'nombre';
    protected static ?string $label = 'Operador';
    protected static ?string $pluralLabel = 'Operadores';

    public static function form(Schema $schema): Schema
    {
        return OperadorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OperadorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OperadorsTable::configure($table);
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
            'index' => ListOperadors::route('/'),
            'create' => CreateOperador::route('/create'),
            'view' => ViewOperador::route('/{record}'),
            'edit' => EditOperador::route('/{record}/edit'),
        ];
    }
}
