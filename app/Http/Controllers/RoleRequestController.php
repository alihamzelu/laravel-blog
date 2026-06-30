<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\RoleRequest;

class RoleRequestController extends Controller
{
    public function index()
    {
        $roles = Role::whereIn('name', ['author', 'editor'])->get();

        return view('role-request', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        abort_unless($user, 403);

        $request->validate([
            'requested_role' => 'required|in:author,editor',
            'message' => 'required|string|max:500',
        ]);

        $exists = RoleRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have a pending request.');
        }

        RoleRequest::create([
            'user_id' => $user->id,
            'requested_role' => $request->requested_role,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your request has been sent successfully.');
    }
}