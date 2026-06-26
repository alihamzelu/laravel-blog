<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
        ]);

        $profileData = [
            'bio'=> $request->bio,
            'job'=> $request->job,
        ];

        if ($request->hasFile('avatar')) {
        
            if($user->profile?->avatar){
                Storage::disk('public')->delete($user->profile->avatar);
            }

            $profileData['avatar'] = $request
                ->file('avatar')
                ->store('avatars','public');
        
        }


        $user->profile()->updateOrCreate(
            ['user_id'=> $user->id],
            $profileData
        );


        return back()->with('status', 'profile-updated');



    }


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}