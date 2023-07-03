<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $type;
    public $mensaje;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $type, $mensaje )
    {
        $this->type = $type;
        $this->mensaje = $mensaje;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $group = "";
        if ( $this->type == 'process' )
        {
            $group = env('TELEGRAM_CHAT_ID_PROCESS');
        } elseif ( $this->type == 'document' )
        {
            $group = env('TELEGRAM_CHAT_ID_DOCUMENT');
        }
        return TelegramMessage::create()
            ->to($group)
            ->content($this->mensaje);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
