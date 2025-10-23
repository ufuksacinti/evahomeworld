<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;
    protected $oldStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, $oldStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
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
        $statusMessages = [
            'pending' => 'Sipariş bekleniyor',
            'processing' => 'Sipariş hazırlanıyor',
            'shipped' => 'Sipariş kargoya verildi',
            'delivered' => 'Sipariş teslim edildi',
            'cancelled' => 'Sipariş iptal edildi',
        ];

        $message = (new MailMessage)
            ->subject('Sipariş Durumu Güncellendi - #' . $this->order->order_number)
            ->greeting('Merhaba ' . $notifiable->name . ',')
            ->line('Sipariş numarası **' . $this->order->order_number . '** olan siparişinizin durumu güncellendi.');

        if ($this->order->status === 'shipped') {
            $message->line('🚚 **Harika haber!** Siparişiniz kargoya verildi.')
                    ->line('Kısa süre içinde elinizde olacak.');
        } elseif ($this->order->status === 'delivered') {
            $message->line('✅ **Siparişiniz teslim edildi!**')
                    ->line('Bizi tercih ettiğiniz için teşekkür ederiz.');
        } elseif ($this->order->status === 'cancelled') {
            $message->line('❌ **Siparişiniz iptal edildi.**')
                    ->line('Herhangi bir sorunuz varsa lütfen bizimle iletişime geçin.');
        } else {
            $message->line('**Yeni Durum:** ' . ($statusMessages[$this->order->status] ?? $this->order->status));
        }

        $message->action('Siparişimi Görüntüle', route('order.detail', $this->order))
                ->line('Bizi tercih ettiğiniz için teşekkür ederiz!');

        return $message;
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
            'old_status' => $this->oldStatus,
            'new_status' => $this->order->status,
            'message' => 'Sipariş durumunuz güncellendi.',
        ];
    }
}

