<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('radiology_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->nullOnDelete();
            $table->foreignId('ordered_by')->constrained('users')->cascadeOnDelete();
            $table->string('exam_name');
            $table->string('exam_code');
            $table->string('modality'); // X-ray, CT, MRI, Ultrasound, etc.
            $table->string('body_part');
            $table->string('status')->default('ordered'); // ordered, scheduled, in_progress, completed, cancelled
            $table->dateTime('scheduled_datetime')->nullable();
            $table->timestamp('ordered_at')->useCurrent();
            $table->timestamp('exam_started_at')->nullable();
            $table->timestamp('exam_completed_at')->nullable();
            $table->timestamp('report_available_at')->nullable();
            $table->foreignId('radiologist_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('clinical_indication')->nullable();
            $table->text('contrast_used')->nullable();
            $table->json('images')->nullable(); // Array of image file paths
            $table->timestamps();

            $table->index(['patient_id', 'status']);
            $table->index(['modality', 'status']);
            $table->index(['scheduled_datetime']);
        });

        Schema::create('radiology_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radiology_exam_id')->constrained('radiology_exams')->cascadeOnDelete();
            $table->foreignId('radiologist_id')->constrained('users')->cascadeOnDelete();
            $table->text('findings');
            $table->text('impression');
            $table->string('status')->default('draft'); // draft, finalized, amended
            $table->timestamp('reported_at')->useCurrent();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();

            $table->index(['radiology_exam_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radiology_reports');
        Schema::dropIfExists('radiology_exams');
    }
};
