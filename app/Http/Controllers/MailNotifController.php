<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\TestMail;

class MailNotifController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function mailview()
    {
        $data = [
            'title' => 'Success',
            'content' => 'This is an email testing using Laravel-Brevo',
        ];
        return view('emails.test', compact('data'));
    }

    // public function sendEmail()
    // {
    //     $details = [
    //         'title' => 'Success',
    //         'content' => 'This is an email testing using Laravel-Brevo',
    //         'subject' => 'Custom Subject Here',
    //     ];
       
    //     \Mail::to('erastmedia@gmail.com')->send(new TestMail($details));
       
    //     return 'Email sent at ' . now();
    // }

    public function sendEmail()
    {
        $details = [
            'title' => 'Success',
            'content' => 'This is an email testing using Laravel-Brevo',
            'subject' => 'Update regarding on your order with Custon Number : PI64965465', // Tambahkan subjek kustom di sini
        ];

        $email = new TestMail($details);

        // Set subjek email secara dinamis
        $email->withSwiftMessage(function ($message) use ($details) {
            // Hapus subjek yang ditetapkan secara default
            $message->setSubject(null);
            // Tambahkan subjek kustom
            $message->getHeaders()
                    ->addTextHeader('Subject', $details['subject']);
        });
        
        \Mail::to('erastmedia@gmail.com')->send($email);
        
        return 'Email sent at ' . now();
    }
}