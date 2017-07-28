<?php

namespace STS\Notifications;

use  STS\Services\Notifications\BaseNotification;
use  STS\Services\Notifications\Channels\MailChannel;
use  STS\Services\Notifications\Channels\PushChannel;
use  STS\Services\Notifications\Channels\DatabaseChannel;

class PendingRateNotification extends BaseNotification
{
    protected $via = [DatabaseChannel::class, MailChannel::class, PushChannel::class];

    public function toEmail($user)
    {
        return [
            'title' => 'Contanos como te fue en el viaje hacia '.$this->getAttribute('trip')->to_town.'?',
            'email_view' => 'pending_rate',
            'url' =>  config('app.url').'/app/#Active/'.$this->getAttribute('hash')
        ];
    }

    public function toString()
    {
        return 'Tienes un viaje por calificar.';
    }

    public function getExtras()
    {
        return [
            'type' => 'my-trips',
        ];
    }

    public function toPush($user, $device)
    {
        return [
            'message' => 'Tienes un viaje por calificar.',
            'url' => 'rates',
        ];
    }
}
