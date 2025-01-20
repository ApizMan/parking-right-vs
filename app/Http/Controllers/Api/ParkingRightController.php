<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingRight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ParkingRightController extends Controller
{
    private const TOKEN_EXPIRATION = 43200; // Token validity in minutes (30 days = 30 * 24 * 60)

    public function index(Request $request)
    {
        // Check for Authorization header
        $authorizationHeader = $request->header('Authorization');
        if (!$authorizationHeader || !str_starts_with($authorizationHeader, 'Bearer ')) {
            return response()->view('errors.forbidden', [
                'success' => false,
                'message' => 'Authorization header missing or invalid. Please provide a valid Bearer token.',
            ], 401);
        }

        // Extract token from Authorization header
        $token = substr($authorizationHeader, 7);

        // Validate the token in the cache
        if (!Cache::has($token)) {
            return response()->view('errors.forbidden', [
                'success' => false,
                'message' => 'Invalid or expired token. Please generate a new token.',
            ], 401);
        }

        // Fetch the list of parking rights
        $list = ParkingRight::all();

        // Transform the collection into an array
        $data = $list->map(function ($parkingRight) {
            return [
                'id' => $parkingRight->id,
                'parking_id' => $parkingRight->parking_id,
                'plate_number' => $parkingRight->plate_number,
                'start_date' => $parkingRight->start_date,
                'start_time' => $parkingRight->start_time,
                'end_date' => $parkingRight->end_date,
                'end_time' => $parkingRight->end_time,
                'paid_amount' => $parkingRight->paid_amount,
                'creation_date' => $parkingRight->creation_date,
                'creation_time' => $parkingRight->creation_time,
                'zone' => $parkingRight->zone,
                'terminal' => $parkingRight->terminal,
                'transaction_no' => $parkingRight->transaction_no,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'All Parking Data Received',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        // Check for Authorization header
        $authorizationHeader = $request->header('Authorization');
        if (!$authorizationHeader || !str_starts_with($authorizationHeader, 'Bearer ')) {
            return response()->view('errors.forbidden', [
                'success' => false,
                'message' => 'Authorization header missing or invalid. Please provide a valid Bearer token.',
            ], 401);
        }

        // Extract token from Authorization header
        $token = substr($authorizationHeader, 7);

        // Validate the token in the cache
        if (!Cache::has($token)) {
            return response()->view('errors.forbidden', [
                'success' => false,
                'message' => 'Invalid or expired token. Please generate a new token.',
            ], 401);
        }

        $validate = $request->validate([
            'plate_number' => 'required|string|max:255',
            'start_date' => 'required|date_format:d-m-Y',
            'start_time' => 'required|date_format:h:i:s A',
            'end_date' => 'required|date_format:d-m-Y',
            'end_time' => 'required|date_format:h:i:s A',
            'paid_amount' => 'required',
            'creation_date' => 'required|date_format:d-m-Y',
            'creation_time' => 'required|date_format:h:i:s A',
            'zone' => 'required|numeric|max:255',
            'terminal' => 'required|string|max:255',
            'transaction_no' => 'required|string|max:255',
        ]);

        // Generate a UUID for parking_id
        $parkingId = (string) Str::uuid();

        if ($validate['zone'] == 1) {
            $zone = 'Pahang - PBT Kuantan';
        } else if ($validate['zone'] == 2) {
            $zone = 'Terengganu - PBT Kuala Terengganu';
        } else if ($validate['zone'] == 3) {
            $zone = 'Kelantan - PBT Machang';
        }

        $parking = ParkingRight::create([
            'parking_id' => $parkingId,
            'plate_number' => $validate['plate_number'],
            'start_date' => $validate['start_date'],
            'start_time' => $validate['start_time'],
            'end_date' => $validate['end_date'],
            'end_time' => $validate['end_time'],
            'paid_amount' => $validate['paid_amount'],
            'creation_date' => $validate['creation_date'],
            'creation_time' => $validate['creation_time'],
            'zone' => $zone,
            'terminal' => $validate['terminal'],
            'transaction_no' => $validate['transaction_no'],
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Successfully Created Parking',
            'data' => $parking,
        ]);
    }

    public function generateToken()
    {
        // Generate a random token
        $token = bin2hex(random_bytes(16));
        Cache::put($token, true, self::TOKEN_EXPIRATION);

        return response()->json([
            'success' => true,
            'message' => 'Token generated successfully.',
            'token' => $token,
            'expires_in' => self::TOKEN_EXPIRATION / 1440 . ' days', // Convert minutes to days
        ]);
    }
}
