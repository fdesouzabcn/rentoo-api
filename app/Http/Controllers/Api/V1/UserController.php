<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * List all users.
     *
     * Returns a list of all registered users. Only accessible by admins.
     *
     * @group Users
     * @authenticated
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": "uuid-here",
     *       "name": "Joan Puig",
     *       "email": "joan@rentoo.com",
     *       "dni": "12345678A",
     *       "phone": "600111222",
     *       "city": "Barcelona",
     *       "province": "Barcelona",
     *       "roles": ["User"],
     *       "created_at": "2026-02-20T10:00:00.000000Z",
     *       "updated_at": "2026-02-20T10:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function index(Request $request): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        if (! $authUser->hasRole('Admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $users = User::with('roles')->get();

        return response()->json(['data' => UserResource::collection($users)], 200);
    }

    /**
     * Show a specific user.
     *
     * Returns the details of a user. Admins can view any user.
     * Regular users can only view their own profile.
     *
     * @group Users
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the user. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @response 200 scenario="success" {
     *   "data": {
     *     "id": "uuid-here",
     *     "name": "Joan Puig",
     *     "email": "joan@rentoo.com",
     *     "dni": "12345678A",
     *     "phone": "600111222",
     *     "city": "Barcelona",
     *     "province": "Barcelona",
     *     "roles": ["User"],
     *     "created_at": "2026-02-20T10:00:00.000000Z",
     *     "updated_at": "2026-02-20T10:00:00.000000Z"
     *   }
     * }
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "User not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function show(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $user = User::with('roles')->find($uuid);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $authUser->id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json(['data' => new UserResource($user)], 200);
    }

    /**
     * Delete a user (soft delete).
     *
     * Soft deletes a user account. The record is preserved in the database
     * with a deleted_at timestamp but will no longer appear in normal queries.
     * Admins can delete any user. Regular users can only delete their own account.
     *
     * @group Users
     * @authenticated
     *
     * @urlParam uuid string required The UUID of the user. Example: 9d4e7c8b-a5f2-4e1d-8c3b-2f7e4a9d1c5e
     *
     * @response 204 scenario="success"
     * @response 403 scenario="forbidden" {"message": "Forbidden"}
     * @response 404 scenario="not found" {"message": "User not found"}
     * @response 401 scenario="unauthenticated" {"message": "Unauthenticated."}
     */
    public function destroy(Request $request, string $uuid): JsonResponse
    {
        /** @var User $authUser */
        $authUser = $request->user();

        $user = User::find($uuid);

        if (! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (! $authUser->hasRole('Admin') && $authUser->id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $user->delete();

        return response()->json(null, 204);
    }
}
