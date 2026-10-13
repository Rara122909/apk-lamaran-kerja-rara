<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_lamarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('applicant_name', 120);
            $table->text('applicant_address');
            $table->string('applicant_phone', 30);
            $table->string('applicant_email');
            $table->string('education', 120);
            $table->text('skills');
            $table->string('company_name', 180);
            $table->text('company_address');
            $table->string('position', 150);
            $table->date('letter_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_lamarans');
    }
};
