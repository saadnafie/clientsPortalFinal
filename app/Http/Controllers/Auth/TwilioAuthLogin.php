<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\User;
use App\Models\PhoneVerificationAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Providers\RouteServiceProvider;



class TwilioAuthLogin extends Controller
{

    /**
     * Return User IP Address to be used as a unique user value during the login auth
     */
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }

    /**
     * Return the remaining time for SMS verification code
     */
    public function getTimerRemaining()
    {

        $remaining = 0;
        $type = '';
        $user_ip = $this->getIp();
        $checkAvailableOTP = PhoneVerificationAuth::where('user_ip', $user_ip)->orderBy('created_at', 'desc')->first();
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
     * @return Success when the code is resent to the user
     * @return Failed when the code is facing an issue during the process of sending the verification code to the user
     */
    public function send_new_otp(Request $request)
    {
        $user_ip = $this->getIp();
        $checkAvailableOTP = PhoneVerificationAuth::where('user_ip', $user_ip)->count();
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
                $data = [
                    'status' => "Failed",
                    'message' => 'Please enter a valid phone number!',
                ];
                return response()->json($data);
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

                    $newOPT = new PhoneVerificationAuth();
                    $newOPT->user_ip = $user_ip;
                    $newOPT->type = 'twilio';
                    $newOPT->save();
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
                    $newOPT = new PhoneVerificationAuth();
                    $newOPT->user_ip = $user_ip;
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
     * Verify if the user entered the correct verification code that is
     * matched with the one that he received
     */
    public function verify_otp_login(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
        ]);

        $phone = '';
        if (isset($request->phone_number)) {
            $phone_exist = User::where('phone', $request->phone_number)->first();
            if($phone_exist){
                $phone = $request->phone_number;
            }else
            {
                $data = [
                    'status' => "Failed",
                    'message' => 'This phone number does not exist or registered!',
                ];
                return response()->json($data);
            }
        } else {
            $data = [
                'status' => "Failed",
                'message' => 'Please enter a valid phone number!',
            ];
            return response()->json($data);
        }

        $data['phone_number'] = $phone;
        $token = config('services.twilio.token');
        $twilio_sid = config('services.twilio.sid');
        $twilio_verify_sid = config('services.twilio.verify_sid');
        $twilio = new Client($twilio_sid, $token);

        try {
            $verification_check = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create([
                    'to' => $data['phone_number'],
                    'code' => $data['verification_code']
                ]);
            if ($verification_check->valid) {
                $user_ip = $this->getIp();
                PhoneVerificationAuth::where('user_ip', $user_ip)->delete();
                $data = [
                    'status' => "Success",
                    'phone_number' => $phone,
                    'message' => 'You have successfully verified your phone number',
                ];

                $user = User::where('phone', $phone)->first();
                if (isset($user)) {
                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
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
    }

    /**
     * Send the verification code to the user for the first time
     */
    public function sendOptUserPhone(Request $request)
    {
        $user_ip = $this->getIp();
        $checkAvailableOTP = PhoneVerificationAuth::where('user_ip', $user_ip)->where('type', 'twilio')->count();
        if ($checkAvailableOTP) {
            $data = [
                'status' => "Failed",
                'message' => 'Too many code verification requests. Please wait 3 minutes to request another verification code',
            ];
            return response()->json($data);
        } else {

            $phone_exist = User::where('phone', $request->phone_number)->first();
            if(!$phone_exist){
                $data = [
                    'status' => "Failed",
                    'message' => 'This phone number does not exist or registered!',
                ];
                return response()->json($data);
            }
            
            $data['phone_number'] = $request->phone_number;
            $channel = "sms";
            try {
                $token = config('services.twilio.token');
                $twilio_sid = config('services.twilio.sid');
                $twilio_verify_sid = config('services.twilio.verify_sid');
                $twilio = new Client($twilio_sid, $token);
                $verification = $twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($data['phone_number'], $channel);

                $newOPT = new PhoneVerificationAuth();
                $newOPT->user_ip = $user_ip;
                $newOPT->type = 'twilio';
                $newOPT->save();
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