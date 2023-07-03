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

        $user->notify(new TelegramNotification($type, $mensaje2));

        return 'Notificación enviada a Telegram.';
    }

    public function sendNotification( $type, array $data)
    {
        if ($type == 'process')
        {
            $user = User::find(2);
            $message = "Hay un usuario que hizo una operacion con codigo ".$data['codeUser']." y fecha ".$data['dateOperation'].".";
            $user->notify(new TelegramNotification($type, $message));
        } elseif ( $type == 'document' )
        {
            $user = User::find(2);
            $message = "El usuario con nombre ".$data['nameUser']." con fecha de registro ".$data['dateRegister']." necesita que valides sus documentos.";
            $user->notify(new TelegramNotification($type, $message));
        }
    }
}
