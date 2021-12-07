<?php

namespace App\Models;

use App\Services\Notification\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    use HasFactory;

    protected $table= 'verify_code';
    protected $fillable = ['phone_number','code'];

    public static function generateCodeFor($phone_number)
    {
        $phoneForDelete = Verify::where('phone_number' , $phone_number);
        $phoneForDelete->delete();
        return static::create([
            'phone_number' => $phone_number,
            'code' => mt_rand(10000,99999)
        ]);
    }
    public function send($name,$phone_number)
    {
        $pattern = new pattern();
        $pattern->sendSms('verification' , $phone_number , [$name , $this->code]);
    }

}

