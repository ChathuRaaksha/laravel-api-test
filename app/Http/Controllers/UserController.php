<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;
use App\Mail\AdminNotificationMail;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required|string|min:3|max:50',
            'role' => 'nullable|in:user,manager,administrator', // Validate role if provided
        ]);

        // Assign default role if none is provided
        $validated['role'] = $validated['role'] ?? 'user';

        // Create the user
        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'name' => $validated['name'],
            'role' => $validated['role'],
        ]);

        // Send emails
        Mail::to($user->email)->send(new UserCreatedMail($user)); // Email to the user
        Mail::to(env('ADMIN_EMAIL'))->send(new AdminNotificationMail($user)); // Email to the admin

        // Return the newly created user details
        return response()->json($user->only(['id', 'email', 'name', 'role', 'created_at']), 201);
    }

    /**
     * List users with optional search and pagination.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Apply search filter
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
        }

        // Apply sorting
        $sortBy = $request->get('sortBy', 'created_at');
        $query->orderBy($sortBy, 'asc');

        // Retrieve paginated users
        $users = $query->paginate(10);

        // Add additional fields
        $users->getCollection()->transform(function ($user) {
            $currentUser = auth()->user(); // Ensure user is authenticated

            return [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'role' => $user->role,
                'created_at' => $user->created_at->toIso8601String(),
                'orders_count' => $user->orders()->count(),
                'can_edit' => $this->canEdit($currentUser, $user),
            ];
        });

        return response()->json([
            'page' => $users->currentPage(),
            'users' => $users->items(),
        ]);
    }

    /**
     * Determine if the current user can edit the given user.
     *
     * @param User|null $currentUser
     * @param User $user
     * @return bool
     */
    private function canEdit($currentUser, $user)
    {
        // If no current user, return false
        if (!$currentUser) {
            return false;
        }

        // Check permissions based on role
        if ($currentUser->role === 'administrator') {
            return true; // Administrators can edit any user
        }

        if ($currentUser->role === 'manager' && $user->role === 'user') {
            return true; // Managers can edit users with the "user" role
        }

        return $currentUser->id === $user->id; // Users can only edit themselves
    }
}
