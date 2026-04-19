<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class DonationStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public $donation, public $newStatus)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Mise à jour de votre don')
            ->line('Le statut de votre don a été mis à jour.')
            ->line('Nouveau statut: ' . $this->newStatus)
            ->action('Voir mes dons', route('donator.dashboard'));
    }

    public function toArray($notifiable): array
    {
        return [
            'donation_id' => $this->donation->id,
            'status' => $this->newStatus,
            'message' => 'Le statut de votre don a été mis à jour à: ' . $this->newStatus,
        ];
    }
}
