<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display a list of users
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for editing a user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the user's data (role)
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        // Prevent admin from demoting themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove a user from storage
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
