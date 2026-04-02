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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('admission_id')->nullable()->constrained('patient_admissions')->nullOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->nullOnDelete();
            $table->string('bill_number')->unique();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->storedAs('total_amount - paid_amount');
            $table->string('status')->default('pending'); // pending, partially_paid, paid, written_off
            $table->string('payment_method')->nullable(); // cash, card, digital_wallet, insurance
            $table->string('insurance_provider')->nullable();
            $table->string('insurance_claim_id')->nullable();
            $table->boolean('insurance_approved')->nullable();
            $table->json('services')->nullable(); // Array of billed services
            $table->timestamp('billed_at')->useCurrent();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['patient_id', 'status']);
            $table->index(['bill_number']);
            $table->index(['status', 'due_date']);
        });

        Schema::create('billing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained('billing')->cascadeOnDelete();
            $table->string('service_type'); // consultation, lab_test, radiology, procedure, medication, room_charge
            $table->string('service_name');
            $table->string('service_code')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2)->storedAs('quantity * unit_price');
            $table->timestamp('service_date')->useCurrent();
            $table->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['bill_id', 'service_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_items');
        Schema::dropIfExists('billing');
    }
};
