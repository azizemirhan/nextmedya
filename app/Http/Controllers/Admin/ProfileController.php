<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    use ImageUploadTrait;

    public function edit()
    {
        $user = auth()->guard('admin')->user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->guard('admin')->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'image' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Resim yükleme işlemini gerçekleştirir ve dosya yolunu alır.
        $imagePath = $this->uploadImage($request, 'image', 'uploads/users', $user->image);

        $user->name = $request->name;
        $user->email = $request->email;

        // Eğer yeni bir resim yüklendiyse, kullanıcının resim alanını güncelle.
        if ($imagePath !== null) {
            $user->image = $imagePath;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil başarıyla güncellendi.');
    }
}
