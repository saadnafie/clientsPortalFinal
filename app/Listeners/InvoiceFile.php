<?php

namespace App\Listeners;

use App\Events\InvoiceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Barryvdh\DomPDF\Facade\Pdf;
use Log;

class InvoiceFile
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InvoiceEvent  $event
     * @return void
     */
    public function handle(InvoiceEvent $event)
    {
      $application = $event->application;
      $invoice = $event->invoice;
      $credentials = $event->credentials;
      $pdf = Pdf::loadView('customer.invoicepdf',compact('application','invoice','credentials'))->setOptions(['defaultFont' => 'sans-serif'])->stream();
    }
}