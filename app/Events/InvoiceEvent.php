<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Application;
use App\Models\Invoice;
use App\Models\CredentialClassification;


class InvoiceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $application;
     public $invoice;
     public $credentials;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($application_id)
    {
      $this->application = Application::with('profession')->where('user_id',auth()->user()->id)->findOrFail($application_id);
      $this->invoice = Invoice::where('application_id',$application_id)->first();
      $this->credentials = CredentialClassification::whereHas('applicationDetail', function ($query) use($application_id) {
          $query->where('application_id',$application_id);
      })->with('applicationDetail', function ($query) use($application_id) {
          $query->where('application_id',$application_id);
      })->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
