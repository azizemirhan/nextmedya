<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user.profile-edit');
    }

    public function getchangePassword(): View
    {
        return view('user.change-password');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mevcut şifreniz doğru değil.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Şifreniz başarıyla güncellendi.');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'username' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|in:Erkek,Kadın,SöylemeyiTercihEtmiyorum',
            'bio' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->bio = $request->bio;
        $user->save();

        return back()->with('success', 'Profiliniz başarıyla güncellendi.');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Max 2MB
        ]);

        $user = auth()->user();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Eski fotoğrafı sil
            if ($user->image && file_exists(public_path('uploads/avatars/' . $user->image))) {
                unlink(public_path('uploads/avatars/' . $user->image));
            }

            // Dosya adı oluştur
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // uploads/avatars dizinine taşı
            $file->move(public_path('uploads/avatars'), $filename);

            // Kullanıcı kaydını güncelle
            $user->image = $filename;
            $user->save();
        }

        return back()->with('success', 'Profil fotoğrafınız başarıyla güncellendi.');
    }


    /**
     * Delete the user's account.
     */
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
