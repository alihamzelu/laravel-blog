<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;

use App\Models\RoleRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{



    public function index()
    {
        $roles = Role::where('name', 'author')->get();

        return view('role-request', compact('roles'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'requested_role' => 'required|in:author,editor',
            'message' => 'required|string|max:500',
        ]);

        $exists = RoleRequest::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have a pending request.');
        }

        RoleRequest::create([
            'user_id' => auth()->id(),
            'requested_role' => $request->requested_role,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your request has been sent successfully.');
    }
}
