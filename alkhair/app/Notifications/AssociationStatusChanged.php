<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssociationStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public $status)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $message = (new MailMessage)->subject('Mise à jour de votre compte association');

        if ($this->status === 'ACTIVE') {
            $message->line('Félicitations ! Votre compte association a été validé.')
                ->action('Accéder au tableau de bord', route('association.dashboard'));
        } elseif ($this->status === 'BANNED') {
            $message->line('Votre compte association a été suspendu.');
        }

        return $message;
    }

    public function toArray($notifiable): array
    {
        return [
            'status' => $this->status,
            'message' => 'Votre compte association a été mis à jour: ' . $this->status,
        ];
    }
}
