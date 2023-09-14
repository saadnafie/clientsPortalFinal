<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserDetailsController extends Controller
{
    /**
     * view user details during the registration
     */
    public function show()
    {
        return view('auth.user-details');
    }

    /**
     * Store the user information in the DB user_details table
     */
    public function store(Request $request)
    {
        try {
            $id = Auth::id();
            $userDetails = new UserDetails();
            $userDetails->First_Name = $request->input('first_name');
            $userDetails->Middle_Name = $request->input('middle_name');
            $userDetails->Last_Name = $request->input('last_name');
            $userDetails->Passport = $request->input('passport_number');
            $newDate = date('Y-m-d', strtotime($request->input('dateofbirth')));
            $userDetails->DateOfBirth = $newDate;
            $userDetails->Residency = $request->input('residency_id');
            if ($request->input('user_type') == 2) {
                $userDetails->Organization_Name = $request->input('organization_name');
                $userDetails->Designation = $request->input('designation');
            }
            $userDetails->user_id = $id;
            $userDetails->save();

            $update_user = User::find($id);
            $update_user->details = 'Yes';
            $update_user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $update_user->save();

            if ($userDetails)
                $data = [
                    'status' => "Yes",
                    'message' => 'Your data was stored successfully!',
                ];
            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status' => "No",
                'message' => $e->getMessage(),
            ];
            return response()->json($data);
        }
    }

    /**
     * Once the user finished the tour, update Tour status in DB (Change Yes > Done)
     * for the details column in users table
     */
    public function updateTour()
    {
        $id = Auth::id();
        $update_user = User::find($id);
        $update_user->details = 'Done';
        $update_user->save();
        $data = [
            'status' => "Yes",
            'message' => 'Your data was updated successfully!',
        ];
        return response()->json($data);
    }
}