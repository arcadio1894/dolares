<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TelegramNotification;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\TelegramChannel;

class TelegramController extends Controller
{
    public function sendMessage()
    {
        $user = User::find(2);
        $type = 'document';
        $mensaje1 = "Hay un usuario que hizo una operacion con codigo xxxxxxx y fecha xx/xx/xxxx";
        $mensaje2 = "El usuario con nombre XXXXXXX con fecha de registro 01 Jul 2023, 6:21 pm necesita que valides sus documentos";

        //$user->notify(new TelegramNotification($type, $mensaje1));
        $user->notify(new TelegramNotification($type, $mensaje2));

        return 'Notificación enviada a Telegram.';
    }
}
