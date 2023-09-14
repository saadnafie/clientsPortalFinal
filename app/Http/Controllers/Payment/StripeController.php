<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Events\InvoiceEvent;
use App\Models\CredentialClassification;
use App\Models\Application;
use App\Models\Invoice;
use App\Models\ProfessionCountry;
use Illuminate\Support\Facades\Http;


class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.payment.stripe');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $application = Application::with('profession', 'country')->where('user_id',auth()->user()->id)->findOrFail($request->application_id);
      $id=$request->application_id;
      $credentials = CredentialClassification::with('rule')->whereHas('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->get();
        $employmentCredential = CredentialClassification::with('rule')->with('applicationDetail', function ($query) use($id) {
          $query->where('application_id',$id);
      })->find(5);
      $checkEmploymentExist = false;
      $type = 1;
      if($employmentCredential->applicationDetail->count() > 0){
          $checkEmploymentExist = true;
          $type = 2;
      }
      $rule = ProfessionCountry::where('profession_id',$application->profession_id)->where('country_id',$application->country_id)->where('package_type_id',$type)->first();
      $cost = $request->total_cost * 100;
      $message = "";
     try {
          $stripe = new Stripe\StripeClient(config('services.stripe.STRIPE_SECRET'));
          $stripe_response = $stripe->charges->create([
            "amount" => $cost,
            "currency" => "usd",
            "source" => $request->stripeToken, // obtained with Stripe.js
            "description" => "fees for client application process",
            "metadata" => ["application serial" => $application->application_serial,
                            "customer name" => auth()->user()->name,
                            "customer email" => auth()->user()->email,
                            "customer phone" => auth()->user()->phone,
                          ]
          ]);
          if ($stripe_response->status == "succeeded") {
            Application::findOrFail($request->application_id)->update(['status_id'=>2,'process_id'=>2]);
            $invoice = new Invoice();
            $invoice->application_id = $request->application_id;
            $invoice->total_cost = $request->total_cost;
            $invoice->transaction_id = $stripe_response->id;
            $invoice->save();
            $invoice->base_cost_val = $rule->base_cost;
            $invoice->checkEmploymentExist = $checkEmploymentExist;

            $pdf = Pdf::loadView('customer.invoicepdf',compact('application','invoice','credentials'))->setOptions(['defaultFont' => 'sans-serif']);
            $path = public_path('attachments/applications')."/".$application->application_serial.'/invoice.pdf';
            $pdf->save($path);
            event(new InvoiceEvent($request->application_id));
          }
          // $response = Http::post('http://127.0.0.1:3333/api/create');
          // $response = $response->getBody()->getContents();
          // $responses = json_decode($response);
          // if($responses->success == 'false')
          // {
          //   dd($responses->message);
          // }
          // else
          // {
          //   Application::find($request->application_id)->update([
          //     'issueKey' => $responses->key
          //   ]);
          // }
          return redirect()->route('dashboard')->with(['success' => 'Congratulations, Your Payment Done Successfully!']);
        } catch(\Stripe\Exception\CardException $e) {
          // Since it's a decline, \Stripe\Exception\CardException will be caught
          $message = 'CardException Status is:' . $e->getHttpStatus() . ' ';
          $message .= 'Type is:' . $e->getError()->type . ' ';
          $message .= 'Code is:' . $e->getError()->code . ' ';
          // param is '' in this case
          $message .= 'Param is:' . $e->getError()->param . ' ';
          $message .= 'Message is:' . $e->getError()->message . ' ';
        } catch (\Stripe\Exception\RateLimitException $e) {
          // Too many requests made to the API too quickly
          $message = 'RateLimitException Status is:' . $e->getHttpStatus() . ' ';
          $message .= 'Message is:' . $e->getError()->message . ' ';
        } catch (\Stripe\Exception\InvalidRequestException $e) {
          // Invalid parameters were supplied to Stripe's API
          $message = 'InvalidRequestException Status is:' . $e->getHttpStatus() . ' ';
          $message .= 'Message is:' . $e->getError()->message . ' ';
        } catch (\Stripe\Exception\AuthenticationException $e) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
          $message = 'AuthenticationException Status is:' . $e->getHttpStatus() . ' ';
          $message .= 'Message is:' . $e->getError()->message . ' ';
        } catch (\Stripe\Exception\ApiConnectionException $e) {
          // Network communication with Stripe failed
          $message = 'ApiConnectionException Status is:' . $e->getHttpStatus() . ' ';
          $message .= 'Message is:' . $e->getError()->message . ' ';
        } catch (\Stripe\Exception\ApiErrorException $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
          $message = 'ApiErrorException Status is:' . $e->getHttpStatus() . ' ';
          $message .= 'Message is:' . $e->getError()->message . ' ';
        } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
          $message = 'Exception Status is:' . $e->getHttpStatus() . ' ';
          $message .= 'Message is:' . $e->getError()->message . ' ';
        }
        return Redirect::back()->withErrors(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
      $application = Application::findOrFail($id);
      $total_cost = $request->total_cost;
      return view('customer.payment.stripe',compact('application','total_cost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function testpdf()
    {
      $invoice = Invoice::find(1);
      $application = Application::with('profession', 'country')->where('user_id',auth()->user()->id)->findOrFail(1);
      $id=1;
      $credentials = CredentialClassification::with('rule')->whereHas('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->get();
        $employmentCredential = CredentialClassification::with('rule')->with('applicationDetail', function ($query) use($id) {
          $query->where('application_id',$id);
      })->find(5);
      $checkEmploymentExist = false;
      $type = 1;
      if($employmentCredential->applicationDetail->count() > 0){
          $checkEmploymentExist = true;
          $type = 2;
      }
      $rule = ProfessionCountry::where('profession_id',$application->profession_id)->where('country_id',$application->country_id)->where('package_type_id',$type)->first();
      $base_cost_val = $rule->base_cost;

      return view('customer.invoicepdf',compact('application','invoice','credentials','checkEmploymentExist','base_cost_val'));
    }
}