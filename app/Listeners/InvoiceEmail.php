<?php

namespace App\Listeners;

use App\Events\InvoiceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class InvoiceEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InvoiceEvent  $event
     * @return void
     */
    public function handle(InvoiceEvent $event)
    {
      $file = public_path('attachments/applications')."/".$event->application->application_serial.'/invoice.pdf';
      $user = auth()->user();
      Mail::send('customer.payment.mail',array(
               'name' => $user->name,
               'application_serial' => $event->application->application_serial,
          ), function($message) use ($user,$file)
          {
             $message->from(config('services.mail.MAIL_FROM_ADDRESS'),config('services.mail.MAIL_FROM_NAME'));
             $message->to($user->email, $user->name)->subject('Payment Success');
             $message->attach($file);
          });
    }
}