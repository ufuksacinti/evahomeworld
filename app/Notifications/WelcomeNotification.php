<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('EvaHome\'a Hoş Geldiniz! 🎉')
            ->greeting('Merhaba ' . $notifiable->name . ',')
            ->line('EvaHome ailesine hoş geldiniz!')
            ->line('Hesabınız başarıyla oluşturuldu. Artık özel koleksiyonlarımızı keşfedebilir, alışveriş yapabilir ve daha fazlasını yapabilirsiniz.')
            ->action('Koleksiyonları Keşfet', route('collections.index'))
            ->line('İlk alışverişinizde size özel kampanyalarımızdan yararlanabilirsiniz.')
            ->line('Bizi tercih ettiğiniz için teşekkür ederiz!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Hoş geldiniz!',
        ];
    }
}

