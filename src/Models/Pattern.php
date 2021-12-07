<?php

namespace App\Models;

use App\Services\Notification\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;


    public function sendSms(string $patternName,String $phone_number,$attrs = [])
    {
        $pattern = $this->findPattern($patternName);
        $combinedArray = $this->combine($pattern,$attrs);
        $notification = resolve(Notification::class);
        return $notification->sendSms($pattern->pid , $phone_number , $combinedArray);
    }

    private function findPattern($patternName)
    {
        return $this->where(['name' => $patternName])->first();
    }
    private function combine($pattern , $attrs)
    {
        return array_combine(json_decode($pattern->variables),$attrs);
    }

}
