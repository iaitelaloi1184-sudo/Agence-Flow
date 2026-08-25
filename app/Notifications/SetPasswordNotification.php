<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class SetPasswordNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $notifiable)
    {
        $url = URL::temporarySignedRoute(
          'password.setup',
           now()->addHours(48), // aussi : addMinutes(48) c'est très court, je recommande addHours(48)
           ['user' => $notifiable->id]
        );

        return (new MailMessage)
            ->subject('Bienvenue sur AgenceFlow')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Un compte a été créé pour vous sur AgenceFlow.')
            ->action('Définir mon mot de passe', $url)
            ->line('Ce lien expire dans 48 heures.');
    }

    
}
