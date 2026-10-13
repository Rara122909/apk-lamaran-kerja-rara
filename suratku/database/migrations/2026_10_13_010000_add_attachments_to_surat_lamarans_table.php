<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_lamarans', function (Blueprint $table) {
            $table->string('signature_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('ijazah_path')->nullable();
            $table->string('sertifikat_path')->nullable();
            $table->string('portofolio_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('surat_lamarans', function (Blueprint $table) {
            $table->dropColumn([
                'signature_path', 'cv_path', 'ijazah_path',
                'sertifikat_path', 'portofolio_path',
            ]);
        });
    }
};
