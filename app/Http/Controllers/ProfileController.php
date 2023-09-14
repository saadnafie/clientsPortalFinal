<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\EmailVerification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\UserDetails;
use App\Models\Application;
use Illuminate\Support\Facades\Hash;
use App\Mail\ValidateSecondaryEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProfileController extends Controller
{
     /**
     * Show the user's profile page.
     */
    public function showAccount(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id)->load('userDetails');
        $app = Application::where('user_id',$id)->first();
        $applications = Application::with('status', 'applicationDetails', 'processStatus')->where('user_id',auth()->user()->id)->get();
        //return $applications;
        $draft = Application::where('process_id',1)->where('user_id',auth()->user()->id)->count();
        $process = Application::where('process_id',2)->where('user_id',auth()->user()->id)->count();
        $pending = Application::where('process_id',3)->where('user_id',auth()->user()->id)->count();
        $complete = Application::where('process_id',4)->where('user_id',auth()->user()->id)->count();
        return view('profile.show', compact(['user','app', 'applications', 'draft','process','pending','complete']));
    }

     /**
     * Edit user's profile details.
     */
    public function editAccount(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id)->load('userDetails');
        return view('profile.edit', compact(['user']));
    }

    /**
     * Edit user account (Avatar, name, passport, date of birth ... etc)
     */
    public function updateUserAccount(Request $request){
        $id = Auth::id();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $allowedfileExtension = [
              'jpg',
              'jpeg',
              'png',
              'JPG',
              'JPEG',
              'PNG',
            ];

            $file = $request->file('avatar');
            $max_size = 50 * 1024 * 1024; //  5MB

              if (!in_array($file->getClientOriginalExtension(), $allowedfileExtension)) {
                $data = [
                    'status' => "No",
                    'message' => 'Please check your avatar! only png, jpeg, jpg type of images are allowed.',
                  ];
                  return response()->json($data);
                exit();
              } elseif (filesize($file) > $max_size) {
                $data = [
                    'status' => "No",
                    'message' => 'Please check your attachment size! Maximum allowed size is 5MB.',
                  ];
                  return response()->json($data);
                exit();
              } else {
                $uniqid = Str::random(9);
                $filename = date('YmdHi') .$uniqid. $file->getClientOriginalName();
                $path = public_path('assets/media/avatars/');
                if (!file_exists($path)) {
                  mkdir($path, 0777, true);
                }
                $file->move($path, $filename);
                $update_avatar = User::find($id);
                if(auth()->user()->avatar != null && file_exists($path.auth()->user()->avatar))
                {
                    File::delete($path . auth()->user()->avatar);
                }
                User::find(auth()->user()->id)->update(['avatar' => $filename]);
              }
        }

        $details_id = $request->input('details_id');
        $update_user_data = UserDetails::find($details_id);
        $update_user_data->First_Name = $request->input('fname');
        $update_user_data->Middle_Name = $request->input('mname');
        $update_user_data->Last_Name = $request->input('lname');
        $update_user_data->Passport = $request->input('passport');
        $update_user_data->DateOfBirth = $request->input('dateOfBirth');
        $update_user_data->Residency = $request->input('residenceNumber');
        if($request->input('user_type') == 2){
            $update_user_data->Organization_Name = $request->input('organizationName');
            $update_user_data->Designation = $request->input('designation');
        }

        if($update_user_data->save())
        {
            auth()->user()->fill([
                'name' => $request->input('fname') . ' ' . $request->input('lname')
                ])->save();
            $data = [
                'status' => "Success",
                'message' => 'Your data was updated successfully.',
            ];
            return response()->json($data);
        }
        else
        {
            $data = [
                'status' => "Failed",
                'message' => $e->getMessage(),
            ];
            return response()->json($data);
        }
    }

    /**
     * Update user Password
     */
    public function updateUserPassword(Request $request)
    {
        if (Hash::check($request->currentpassword, auth()->user()->password)) {
            auth()->user()->fill([
            'password' => Hash::make($request->newpassword)
            ])->save();

            $data = [
                'status' => "Success",
                'message' => 'Your password was updated successfully',
            ];
            return response()->json($data);
        }
        else
        {
            $data = [
                'status' => "Failed",
                'message' => 'Please check your current password and try again',
            ];
            return response()->json($data);
        }
    }

    /**
     * Update email request, and send the verification code to the new user email to be verified
     */
    public function changeUserEmail(Request $request)
    {

        if (Hash::check($request->confirmemailpassword, auth()->user()->password)) {
            if ($request->emailaddress == auth()->user()->email) {
                $data = [
                    'status' => "Failed",
                    'message' => 'Your Email address (' . $request->emailaddress .') already exists and verified',
                ];
                return response()->json($data);
            }
            else
            {
                $user_id = Auth::id();
                $checkAvailableEmailCode = EmailVerification::where('user_id', $user_id)->count();
                if($checkAvailableEmailCode)
                {
                    $data = [
                        'status' => "Failed",
                        'message' => 'Too many email changes requests. Please wait 10 time to request a new changes',
                    ];
                    return response()->json($data);
                }
                else
                {
                    $emailCode = random_int(10000000, 99999999);
                    $new_email = new EmailVerification();
                    $new_email->user_id = auth()->user()->id;
                    $new_email->email = $request->emailaddress;
                    $new_email->code = $emailCode;
                    $new_email->save();
                    Mail::to($request->emailaddress)->send(new ValidateSecondaryEmail(auth()->user()->name, $emailCode));

                    $data = [
                        'status' => "Success",
                        'new_email' => $request->emailaddress,
                        'message' => 'Verification code was sent to your email ('.$request->emailaddress.') ',
                    ];
                    return response()->json($data);
                }

            }
        }
        else
        {
            $data = [
                'status' => "Failed",
                'message' => 'Please check your password and try again',
            ];
            return response()->json($data);
        }
    }

    /**
     * Resend verification code to the new user email to be verified
     */
    public function sendNewEmailCode(Request $request)
    {
        $checkAvailableEmailCode = EmailVerification::where('user_id', auth()->user()->id)->count();
        if($checkAvailableEmailCode)
        {
            $data = [
                'status' => "Failed",
                'message' => 'Too many verification code requests. Please wait 10 time to request a new code',
            ];
            return response()->json($data);
        }
        else
        {
            $emailCode = random_int(10000000, 99999999);
            $new_email = new EmailVerification();
            $new_email->user_id = auth()->user()->id;
            $new_email->email = $request->new_email_not_verified;
            $new_email->code = $emailCode;
            $new_email->save();
            try {
                Mail::to($request->new_email_not_verified)->send(new ValidateSecondaryEmail(auth()->user()->name, $emailCode));
                $data = [
                    'status' => "Success",
                    'new_email' => $request->new_email_not_verified,
                    'message' => 'New Verification code was sent to your email ('.$request->new_email_not_verified.') ',
                ];
                return response()->json($data);
            } catch (Throwable $exception) {
                Log::error($exception);
                $data = [
                    'status' => "Failed",
                    'new_email' => $request->new_email_not_verified,
                    'message' => 'Error: '. Log::error($exception).'',
                ];
                return response()->json($data);
            }

        }
    }

    /**
     * Get the remaining time for the current verification code
     */
    public function getTimerRemainingEmail(){
        $user_id = Auth::id();
        $remaining = 0;
        $checkAvailableEmailCode = EmailVerification::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
        if (!is_null($checkAvailableEmailCode)) {
            $remaining = 10 - (Carbon::createFromFormat('Y-m-d H:i:s', $checkAvailableEmailCode->created_at)->diffInMinutes(\Carbon\Carbon::now()));
        }
        $data = [
            'remaining' => $remaining,
        ];
        return response()->json($data);
    }

    /**
     * Verify the verification code for the new user email
     */
    public function verifyEmailCode(Request $request)
    {

         $data = $request->validate([
             'verification_code_email' => ['required', 'numeric'],
         ]);

        $email = $request->new_email_not_verified;

        $checkAvailableEmailCode = EmailVerification::where('user_id', auth()->user()->id)->first();
        $verify_email = $request->verification_code_email;
        if ($verify_email == $checkAvailableEmailCode->code)
        {
            $user = tap(User::find(auth()->user()->id)->update(['email' => $email, 'email_verified_at' => Carbon::now()->toDateTimeString() ]));
            EmailVerification::where('user_id', auth()->user()->id)->delete();
            $data = [
                'status' => "Success",
                'email' => $email,
                'message' => 'You have successfully changed and verified your new email address',
            ];
            return response()->json($data);
        }
        else
        {
            $data = [
                    'status' => "Failed",
                    'email' => $email,
                    'message' => 'Invalid verification code entered',
                ];
            return response()->json($data);
        }
    }

    /**
     * Update user phone number
     */
    public function updateUserPhone(Request $request)
    {
            auth()->user()->fill([
            'phone' => $request->phone_number
            ])->save();

            $data = [
                'status' => "Success",
                'message' => 'Your phone was updated successfully',
            ];
            return response()->json($data);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}