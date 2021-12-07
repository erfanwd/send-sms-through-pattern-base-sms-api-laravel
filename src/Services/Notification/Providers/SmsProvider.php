<?php
namespace App\Services\Notification\Providers;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class SmsProvider
{


    public function send($pid, $phone_number, $attrs = [])
    {
        $client = new Client();
        $pid = 'pid='.$pid;
        $str = config('services.sms.sms_link').'&'. $pid . '&' . config('services.sms.sms_fnum') . '&tnum=' . $phone_number;
        $p = 1;
        $v = 1;
        foreach ($attrs as $key => $attr) {

            $str .= '&p' . $p++ . '=' . $key . '&v' . $v++ . '=' . $attr;

        }

        return $client->get($str)->getBody();
    }

}
