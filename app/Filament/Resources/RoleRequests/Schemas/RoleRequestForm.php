<?php

namespace App\Filament\Resources\RoleRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class RoleRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            Select::make('requested_role')
                ->options(Role::pluck('name', 'name'))
                ->searchable()
                ->required(),

            Textarea::make('message')
                ->columnSpanFull()
                ->nullable(),

            Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->default('pending')
                ->required(),
        ]);
    }
}