<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting');
    }

    public function changePassword(Request $request)
    {
        // Step 1: Validate the input fields
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|string|min:8|confirmed',
        ], [
            'newPassword.confirmed' => 'The new password and confirm password do not match.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Step 2: Update the authenticated user's password
        $user = User::find(Auth::user()->id);
        $password = Hash::make($request->input('newPassword'));
        $user->update(['password' => $password]);

        // Step 3: Redirect back with a success message
        return redirect()->route('setting.setting')->with('status', 'Password changed successfully.');
    }
}
