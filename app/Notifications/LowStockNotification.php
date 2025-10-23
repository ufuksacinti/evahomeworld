<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $product;

    /**
     * Create a new notification instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
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
            ->subject('⚠️ Düşük Stok Uyarısı - ' . $this->product->name)
            ->greeting('Merhaba,')
            ->line('**' . $this->product->name . '** ürününün stoğu kritik seviyede!')
            ->line('**Mevcut Stok:** ' . $this->product->stock . ' adet')
            ->line('**SKU:** ' . $this->product->sku)
            ->line('**Koleksiyon:** ' . ($this->product->collection->name ?? 'Yok'))
            ->action('Ürünü Görüntüle', route('admin.products.edit', $this->product))
            ->line('Lütfen stok güncellemesi yapın.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'product_sku' => $this->product->sku,
            'current_stock' => $this->product->stock,
            'message' => 'Ürün stoğu kritik seviyede.',
        ];
    }
}

