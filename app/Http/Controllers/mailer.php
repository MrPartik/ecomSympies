<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sympiesMailer;

class mailer extends Controller
{
    public function sendEmailReminder()
    {
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = ' ';
        $objDemo->receiver = 'ReceiverUserName';

        Mail::to("kataga.pupqc@gmail.com")->send(new sympiesMailer($objDemo));
    }
}
