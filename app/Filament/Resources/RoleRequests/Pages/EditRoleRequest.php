<?php

namespace App\Filament\Resources\RoleRequests\Pages;

use App\Filament\Resources\RoleRequests\RoleRequestResource;
use App\Models\User;
use App\Notifications\RoleRequestStatusNotification;
use Filament\Resources\Pages\EditRecord;

class EditRoleRequest extends EditRecord
{
    protected static string $resource = RoleRequestResource::class;

    protected function afterSave(): void
    {
        $record = $this->record;

        $user = User::find($record->user_id);

        if (! $user) return;

        if ($record->status === 'approved') {

            if (! $user->hasRole($record->requested_role)) {
                $user->assignRole($record->requested_role);
            }

            $user->notify(
                new RoleRequestStatusNotification('approved')
            );
        }

        if ($record->status === 'rejected') {

            $user->notify(
                new RoleRequestStatusNotification('rejected')
            );
        }
    }
}