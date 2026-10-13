<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratLamaran extends Model
{
    protected $fillable = [
        'user_id', 'applicant_name', 'applicant_address', 'applicant_phone',
        'applicant_email', 'education', 'skills', 'company_name',
        'company_address', 'position', 'letter_date', 'signature_path',
        'cv_path', 'ijazah_path', 'sertifikat_path', 'portofolio_path',
    ];

    protected function casts(): array
    {
        return ['letter_date' => 'date'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
