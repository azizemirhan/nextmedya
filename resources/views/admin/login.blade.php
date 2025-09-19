<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
</head>

<body>
    <h1>Giriş Yap</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div>
            <label for="email">E-posta</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <label for="password">Parola</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Giriş Yap</button>
        </div>
    </form>
</body>

</html>
