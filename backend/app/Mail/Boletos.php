<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Boletos extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->details['subject'])
                    ->from($this->details['from'])
                    ->to($this->details['to'])
                    ->html($this->details['body']);
    }
}
