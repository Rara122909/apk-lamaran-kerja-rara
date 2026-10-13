<?php

namespace App\Http\Controllers;

use App\Models\SuratLamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SuratLamaranController extends Controller
{
    public function index()
    {
        $surats = SuratLamaran::where('user_id', auth()->id())->latest()->paginate(8);
        return view('surats.index', compact('surats'));
    }

    public function create()
    {
        return view('surats.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'applicant_name' => ['required', 'string', 'max:120'],
            'applicant_address' => ['required', 'string', 'max:1000'],
            'applicant_phone' => ['required', 'string', 'max:30'],
            'applicant_email' => ['required', 'email', 'max:255'],
            'education' => ['required', 'string', 'max:120'],
            'skills' => ['required', 'string', 'max:1000'],
            'company_name' => ['required', 'string', 'max:180'],
            'company_address' => ['required', 'string', 'max:1000'],
            'position' => ['required', 'string', 'max:150'],
            'letter_date' => ['required', 'date'],
            'signature' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'signature_data' => ['nullable', 'string', 'max:1500000'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'ijazah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'sertifikat' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'portofolio' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ], [
            'signature.max' => 'Ukuran gambar tanda tangan maksimal 2 MB.',
            '*.max' => 'Ukuran setiap dokumen maksimal 5 MB.',
        ]);

        $userId = auth()->id();
        $folder = 'suratku/' . $userId;
        $paths = [];

        // Dokumen disimpan pada disk local/private, bukan folder public.
        foreach (['cv', 'ijazah', 'sertifikat', 'portofolio'] as $field) {
            if ($request->hasFile($field)) {
                $paths[$field . '_path'] = $request->file($field)->store($folder, 'local');
            }
        }

        if ($request->hasFile('signature')) {
            $paths['signature_path'] = $request->file('signature')->store($folder, 'local');
        } elseif (!empty($data['signature_data'])) {
            $signatureData = $data['signature_data'];
            if (!preg_match('/^data:image\/png;base64,([A-Za-z0-9+\/=]+)$/', $signatureData, $matches)) {
                throw ValidationException::withMessages(['signature_data' => 'Tanda tangan digital tidak valid. Silakan gambar ulang.']);
            }
            $binary = base64_decode($matches[1], true);
            if ($binary === false || strlen($binary) > 1024 * 1024) {
                throw ValidationException::withMessages(['signature_data' => 'Gambar tanda tangan terlalu besar atau tidak valid.']);
            }
            $path = $folder . '/signature-' . uniqid() . '.png';
            Storage::disk('local')->put($path, $binary);
            $paths['signature_path'] = $path;
        }

        unset($data['signature'], $data['signature_data']);
        $surat = auth()->user()->suratLamarans()->create(array_merge($data, $paths));

        return redirect()->route('surats.show', $surat)->with('success', 'Surat lamaran berhasil dibuat. Lampiran disimpan secara privat.');
    }

    public function show(SuratLamaran $surat)
    {
        abort_unless($surat->user_id === auth()->id(), 404);
        return view('surats.show', compact('surat'));
    }

    public function attachment(SuratLamaran $surat, string $type)
    {
        abort_unless($surat->user_id === auth()->id(), 404);
        $fields = [
            'signature' => ['signature_path', 'inline'],
            'cv' => ['cv_path', 'download'],
            'ijazah' => ['ijazah_path', 'download'],
            'sertifikat' => ['sertifikat_path', 'download'],
            'portofolio' => ['portofolio_path', 'download'],
        ];
        abort_unless(isset($fields[$type]), 404);
        [$column, $mode] = $fields[$type];
        $path = $surat->{$column};
        abort_unless($path && Storage::disk('local')->exists($path), 404);

        if ($mode === 'inline') {
            return response()->file(Storage::disk('local')->path($path), [
                'Content-Type' => Storage::disk('local')->mimeType($path) ?: 'application/octet-stream',
                'X-Content-Type-Options' => 'nosniff',
                'Cache-Control' => 'private, no-store',
            ]);
        }

        return Storage::disk('local')->download($path, $type . '-' . $surat->id . '.' . pathinfo($path, PATHINFO_EXTENSION));
    }

    public function destroy(SuratLamaran $surat)
    {
        abort_unless($surat->user_id === auth()->id(), 404);
        foreach (['signature_path', 'cv_path', 'ijazah_path', 'sertifikat_path', 'portofolio_path'] as $column) {
            if ($surat->{$column}) {
                Storage::disk('local')->delete($surat->{$column});
            }
        }
        $surat->delete();
        return redirect()->route('surats.index')->with('success', 'Surat dan lampirannya berhasil dihapus.');
    }
}
