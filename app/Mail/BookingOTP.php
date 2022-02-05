<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingOTP extends Mailable
{
    use Queueable, SerializesModels;

    protected $otp_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp_details)
    {
        $this->otp_details=$otp_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $details = $this->otp_details;

        return $this->view('booking.bookingMailTemplate', compact('details'));
    }
}
