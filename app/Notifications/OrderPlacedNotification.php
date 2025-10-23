<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Siparişiniz Alındı - #' . $this->order->order_number)
            ->greeting('Merhaba ' . $notifiable->name . ',')
            ->line('Siparişiniz başarıyla oluşturuldu.')
            ->line('**Sipariş Numarası:** ' . $this->order->order_number)
            ->line('**Sipariş Tutarı:** ₺' . number_format($this->order->getGrandTotal(), 2))
            ->line('**Sipariş Tarihi:** ' . $this->order->created_at->format('d.m.Y H:i'))
            ->action('Siparişimi Görüntüle', route('order.detail', $this->order))
            ->line('Siparişinizle ilgili güncellemeleri size bildireceğiz.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'total_amount' => $this->order->getGrandTotal(),
            'message' => 'Yeni siparişiniz oluşturuldu.',
        ];
    }
}

