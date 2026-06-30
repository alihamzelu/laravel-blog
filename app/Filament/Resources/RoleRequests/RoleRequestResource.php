<?php

namespace App\Filament\Resources\RoleRequests;

use App\Filament\Resources\RoleRequests\Pages\CreateRoleRequest;
use App\Filament\Resources\RoleRequests\Pages\EditRoleRequest;
use App\Filament\Resources\RoleRequests\Pages\ListRoleRequests;
use App\Filament\Resources\RoleRequests\Schemas\RoleRequestForm;
use App\Filament\Resources\RoleRequests\Tables\RoleRequestsTable;
use App\Models\RoleRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RoleRequestResource extends Resource
{
    protected static ?string $model = RoleRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'requested_role';

    public static function form(Schema $schema): Schema
    {
        return RoleRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoleRequestsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoleRequests::route('/'),
            'create' => CreateRoleRequest::route('/create'),
            'edit' => EditRoleRequest::route('/{record}/edit'),
        ];
    }
}