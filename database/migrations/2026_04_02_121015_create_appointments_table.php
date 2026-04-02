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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('appointment_datetime');
            $table->string('status')->default('scheduled'); // scheduled, confirmed, cancelled, completed, no_show
            $table->string('appointment_type')->default('consultation'); // consultation, follow_up, emergency
            $table->text('reason_for_visit')->nullable();
            $table->text('notes')->nullable();
            $table->string('qr_code')->nullable(); // For seamless registration
            $table->boolean('reminder_sent')->default(false);
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['appointment_datetime']);
            $table->index(['status']);
            $table->index(['doctor_id', 'appointment_datetime']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
