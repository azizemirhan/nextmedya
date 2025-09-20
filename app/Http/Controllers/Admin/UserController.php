<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    use ImageUploadTrait;

    // <-- Trait'i sınıfa dahil et

    // ... index, create metodları aynı kalabilir ...
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return User::select('id', 'name')->orderBy('name')->get();
        }
        $users = User::with('roles')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'max:2048'], // 2MB max
            'roles' => ['nullable', 'array'],
            'profession' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'socials' => ['nullable', 'array'],
            'notes' => ['nullable', 'string'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'tum-yuklemeler/users');
        $validatedData['password'] = Hash::make($request->password);
        $validatedData['is_admin'] = $request->has('is_admin') ? 1 : 0;
        // Resim yükleme
        $validatedData['image'] = $imagePath; // Trait'ten dönen yolu ata


        $user = User::create($validatedData);
        $user->roles()->sync($request->roles ?? []);

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'max:2048'],
            'roles' => ['nullable', 'array'],
            'profession' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'socials' => ['nullable', 'array'],
            'notes' => ['nullable', 'string'],
        ]);

        // --- DÜZELTME BAŞLANGICI ---
        if (empty($validatedData['password'])) {
            // Eğer şifre alanı boş gönderildiyse, güncelleme dizisinden tamamen çıkar.
            // Böylece veritabanındaki mevcut şifreye dokunulmaz.
            unset($validatedData['password']);
        } else {
            // Eğer yeni bir şifre girildiyse, hash'le.
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        // --- DÜZELTME SONU ---

        $validatedData['is_admin'] = $request->has('is_admin') ? 1 : 0;

        // Trait'i kullanarak resmi yükle ve yolunu al
        // Trait'iniz eski resmi silme işini de kendi içinde hallediyor
        $validatedData['image'] = $this->uploadImage($request, 'image', 'uploads/users', $user->image);

        $user->update($validatedData);
        $user->roles()->sync($request->roles ?? []);

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    // ... destroy metodu aynı kalabilir ...
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id || $user->id === 1) {
            return back()->with('error', 'Bu kullanıcı silinemez.');
        }

        // Kullanıcıyı silmeden önce ilişkili profil resmini de sunucudan sil
        $this->deleteImage($user->image);

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }
}
