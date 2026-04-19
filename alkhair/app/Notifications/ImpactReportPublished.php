<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImpactReportPublished extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public $project)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Rapport d\'impact publié')
            ->line('Un rapport d\'impact a été publié pour le projet: ' . $this->project->title)
            ->action('Voir le rapport', route('projects.show', $this->project->id));
    }

    public function toArray($notifiable): array
    {
        return [
            'project_id' => $this->project->id,
            'project_title' => $this->project->title,
            'message' => 'Rapport d\'impact publié pour: ' . $this->project->title,
        ];
    }
}
