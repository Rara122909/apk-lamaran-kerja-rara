@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
<div class="page-head"><div><p class="eyebrow">RINGKASAN AKTIVITAS</p><h1 class="page-title">Halo, {{ explode(' ', trim(auth()->user()->name))[0] }}! <span style="font-size:26px">✦</span></h1><p class="page-subtitle">Satu langkah kecil hari ini bisa membuka peluang karier baru. Siap menulis surat berikutnya?</p></div><a class="btn" href="{{ route('surats.create') }}"><span style="font-size:17px">＋</span> Buat Surat Baru</a></div>
<div class="stats-grid">
    <div class="card stat-card"><div class="stat-icon">▤</div><div><div class="stat-label">Total surat dibuat</div><div class="stat-value">{{ $surats->total() }}</div><div class="stat-note">Tersimpan di akunmu</div></div></div>
    <div class="card stat-card"><div class="stat-icon mint">✧</div><div><div class="stat-label">Siap dikirim</div><div class="stat-value">{{ $surats->total() }}</div><div class="stat-note">Bisa ditinjau dan dicetak</div></div></div>
    <div class="card stat-card"><div class="stat-icon violet">⌁</div><div><div class="stat-label">Privasi akun</div><div class="stat-value" style="font-size:20px">Terlindungi</div><div class="stat-note">Surat hanya terlihat oleh pemiliknya</div></div></div>
</div>
<div class="card section-card">
    <div class="section-head"><div><h2 class="section-title">Surat lamaran kamu</h2><p class="section-desc">Kelola surat yang pernah kamu buat di SuratKu.</p></div><a class="btn btn-soft" href="{{ route('surats.create') }}">＋ Surat baru</a></div>
    @if($surats->count())
        <div class="table-wrap"><table><thead><tr><th>Perusahaan & posisi</th><th>Tanggal surat</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
        @foreach($surats as $surat)
            <tr><td><div class="company-cell"><div class="company-mark">{{ mb_strtoupper(mb_substr($surat->company_name,0,1)) }}</div><div><div class="company-name">{{ $surat->company_name }}</div><div class="company-position">{{ $surat->position }}</div></div></div></td><td><span class="date-chip">{{ $surat->letter_date->format('d/m/Y') }}</span></td><td><span style="color:#0c9670;background:#e9fbf4;border-radius:20px;padding:6px 9px;font-weight:800;font-size:10px">● Tersimpan</span></td><td><div class="actions"><a class="btn btn-soft" href="{{ route('surats.show', $surat) }}">Lihat surat ↗</a><form method="POST" action="{{ route('surats.destroy', $surat) }}" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">@csrf @method('DELETE')<button class="btn btn-danger" type="submit" aria-label="Hapus surat">Hapus</button></form></div></td></tr>
        @endforeach
        </tbody></table></div>
        @if($surats->hasPages())<div class="pagination">{{ $surats->links() }}</div>@endif
    @else
        <div class="empty-state"><div class="empty-illustration">📄</div><h3>Belum ada surat lamaran</h3><p>Mulai dari mengisi data diri dan perusahaan. Surat yang kamu buat akan tersimpan di sini dan bisa dibuka lagi kapan pun.</p><a class="btn" href="{{ route('surats.create') }}">Buat surat pertamamu &nbsp; →</a></div>
    @endif
</div>
@endsection
