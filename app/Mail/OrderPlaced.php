<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $filename = public_path('/storage/pdfs/' . $this->order->number . '.pdf');

        return $this->from('check@japanesecarhistory.com', 'Japanese Car History')
        ->subject('Car History Request Received')
        ->view('emails.order.placed');
        // ->attach($filename);
    }
}
