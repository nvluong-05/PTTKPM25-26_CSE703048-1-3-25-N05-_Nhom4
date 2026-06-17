<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InforController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate dữ liệu
        $data = $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Gửi email
        Mail::raw($data['body'], function($message) use ($data) {
            $message->to($data['to'])
                    ->subject($data['subject']);
        });

        return redirect()->route('news.infor')->with('success', 'Gửi email thành công!');
    }
}