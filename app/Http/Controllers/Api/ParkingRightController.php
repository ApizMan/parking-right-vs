<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingRight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        return response()->json([
            'success' => true,
            'message' => 'All Parking Data Received',
            'data' => $list,
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
