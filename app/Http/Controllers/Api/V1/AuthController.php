<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * Creates a new property owner account and returns an access token.
     * The new user is automatically assigned the "User" role.
     *
     * @group Authentication
     * @unauthenticated
     *
     * @bodyParam name string required Full name of the owner. Example: New Owner
     * @bodyParam dni string required Spanish DNI or NIE (unique). Example: 12345678A
     * @bodyParam email string required Email address (unique). Example: newowner@rentoo.com
     * @bodyParam phone string required Contact phone number. Example: 600111222
     * @bodyParam address string required Street address. Example: Carrer de Balmes, 10
     * @bodyParam city string required City. Example: Barcelona
     * @bodyParam postal_code string required Postal code. Example: 08007
     * @bodyParam province string required Province. Example: Barcelona
     * @bodyParam password string required Password (min 8 characters). Example: password
     * @bodyParam password_confirmation string required Must match password. Example: password
     *
     * @response 201 scenario="success" {
     *   "data": {"id": "uuid-here", "name": "New Owner", "email": "newowner@rentoo.com"},
     *   "token": "access-token-here"
     * }
     * @response 422 scenario="validation error" {
     *   "message": "The email has already been taken.",
     *   "errors": {"email": ["The email has already been taken."]}
     * }
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'dni'         => [
                                'required',
                                'string',
                                'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
                                'unique:owners,dni',
                            ],
            'email'       => 'required|string|email|max:100|unique:owners,email',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:250',
            'city'        => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province'    => 'required|string|max:100',
            'password'    => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'        => $validated['name'],
            'dni'         => $validated['dni'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'address'     => $validated['address'],
            'city'        => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'province'    => $validated['province'],
            'password'    => Hash::make($validated['password']),
        ]);

        $user->assignRole('User');

        $token = $user->createToken('api-token')->accessToken;

        return response()->json([
            'data'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
            'token' => $token,
        ], 201);
    }

    /**
     * Login a user.
     *
     * Authenticates the user with email and password and returns an access token.
     *
     * @group Authentication
     * @unauthenticated
     *
     * @bodyParam email string required Registered email address. Example: owner1@rentoo.com
     * @bodyParam password string required Account password. Example: password
     *
     * @response 200 scenario="success" {
     *   "data": {"id": "uuid-here", "name": "Owner Name", "email": "owner1@rentoo.com"},
     *   "token": "access-token-here"
     * }
     * @response 401 scenario="invalid credentials" {"message": "Invalid credentials"}
     * @response 422 scenario="validation error" {
     *   "message": "The email field is required.",
     *   "errors": {"email": ["The email field is required."]}
     * }
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (! Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        return response()->json(['message' => 'Invalid credentials'], 401);
        }

        /** @var User $user */
        // $user  = Auth::user();
        $user  = Auth::guard('web')->user();
        $token = $user->createToken('api-token')->accessToken;

        return response()->json([
            'data'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
            'token' => $token,
        ], 200);
    }

    /**
     * Logout the authenticated user.
     *
     * Revokes the current access token, ending the API session.
     *
     * @group Authentication
     * @authenticated
     *
     * @response 200 scenario="success" {"message": "Successfully logged out"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()?->token();

        if ($token) {
            $token->revoke();
        }

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
