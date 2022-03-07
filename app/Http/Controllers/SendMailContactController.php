<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;
use App\Mail\MailNotify;


class SendMailContactController extends Controller
{
    public function sendMailContact(Request $request)
    {
        $user = (object)[
            'email' => 'ngocuong691@gmail.com'
        ];
        $dataContact = [
            'name' => $request['name'],
            'email' => $request['email'],
            'content' => $request['content'],
        ];
        SendEmail::dispatch($dataContact, $user)->delay(now()->addMinute(1));
    }

    public function send(Request $request) {

        $details = [
            'name'=> $request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
            'message'=> $request->message,
        ];
        Mail::to('ngocuong691@gmail.com')->send(new MailNotify($details));
    }
}
