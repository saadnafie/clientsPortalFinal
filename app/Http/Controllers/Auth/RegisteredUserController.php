<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //dd( $request);
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            //'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'numeric', 'max:25', 'min:9', 'unique:'.User::class],
            'phone' => ['required', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = User::create([
            'role_id' => $request->acc_type_val,
            'details' => 'No',
            'name' => $request->name,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function register_store(Request $request)
    {
        //dd( $request);
        $validator = Validator::make(
            ['email' => 'required|email|unique:users'],
            ['phone' => 'required|unique'],
            ['password' => 'required|min:8'],
        );

        $user = User::create([
            'role_id' => $request->account_type,
            'details' => 'No',
            'name' => '',
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $data = [
            'success' => true,
            'message' =>
                $validator->messages()->all()
        ];
        return response()->json($data);

        // return redirect(RouteServiceProvider::HOME);
    }
}