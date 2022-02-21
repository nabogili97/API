<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;


class SendMailContactController extends Controller
{
    public function sendMailContact(Request $request)
    {
        $user = (object)[
            'email' => config('contant.mailAdmin')
        ];
        $dataContact = [
            'name' => $request['name'],
            'company' => $request['company'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'category' => $request['category'],
            'type' =>  $request['type'],
            'content' => $request['content'],
        ];
        SendEmail::dispatch($dataContact, $user)->delay(now()->addMinute(1));
    }
}
