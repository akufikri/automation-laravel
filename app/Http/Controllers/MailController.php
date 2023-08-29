<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\FirstMail;
use App\Models\ListJobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mail()
    {
        $user = User::all();
        $list = ListJobs::all();
        return view('Layouts.mail', compact('user', 'list'));
    }
     public function send_mail(Request $request)
{
    $userInfos = $request->input('user_id'); // Array of selected user names and emails
    $subject = $request->input('subject');
    $message = $request->input('message');

    foreach ($userInfos as $userInfo) {
        // Split the user info into name and email
        list($name, $email) = explode('|', $userInfo);

        $emailData = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ];

        // Kirim email menggunakan SendMailJob dan FirstMail
        SendMailJob::dispatch($emailData);
    }

    return redirect()->back();
}

}