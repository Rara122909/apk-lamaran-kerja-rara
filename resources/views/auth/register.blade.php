@extends('layouts.app', ['title' => 'Daftar'])
@section('content')
<p class="eyebrow">MULAI PERJALANANMU</p>
<h2>Buat akun gratis</h2>
<p class="auth-sub">Simpan surat lamaranmu dengan aman di satu tempat.</p>
<form method="POST" action="{{ route('register') }}">@csrf
    <div class="field"><label for="name">Nama lengkap</label><input class="control" id="name" name="name" value="{{ old('name') }}" placeholder="Nama sesuai identitas" required maxlength="100" autocomplete="name"></div>
    <div class="field"><label for="email">Alamat email</label><input class="control" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email"></div>
    <div class="field"><label for="password">Kata sandi</label><input class="control" id="password" type="password" name="password" placeholder="Minimal 8 karakter" required autocomplete="new-password"></div>
    <div class="field"><label for="password_confirmation">Konfirmasi kata sandi</label><input class="control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi kata sandi" required autocomplete="new-password"></div>
    <button class="btn auth-submit" type="submit">Buat Akun SuratKu &nbsp; →</button>
</form>
<p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
@endsection
