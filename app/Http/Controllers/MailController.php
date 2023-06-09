<?php

namespace App\Http\Controllers;

use App\Http\Services\TelegramBotService;
use App\Mail\FormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $form = $request->input('form');
        TelegramBotService::sendMessage($form);
//        Mail::to($form['email'])->send(new FormMail($form));

        return response('ok');
    }
}
