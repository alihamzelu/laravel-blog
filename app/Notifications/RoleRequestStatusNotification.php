<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RoleRequestStatusNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $status,
        public ?string $reason = null,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->status === 'approved'
                ? 'Role Request Approved'
                : 'Role Request Rejected',

            'message' => $this->status === 'approved'
                ? 'Your request to become an author has been approved.'
                : 'Your request to become an author has been rejected.',

            'status' => $this->status,
            'reason' => $this->reason,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}