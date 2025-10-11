<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profil Bilgileri') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Hesabınızın profil bilgilerini ve e-posta adresini güncelleyin.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">{{ __('İsim') }}</label>
            <input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        </div>

        <div class="form-group">
            <label for="email">{{ __('E-posta') }}</label>
            <input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary mt-3">{{ __('Kaydet') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Kaydedildi.') }}</p>
            @endif
        </div>
    </form>
</section>
