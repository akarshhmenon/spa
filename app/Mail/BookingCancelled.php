<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCancelled extends Mailable
{
    use Queueable, SerializesModels;

    protected $delete_booking_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($delete_booking_details)
    {
        $this->delete_booking_details=$delete_booking_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $details = $this->delete_booking_details;

        return $this->view('booking.deleteBookingMailTemplate', compact('details'));
    }
}
