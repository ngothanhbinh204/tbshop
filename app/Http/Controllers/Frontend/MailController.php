<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendTestMail()
    {
        $details = [
            'title' => 'Mail from Laravel App',
            'body' => 'This is a test email sent using Laravel.'
        ];

        Mail::to('ntbinh14122004@gmail.com')->send(new TestMail($details));

        return "Email has been sent!";
    }
}
