<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactMeRequest;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('blog.contact');
    }

    public function sendContactInfo(ContactMeRequest $request)
    {
        $data = $request->only('name', 'email', 'phone');
        $data['messageLines'] = explode("\n", $request->get('message'));

        Mail::to($data['email'])->queue(new ContactMail($data));

        return back()
            ->with("success", "消息已发送，感谢您的反馈");
    }
}
