<?php

namespace App\Filament\Resources\RoleRequests\Pages;

use App\Filament\Resources\RoleRequests\RoleRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRoleRequests extends ListRecords
{
    protected static string $resource = RoleRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
