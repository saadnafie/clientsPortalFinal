<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\User;
use App\Models\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class TwilioController extends Controller
{
    /**
     * Verify phone view
     */
    public function verify_phone()
    {
        return view('auth.verify-phone');
    }

    /**
     * Verify phone check view
     */
    public function verify_phone_check()
    {
        return view('auth.verify-phone-check');
    }

    /**
     * The remaining time for verification code
     */
    public function getTimerRemaining()
    {
        $user_id = Auth::id();
        $remaining = 0;
        $type = '';
        $checkAvailableOTP = PhoneVerification::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
        if (!is_null($checkAvailableOTP)) {
            $remaining = 3 - (Carbon::createFromFormat('Y-m-d H:i:s', $checkAvailableOTP->created_at)->diffInMinutes(\Carbon\Carbon::now()));
            $type = $checkAvailableOTP->type;
        }
        $data = [
            'remaining' => $remaining,
            'type' => $type,
        ];
        return response()->json($data);
    }

    /**
     * Store the new phone number in the users DB table
     */
    public function storeNewPhone(Request $request)
    {
        $update = auth()->user()->fill([
            'phone' => $request->phone_number
        ])->save();
        if ($update) {
            $user_id = Auth::id();
            PhoneVerification::where('user_id', $user_id)->delete();

            $data = [
                'status' => "Yes",
                'newphone' => $request->phone_number,
                'message' => 'Your phone number (' . $request->phone_number . ') was updated successfully',
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => "No",
                'newphone' => $request->phone_number,
                'message' => 'Please check your phone number and try again',
            ];
            return response()->json($data);
        }
    }

    /**
     * Send an SMS verification code for the user
     */
    public function send_otp(Request $request)
    {
        $user_id = Auth::id();
        $checkAvailableOTP = PhoneVerification::where('user_id', $user_id)->count();
        if ($checkAvailableOTP) {
            return redirect()->route('verify-phone', array('error_message' => 'Too many code verification requests. Please wait 3 minutes to request another verification code'));
        } else {
            $data['phone_number'] = auth()->user()->phone;
            $channel = "sms";

            try {
                $token = config('services.twilio.token');
                $twilio_sid = config('services.twilio.sid');
                $twilio_verify_sid = config('services.twilio.verify_sid');

                $twilio = new Client($twilio_sid, $token);
                $verification = $twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($data['phone_number'], $channel);


                $newOPT = new PhoneVerification();
                $newOPT->user_id = Auth::id();
                $newOPT->type = 'twilio';
                $newOPT->save();
                return redirect()->route('verify-phone-check');
            } catch (Exception $e) {
                return redirect()->route('verify-phone', array('error_message' => 'Too many code verification requests. Please wait 3 minute to request another verification code', 'error_code' => $e->getCode()));
            }
        }

    }

    /**
     * Resend the verification code to the user
     */
    public function send_new_otp(Request $request)
    {
        $user_id = Auth::id();
        $checkAvailableOTP = PhoneVerification::where('user_id', $user_id)->count();
        if ($checkAvailableOTP) {
            $data = [
                'status' => "Failed",
                'message' => 'Too many code verification requests. Please wait until the remaining time is finished',
            ];
            return response()->json($data);
        } else {
            $phone = '';
            if (isset($request->phone_number)) {
                $phone = $request->phone_number;
            } else {
                $phone = auth()->user()->phone;
            }

            $type = $request->verification_type;
            if ($type == 'twilio') {
                $data['phone_number'] = $phone;
                $channel = "sms";
                try {
                    $token = config('services.twilio.token');
                    $twilio_sid = config('services.twilio.sid');
                    $twilio_verify_sid = config('services.twilio.verify_sid');
                    $twilio = new Client($twilio_sid, $token);
                    $verification = $twilio->verify->v2->services($twilio_verify_sid)
                        ->verifications
                        ->create($data['phone_number'], $channel);


                    // Store current date/time for this OTP
                    $newOPT = new PhoneVerification();
                    $newOPT->user_id = Auth::id();
                    $newOPT->type = 'twilio';
                    $newOPT->save();
                    //return $verification->status;
                    $data = [
                        'status' => "Success",
                        'verification_type' => 'twilio',
                        'message' => 'Verification code was sent successfully',
                    ];
                    return response()->json($data);
                } catch (Exception $e) {
                    $data = [
                        'status' => "Failed",
                        'message' => $e->getMessage(),
                    ];
                    return response()->json($data);
                }
            } else {

                $OTPcode = random_int(100000, 999999);
                $wtsp_phone = str_replace("+", "", $phone);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://graph.facebook.com/v15.0/112815581740668/messages',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                    "messaging_product": "whatsapp",
                    "to": ' . $wtsp_phone . ',
                    "type": "template",
                    "template": {
                        "name": "user_authentication",
                        "language": {
                            "code": "en"
                        },
                        "components": [{
                            "type": "body",
                            "parameters": [
                            {
                                    "type": "text",
                                    "text": ' . $OTPcode . '
                            }],
                        }],
                    },
                }',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer EAAJwTM6hBWIBAEmYEy4gR7ynspZAIHHWlEop9V4rpEiajNFZCaYt7K0YT7XAkdehmSvlubbKAdS6bHr2K4Pr7hDhniGGg0Ej2YMtpvXcBaAFE7ZCk7VLm9vz2xUtue5GYDZBZCcSjZCug91EaDmOyPqsZBQ0E4dp9ZCtONiaobA4vvbxSygBiR8aZCZB8Kk5afq8fZARmwtWDusVAZDZD',
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $result_test = json_decode($response, true);
                if (array_key_exists('error', $result_test)) {
                    $data = [
                        'status' => "Failed",
                        'message' => $response . 'We could not send you a verification code to your whatsapp number (' . $phone . ')',
                    ];
                    return response()->json($data);
                } else {
                    // Store current date/time for this OTP
                    $newOPT = new PhoneVerification();
                    $newOPT->user_id = Auth::id();
                    $newOPT->type = 'whatsapp';
                    $newOPT->code = $OTPcode;
                    $newOPT->save();

                    $data = [
                        'status' => "Success",
                        'verification_type' => 'whatsapp',
                        'message' => 'Verification code was sent to your whatsapp number (' . $phone . ')',
                    ];
                    return response()->json($data);
                }
            }
        }
    }

    /**
     * Verify the verification code that has been sent to the user, and return
     * success if it is matched
     */
    public function verify_otp(Request $request)
    {

        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
        ]);

        $phone = '';
        if (isset($request->phone_number)) {
            $phone = $request->phone_number;
        } else {
            $phone = auth()->user()->phone;
        }

        $token = config('services.twilio.token');
        $twilio_sid = config('services.twilio.sid');
        $twilio_verify_sid = config('services.twilio.verify_sid');

        if ($request->verification_type == 'twilio') {
            $data['phone_number'] = $phone;
            $twilio = new Client($twilio_sid, $token);

            try {
                $verification_check = $twilio->verify->v2->services($twilio_verify_sid)
                    ->verificationChecks
                    ->create([
                        'to' => $data['phone_number'],
                        'code' => $data['verification_code']
                    ]);
                if ($verification_check->valid) {
                    $user = tap(User::find(auth()->user()->id)->update(['phone' => $phone, 'phone_verified_at' => Carbon::now()->toDateTimeString()]));
                    PhoneVerification::where('user_id', auth()->user()->id)->delete();
                    /* Authenticate user */
                    //Auth::login($user->first());
                    $data = [
                        'status' => "Success",
                        'phone_number' => $phone,
                        'message' => 'You have successfully verified your phone number',
                    ];
                    return response()->json($data);
                } else {
                    $data = [
                        'status' => "Failed",
                        'phone_number' => $phone,
                        'message' => 'Invalid verification code entered',
                    ];
                    return response()->json($data);
                }
            } catch (Exception $e) {
                $data = [
                    'status' => "Failed",
                    'phone_number' => $phone,
                    'message' => $e->getMessage(),
                ];
                return response()->json($data);
            }
        } else {
            $user_id = Auth::id();
            $checkAvailableOTP = PhoneVerification::where('user_id', $user_id)->where('type', 'whatsapp')->first();
            $verify_whatsapp = $request->verification_code;
            if ($verify_whatsapp == $checkAvailableOTP->code) {
                $user = tap(User::find(auth()->user()->id)->update(['phone' => $phone, 'phone_verified_at' => Carbon::now()->toDateTimeString()]));
                PhoneVerification::where('user_id', auth()->user()->id)->delete();
                $data = [
                    'status' => "Success",
                    'phone_number' => $phone,
                    'message' => 'You have successfully verified your phone number',
                ];
                return response()->json($data);
            } else {
                $data = [
                    'status' => "Failed",
                    'phone_number' => $phone,
                    'message' => 'Invalid verification code entered',
                ];
                return response()->json($data);
            }
        }
    }

    /**
     * Send a verification code for the user to update his phone number in his profile
     */
    public function sendOptUserPhone(Request $request)
    {
        $user_id = Auth::id();
        $checkAvailableOTP = PhoneVerification::where('user_id', $user_id)->where('type', 'twilio')->count();
        if ($checkAvailableOTP) {
            $data = [
                'status' => "Failed",
                'message' => 'Too many code verification requests. Please wait 3 minutes to request another verification code',
            ];
            return response()->json($data);
        } else {
            $id = Auth::id();
            $user_data = User::find($id);
            if ($request->phone_number == $user_data->phone) {
                $data = [
                    'status' => "Failed",
                    'phone_number' => $request->phone_number,
                    'message' => 'Your phone number (' . $request->phone_number . ') already exists and verified',
                ];
                return response()->json($data);
            } else {
                $data['phone_number'] = $request->phone_number;
                $channel = "sms";
                /*$data = $request->validate([
                    'country_code' => ['required', 'string', 'max:4'],
                    'phone_number' => ['required', 'numeric'],
                ]);*/
                try {
                    $token = config('services.twilio.token');
                    $twilio_sid = config('services.twilio.sid');
                    $twilio_verify_sid = config('services.twilio.verify_sid');
                    $twilio = new Client($twilio_sid, $token);
                    $verification = $twilio->verify->v2->services($twilio_verify_sid)
                        ->verifications
                        ->create($data['phone_number'], $channel);


                    // Store current date/time for this OTP
                    $newOPT = new PhoneVerification();
                    $newOPT->user_id = Auth::id();
                    $newOPT->type = 'twilio';
                    $newOPT->save();
                    //return $verification->status;
                    $data = [
                        'status' => "Success",
                        'phone_number' => $request->phone_number,
                        'message' => '',
                    ];
                    return response()->json($data);
                } catch (Exception $e) {
                    $data = [
                        'status' => "Failed",
                        'phone_number' => $request->phone_number,
                        'message' => $e->getMessage(),
                    ];
                    return response()->json($data);
                }
            }
        }
    }

}
