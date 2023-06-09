<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $form)
    {
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail', ['form' => $this->form]);
    }
}
