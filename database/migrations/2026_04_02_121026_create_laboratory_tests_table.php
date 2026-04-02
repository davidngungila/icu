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
        // Only create laboratory_tests if it doesn't exist
        if (!Schema::hasTable('laboratory_tests')) {
            Schema::create('laboratory_tests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
                $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
                $table->foreignId('appointment_id')->nullable()->constrained('appointments')->nullOnDelete();
                $table->foreignId('ordered_by')->constrained('users')->cascadeOnDelete();
                $table->string('test_name');
                $table->string('test_code');
                $table->string('category'); // hematology, biochemistry, microbiology, etc.
                $table->string('status')->default('ordered'); // ordered, sample_collected, in_progress, completed, cancelled
                $table->text('specimen_type'); // blood, urine, swab, etc.
                $table->timestamp('ordered_at')->useCurrent();
                $table->timestamp('sample_collected_at')->nullable();
                $table->timestamp('result_available_at')->nullable();
                $table->timestamp('verified_at')->nullable();
                $table->foreignId('collected_by')->nullable()->constrained('users')->nullOnDelete();
                $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
                $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
                $table->text('clinical_notes')->nullable();
                $table->timestamps();

                $table->index(['patient_id', 'status']);
                $table->index(['test_code', 'status']);
                $table->index(['ordered_at']);
            });
        }

        // Only create lab_results if it doesn't exist
        if (!Schema::hasTable('lab_results')) {
            Schema::create('lab_results', function (Blueprint $table) {
                $table->id();
                $table->foreignId('lab_test_id')->constrained('laboratory_tests')->cascadeOnDelete();
                $table->string('parameter_name');
                $table->string('parameter_code')->nullable();
                $table->decimal('value', 10, 3)->nullable();
                $table->string('value_text')->nullable(); // for qualitative results
                $table->string('unit')->nullable();
                $table->string('reference_range')->nullable();
                $table->string('flag')->nullable(); // H, L, HH, LL, ABNORMAL
                $table->text('notes')->nullable();
                $table->timestamps();

                $table->index(['lab_test_id', 'parameter_name']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_results');
        Schema::dropIfExists('laboratory_tests');
    }
};
