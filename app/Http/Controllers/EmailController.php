<?php

namespace App\Http\Controllers;

use App\Mail\ClientSelectionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $user = auth()->user();
        $recipientEmail = 'leayasultana@gmail.com';
        $data = 'Test Data';

        Mail::to($recipientEmail)->send(new ClientSelectionMail($data));

        return "Email sent successfully!";
    }
}
