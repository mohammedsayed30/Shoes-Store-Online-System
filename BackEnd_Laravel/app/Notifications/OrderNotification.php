<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderNotification extends Notification
{
    use Queueable;
    private $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        //
        $this->order = $order;
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
                    ->greeting('Hello Mr. '. $notifiable->name . '!')
                    ->subject('Order Confirmation')
                    ->line('Order Informations From BootUp Store.')
                    ->line('Order ID: ' . $this->order->id)
                    ->line('Total Price: ' . $this->order->total_price)
                    ->line('Shipping Address: ' . $this->order->shipping_address)
                    //->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!')
                    ->salutation('Best Regards, BootUp Store');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
