<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mailer extends Controller
{
    public function sendEmailReminder(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.reminder', ['user' => $user], function ($message) use ($user) {
            $message->from('hello@app.com', 'Your Application');

            $message->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }
}
