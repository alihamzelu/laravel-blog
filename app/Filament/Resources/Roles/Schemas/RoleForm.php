<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\CheckboxList;
use Spatie\Permission\Models\Permission;
class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('guard_name')
                    ->default('web')
                    ->required(),
                CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->columns(2),
            ]);
    }
}