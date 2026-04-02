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
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->nullOnDelete();
            $table->foreignId('ordered_by')->constrained('users')->cascadeOnDelete();
            $table->string('procedure_name');
            $table->string('procedure_code');
            $table->string('category'); // surgical, diagnostic, therapeutic
            $table->string('status')->default('scheduled'); // scheduled, in_progress, completed, cancelled, postponed
            $table->dateTime('scheduled_datetime');
            $table->string('or_room')->nullable();
            $table->integer('estimated_duration_minutes')->nullable();
            $table->integer('actual_duration_minutes')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('surgical_team')->nullable(); // Array of staff roles and user IDs
            $table->foreignId('surgeon_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('anesthesiologist_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('pre_op_diagnosis')->nullable();
            $table->text('post_op_diagnosis')->nullable();
            $table->text('procedure_notes')->nullable();
            $table->json('checklists')->nullable(); // Pre-op, intra-op, post-op checklists
            $table->timestamps();

            $table->index(['patient_id', 'status']);
            $table->index(['scheduled_datetime']);
            $table->index(['or_room', 'scheduled_datetime']);
        });

        Schema::create('operating_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->string('name');
            $table->string('type'); // general, cardiac, neuro, orthopedic, etc.
            $table->string('status')->default('available'); // available, occupied, maintenance, cleaning
            $table->json('equipment')->nullable(); // List of available equipment
            $table->integer('capacity')->default(1);
            $table->timestamps();

            $table->unique(['room_number']);
            $table->index(['status']);
        });

        Schema::create('procedure_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procedure_id')->constrained('procedures')->cascadeOnDelete();
            $table->foreignId('or_room_id')->constrained('operating_rooms')->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status')->default('scheduled'); // scheduled, confirmed, in_progress, completed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['or_room_id', 'start_time']);
            $table->index(['status', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedure_schedules');
        Schema::dropIfExists('operating_rooms');
        Schema::dropIfExists('procedures');
    }
};
