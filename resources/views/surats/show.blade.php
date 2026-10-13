@extends('layouts.app', ['title' => 'Pratinjau Surat'])
@section('content')
<div class="preview-toolbar no-print"><div><p class="eyebrow" style="margin-bottom:5px">PRATINJAU DOKUMEN</p><div class="preview-label"><span class="status-dot"></span> Surat siap ditinjau sebelum dicetak</div></div><div class="actions"><a class="btn btn-light" href="{{ route('surats.index') }}">← Kembali</a><button class="btn" type="button" onclick="window.print()">↧ Cetak / Simpan PDF</button></div></div>
<div class="paper-stage"><article class="paper">
    @php $bulanIndonesia = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; $tanggalSurat = $surat->letter_date; @endphp
    <div class="paper-topline"></div>
    <div class="paper-date">{{ $tanggalSurat->format('d') }} {{ $bulanIndonesia[(int)$tanggalSurat->format('n')] }} {{ $tanggalSurat->format('Y') }}</div>
    <div class="paper-recipient">Kepada Yth.<br><strong>Bagian HRD {{ $surat->company_name }}</strong><br><address>{!! nl2br(e($surat->company_address)) !!}</address></div>
    <div class="paper-subject"><span>Perihal:</span><span>Lamaran Pekerjaan sebagai {{ $surat->position }}</span></div>
    <p>Dengan hormat,</p>
    <p>Berdasarkan informasi lowongan pekerjaan yang tersedia, saya bermaksud mengajukan lamaran untuk posisi <strong>{{ $surat->position }}</strong> di <strong>{{ $surat->company_name }}</strong>.</p>
    <p>Berikut data singkat diri saya:</p>
    <table class="paper-person"><tbody>
        <tr><td>Nama</td><td>:</td><td><strong>{{ $surat->applicant_name }}</strong></td></tr>
        <tr><td>Alamat</td><td>:</td><td>{!! nl2br(e($surat->applicant_address)) !!}</td></tr>
        <tr><td>Nomor HP</td><td>:</td><td>{{ $surat->applicant_phone }}</td></tr>
        <tr><td>Email</td><td>:</td><td>{{ $surat->applicant_email }}</td></tr>
        <tr><td>Pendidikan terakhir</td><td>:</td><td>{{ $surat->education }}</td></tr>
    </tbody></table>
    <p>Saya memiliki keahlian {{ $surat->skills }}. Saya siap belajar, bekerja dengan penuh tanggung jawab, dan berkontribusi secara positif bagi perusahaan.</p>
    <p>Sebagai bahan pertimbangan, saya bersedia melengkapi dokumen pendukung yang diperlukan. Besar harapan saya untuk memperoleh kesempatan mengikuti tahapan seleksi dan wawancara.</p>
    <p>Demikian surat lamaran ini saya sampaikan. Atas perhatian Bapak/Ibu, saya mengucapkan terima kasih.</p>
    <div class="paper-signature"><p>Hormat saya,</p>@if($surat->signature_path)<img class="signature-image" src="{{ route('surats.attachment', [$surat, 'signature']) }}" alt="Tanda tangan {{ $surat->applicant_name }}">@else<div class="signature-space"></div>@endif<p><strong>{{ $surat->applicant_name }}</strong></p></div>
    <div class="paper-footer"><span>Surat lamaran kerja</span><span>Disiapkan dengan SuratKu</span></div>
</article></div>
<div class="card attachment-card no-print"><div class="section-head"><div><h2 class="section-title">Dokumen pendukung</h2><p class="section-desc">Lampiran tersimpan secara privat untuk akunmu.</p></div><span class="secure-pill">🔒 Privat</span></div><div class="attachment-list">
@php $files = ['cv'=>'Curriculum Vitae (CV)','ijazah'=>'Ijazah','sertifikat'=>'Sertifikat','portofolio'=>'Portofolio']; $hasFiles = false; @endphp
@foreach($files as $type=>$label)
    @if($surat->{$type . '_path'}) @php $hasFiles = true; @endphp<div class="attachment-row"><div class="attachment-file-icon">▤</div><div class="attachment-meta"><strong>{{ $label }}</strong><small>File tersimpan di akunmu</small></div><a class="btn btn-soft" href="{{ route('surats.attachment', [$surat, $type]) }}">Unduh file ↓</a></div>@endif
@endforeach
@if(!$hasFiles)<p class="attachment-empty">Belum ada CV, ijazah, sertifikat, atau portofolio yang dilampirkan pada surat ini.</p>@endif
</div></div>
<p class="preview-note no-print">Tip: pilih “Save as PDF” pada jendela cetak. Tanda tangan yang terlihat pada kertas ikut tercetak ke PDF.</p>
<style>.signature-image{display:block;max-width:180px;max-height:72px;object-fit:contain;object-position:left center;margin:4px 0 2px}.attachment-card{margin-top:22px;overflow:hidden}.attachment-list{padding:8px 22px 18px}.attachment-row{display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid #edf0f6}.attachment-row:last-of-type{border-bottom:0}.attachment-file-icon{width:38px;height:38px;display:grid;place-items:center;border-radius:11px;background:#edf2ff;color:#315cf5;font-size:18px}.attachment-meta{flex:1;min-width:0}.attachment-meta strong{display:block;font-size:12px;color:#2b3955}.attachment-meta small{font-size:10px;color:#8c97ab}.attachment-empty{padding:12px;color:#8b96aa;font-size:12px}@media print{.attachment-card{display:none!important}.signature-image{max-width:150px;max-height:58px}}</style>
@endsection
