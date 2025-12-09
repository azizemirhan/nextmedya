<section>
    <form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="update_password_current_password">Mevcut Şifre</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
        </div>

        <div class="form-group">
            <label for="update_password_password">Yeni Şifre</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Yeni Şifreyi Onayla</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary mt-3">Kaydet</button>

            @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >Kaydedildi</p>
            @endif
        </div>
    </form>
</section>
