<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('mrn')->unique();
            $table->string('full_name');
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('national_id')->nullable();
            $table->string('status')->default('admitted');
            $table->timestamps();

            $table->index(['status']);
        });

        Schema::create('patient_admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('ward_id')->nullable()->constrained('wards')->nullOnDelete();
            $table->foreignId('bed_id')->nullable()->constrained('beds')->nullOnDelete();
            $table->timestamp('admitted_at')->useCurrent();
            $table->timestamp('discharged_at')->nullable();
            $table->string('primary_diagnosis')->nullable();
            $table->string('attending_physician')->nullable();
            $table->string('status')->default('active');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['admitted_at']);
            $table->index(['status']);
        });

        Schema::create('patient_vitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->timestamp('measured_at')->useCurrent();
            $table->unsignedSmallInteger('hr')->nullable();
            $table->unsignedSmallInteger('spo2')->nullable();
            $table->unsignedSmallInteger('rr')->nullable();
            $table->decimal('temp_c', 4, 1)->nullable();
            $table->unsignedSmallInteger('sbp')->nullable();
            $table->unsignedSmallInteger('dbp')->nullable();
            $table->timestamps();

            $table->index(['measured_at']);
        });

        Schema::create('patient_waveforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->timestamp('captured_at')->useCurrent();
            $table->string('type')->default('ecg');
            $table->json('samples');
            $table->unsignedSmallInteger('sample_rate_hz')->default(50);
            $table->timestamps();

            $table->index(['captured_at']);
            $table->index(['type']);
        });

        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->timestamp('resulted_at')->useCurrent();
            $table->string('panel')->nullable();
            $table->string('test_code');
            $table->string('test_name');
            $table->string('value');
            $table->string('unit')->nullable();
            $table->string('flag')->nullable();
            $table->string('reference_range')->nullable();
            $table->timestamps();

            $table->index(['resulted_at']);
            $table->index(['test_code']);
        });

        Schema::create('medication_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->timestamp('ordered_at')->useCurrent();
            $table->string('drug_name');
            $table->string('dose')->nullable();
            $table->string('route')->nullable();
            $table->string('frequency')->nullable();
            $table->string('status')->default('active');
            $table->string('ordered_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['ordered_at']);
            $table->index(['status']);
        });

        Schema::create('ai_risk_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->timestamp('predicted_at')->useCurrent();
            $table->string('model')->default('icu-risk-v1');
            $table->unsignedTinyInteger('risk_score')->default(50);
            $table->string('risk_level')->default('medium');
            $table->json('top_factors')->nullable();
            $table->text('recommendation')->nullable();
            $table->timestamps();

            $table->index(['predicted_at']);
            $table->index(['risk_level']);
        });

        Schema::create('tele_icu_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients')->nullOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->nullable();
            $table->string('remote_site')->nullable();
            $table->string('clinician')->nullable();
            $table->string('status')->default('active');
            $table->string('link')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['started_at']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tele_icu_sessions');
        Schema::dropIfExists('ai_risk_predictions');
        Schema::dropIfExists('medication_orders');
        Schema::dropIfExists('lab_results');
        Schema::dropIfExists('patient_waveforms');
        Schema::dropIfExists('patient_vitals');
        Schema::dropIfExists('patient_admissions');
        Schema::dropIfExists('patients');
    }
};
