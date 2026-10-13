@extends('layouts.app', ['title' => 'Buat Surat Baru'])
@section('content')
<div class="page-head"><div><p class="eyebrow">SURAT BARU · LENGKAPI PROFIL</p><h1 class="page-title">Buat surat lamaran</h1><p class="page-subtitle">Isi data diri dan perusahaan, bubuhkan tanda tangan, lalu lampirkan dokumen pendukung. Semua file disimpan secara privat.</p></div></div>
<div class="form-layout">
<form method="POST" action="{{ route('surats.store') }}" enctype="multipart/form-data" class="card form-card" id="letterForm">@csrf
    <section class="form-section"><div class="form-section-heading"><div class="section-number">01</div><div><h2>Data diri pelamar</h2><p>Informasi kontak yang bisa dihubungi perekrut.</p></div></div>
        <div class="form-grid">
            <div class="field"><label for="applicant_name">Nama lengkap</label><input class="control" id="applicant_name" name="applicant_name" value="{{ old('applicant_name', auth()->user()->name) }}" placeholder="Nama sesuai identitas" required maxlength="120"></div>
            <div class="field"><label for="applicant_email">Alamat email</label><input class="control" id="applicant_email" type="email" name="applicant_email" value="{{ old('applicant_email', auth()->user()->email) }}" placeholder="nama@email.com" required></div>
            <div class="field"><label for="applicant_phone">Nomor HP aktif</label><input class="control" id="applicant_phone" name="applicant_phone" value="{{ old('applicant_phone') }}" placeholder="Contoh: 08xxxxxxxxxx" required maxlength="30"></div>
            <div class="field"><label for="education">Pendidikan terakhir</label><input class="control" id="education" name="education" value="{{ old('education') }}" placeholder="Contoh: SMK RPL" required maxlength="120"></div>
            <div class="field full"><label for="applicant_address">Alamat lengkap</label><textarea class="control" id="applicant_address" name="applicant_address" placeholder="Jalan, nomor, kelurahan, kota" required>{{ old('applicant_address') }}</textarea></div>
            <div class="field full"><label for="skills">Keahlian utama</label><textarea class="control" id="skills" name="skills" placeholder="Contoh: HTML, CSS, PHP, MySQL" required>{{ old('skills') }}</textarea></div>
        </div>
    </section>
    <section class="form-section"><div class="form-section-heading"><div class="section-number">02</div><div><h2>Informasi perusahaan</h2><p>Pastikan nama perusahaan dan posisi sesuai lowongan.</p></div></div>
        <div class="form-grid">
            <div class="field"><label for="company_name">Nama perusahaan</label><input class="control" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Nama perusahaan tujuan" required maxlength="180"></div>
            <div class="field"><label for="position">Posisi yang dilamar</label><input class="control" id="position" name="position" value="{{ old('position') }}" placeholder="Contoh: Programmer" required maxlength="150"></div>
            <div class="field full"><label for="company_address">Alamat perusahaan</label><textarea class="control" id="company_address" name="company_address" placeholder="Alamat kantor atau bagian HRD" required>{{ old('company_address') }}</textarea></div>
            <div class="field"><label for="letter_date">Tanggal surat</label><input class="control" type="date" id="letter_date" name="letter_date" value="{{ old('letter_date', now()->format('Y-m-d')) }}" required></div>
        </div>
    </section>
    <section class="form-section"><div class="form-section-heading"><div class="section-number">03</div><div><h2>Tanda tangan</h2><p>Gambar tanda tangan dengan mouse atau jari, atau unggah tanda tangan PNG/JPG.</p></div></div>
        <div class="signature-pad-wrap"><canvas id="signaturePad" width="760" height="220" aria-label="Area menggambar tanda tangan"></canvas><div class="signature-pad-footer"><span class="optional">Gunakan tanda tangan asli milikmu.</span><button type="button" class="btn btn-light" id="clearSignature">Hapus tanda tangan</button></div></div>
        <input type="hidden" name="signature_data" id="signatureData">
        <div class="field" style="margin-top:15px"><label for="signature">Atau unggah gambar tanda tangan <span class="optional">PNG/JPG · maks. 2 MB</span></label><input class="control file-control" type="file" id="signature" name="signature" accept="image/png,image/jpeg"><small class="field-help">Jika mengunggah gambar, file tersebut digunakan sebagai tanda tangan.</small></div>
    </section>
    <section class="form-section"><div class="form-section-heading"><div class="section-number">04</div><div><h2>Dokumen pendukung</h2><p>Opsional. Unggah dokumen yang ingin kamu siapkan bersama surat.</p></div></div>
        <div class="upload-grid">
            <div class="upload-box"><div class="upload-icon">▤</div><label for="cv">Curriculum Vitae (CV)</label><input class="control file-control" type="file" id="cv" name="cv" accept=".pdf,.doc,.docx"><small>PDF, DOC, DOCX · maks. 5 MB</small></div>
            <div class="upload-box"><div class="upload-icon">▣</div><label for="ijazah">Ijazah</label><input class="control file-control" type="file" id="ijazah" name="ijazah" accept=".pdf,.jpg,.jpeg,.png"><small>PDF atau gambar · maks. 5 MB</small></div>
            <div class="upload-box"><div class="upload-icon">✧</div><label for="sertifikat">Sertifikat</label><input class="control file-control" type="file" id="sertifikat" name="sertifikat" accept=".pdf,.jpg,.jpeg,.png"><small>PDF atau gambar · maks. 5 MB</small></div>
            <div class="upload-box"><div class="upload-icon">▧</div><label for="portofolio">Portofolio</label><input class="control file-control" type="file" id="portofolio" name="portofolio" accept=".pdf,.doc,.docx"><small>PDF, DOC, DOCX · maks. 5 MB</small></div>
        </div>
        <div class="privacy-note">🔒 Privasi: CV, ijazah, sertifikat, portofolio, dan tanda tangan disimpan di penyimpanan privat dan hanya bisa diakses melalui akun pemilik surat.</div>
    </section>
    <div class="form-actions"><a class="btn btn-light" href="{{ route('surats.index') }}">Batal</a><button class="btn" type="submit">Simpan &amp; lihat surat &nbsp; →</button></div>
</form>
<aside class="card helper-card"><div class="helper-icon">✦</div><h3>Siapkan berkas lamaran</h3><p>Suratmu akan terlihat lebih lengkap dengan dokumen pendukung yang sesuai.</p>
    <div class="helper-item"><span class="check-dot">✓</span><span><strong>Data akurat</strong><br>Pastikan kontak aktif dan nama sesuai identitas.</span></div>
    <div class="helper-item"><span class="check-dot">✓</span><span><strong>Tanda tangan</strong><br>Gambar tanda tangan di kotak atau unggah file gambar.</span></div>
    <div class="helper-item"><span class="check-dot">✓</span><span><strong>Dokumen jelas</strong><br>Pastikan hasil scan ijazah dan sertifikat mudah dibaca.</span></div>
    <div class="helper-item"><span class="check-dot">✓</span><span><strong>Periksa sebelum cetak</strong><br>Tinjau ejaan dan tata letak sebelum simpan PDF.</span></div>
</aside>
</div>
<style>
.signature-pad-wrap{border:1px solid #dce4f4;border-radius:14px;overflow:hidden;background:linear-gradient(#fff,#fbfcff)}#signaturePad{display:block;width:100%;height:180px;touch-action:none;cursor:crosshair} .signature-pad-footer{display:flex;align-items:center;justify-content:space-between;gap:10px;border-top:1px solid #edf0f6;padding:10px 12px}.upload-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:13px}.upload-box{border:1px solid #e6ebf4;border-radius:14px;padding:15px;background:#fcfdff;min-width:0}.upload-box label{display:block;font-size:12px;font-weight:800;color:#33415d;margin:5px 0 10px}.upload-icon{width:34px;height:34px;display:grid;place-items:center;border-radius:10px;background:#edf2ff;color:#315cf5;font-size:18px}.upload-box small,.field-help{display:block;color:#8b96aa;font-size:10px;margin-top:7px}.file-control{font-size:11px;padding:9px;background:#fff}.file-control::file-selector-button{border:0;border-radius:7px;padding:7px 9px;background:#edf2ff;color:#315cf5;font-size:10px;font-weight:800;margin-right:8px;cursor:pointer}@media(max-width:560px){.upload-grid{grid-template-columns:1fr}.signature-pad-footer{align-items:flex-start;flex-direction:column}}
</style>
<script>
(()=>{
 const canvas=document.getElementById('signaturePad'); if(!canvas)return;
 const ctx=canvas.getContext('2d'); let drawing=false,hasInk=false;
 ctx.strokeStyle='#142345';ctx.lineWidth=3.1;ctx.lineCap='round';ctx.lineJoin='round';
 function point(e){const r=canvas.getBoundingClientRect();return {x:(e.clientX-r.left)*(canvas.width/r.width),y:(e.clientY-r.top)*(canvas.height/r.height)}}
 canvas.addEventListener('pointerdown',e=>{drawing=true;hasInk=true;canvas.setPointerCapture(e.pointerId);const p=point(e);ctx.beginPath();ctx.moveTo(p.x,p.y);ctx.lineTo(p.x+0.1,p.y+0.1);ctx.stroke()});
 canvas.addEventListener('pointermove',e=>{if(!drawing)return;const p=point(e);ctx.lineTo(p.x,p.y);ctx.stroke()});
 ['pointerup','pointercancel','lostpointercapture'].forEach(ev=>canvas.addEventListener(ev,()=>drawing=false));
 document.getElementById('clearSignature').addEventListener('click',()=>{ctx.clearRect(0,0,canvas.width,canvas.height);hasInk=false;document.getElementById('signatureData').value=''});
 document.getElementById('letterForm').addEventListener('submit',()=>{document.getElementById('signatureData').value=hasInk?canvas.toDataURL('image/png'):''});
})();
</script>
@endsection
