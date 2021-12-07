<?php

namespace App\Http\Controllers;

use App\Models\Verify;
use Illuminate\Http\Request;


class VerifyController
{

    public $CODE_SENT;

    public function __construct(Request $request)
    {
        $this->CODE_SENT = 'code.sent';
    }

    public function requestCode($name,$phone_number)
    {

        // generate code for user
        $code = Verify::generateCodeFor($phone_number);

        // send the code
        $code->send($name,$phone_number);

        // return status
        return $this->CODE_SENT;

    }
}