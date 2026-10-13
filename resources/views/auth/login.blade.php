@extends('layouts.app', ['title' => 'Masuk'])
@section('content')
<p class="eyebrow">SELAMAT DATANG KEMBALI</p>
<h2>Masuk ke akunmu</h2>
<p class="auth-sub">Lanjutkan menyiapkan surat lamaran kerjamu.</p>
<form method="POST" action="{{ route('login') }}">@csrf
    <div class="field"><label for="email">Alamat email</label><input class="control" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus autocomplete="email"></div>
    <div class="field"><label for="password">Kata sandi</label><input class="control" id="password" type="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password"></div>
    <div class="check-row"><label><input type="checkbox" name="remember" value="1"> Ingat saya</label><span>Jaga kerahasiaan kata sandi</span></div>
    <button class="btn auth-submit" type="submit">Masuk ke SuratKu &nbsp; →</button>
</form>
<p class="auth-switch">Belum terdaftar? <a href="{{ route('register') }}">Buat akun baru</a></p>
@endsection
