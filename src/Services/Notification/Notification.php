<?php

namespace App\Services\Notification;

class Notification
{
    public function __call($method, $arguments)
    {

        $providerPath = __NAMESPACE__ . '\Providers\\' . substr($method, 4) . 'Provider';

        $providerInstance = new $providerPath;

        return $providerInstance->send(... $arguments);

    }

}