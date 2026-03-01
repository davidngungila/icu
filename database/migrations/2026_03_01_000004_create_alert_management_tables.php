<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('severity')->default('medium');
            $table->string('status')->default('open');

            $table->string('category')->nullable();
            $table->string('title');
            $table->text('message')->nullable();

            $table->foreignId('ward_id')->nullable()->constrained('wards')->nullOnDelete();
            $table->foreignId('bed_id')->nullable()->constrained('beds')->nullOnDelete();
            $table->foreignId('device_id')->nullable()->constrained('devices')->nullOnDelete();

            $table->timestamp('triggered_at')->useCurrent();
            $table->timestamp('acknowledged_at')->nullable();
            $table->foreignId('acknowledged_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['severity']);
            $table->index(['status']);
            $table->index(['triggered_at']);
        });

        Schema::create('alert_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alert_id')->constrained('alerts')->cascadeOnDelete();
            $table->timestamp('occurred_at')->useCurrent();
            $table->string('type');
            $table->string('actor_type')->nullable();
            $table->string('actor_id')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['occurred_at']);
            $table->index(['type']);
        });

        Schema::create('escalation_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('enabled')->default(true);

            $table->string('severity')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('ward_id')->nullable()->constrained('wards')->nullOnDelete();

            $table->unsignedInteger('ack_timeout_minutes')->default(5);
            $table->unsignedInteger('resolve_timeout_minutes')->default(30);

            $table->string('notify_channels')->default('dashboard,email');
            $table->string('notify_targets')->nullable();

            $table->unsignedTinyInteger('priority')->default(50);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['enabled']);
            $table->index(['priority']);
        });

        Schema::create('alarm_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('night_mode_enabled')->default(false);
            $table->time('night_mode_start')->nullable();
            $table->time('night_mode_end')->nullable();

            $table->string('audible_policy')->default('standard');
            $table->unsignedTinyInteger('volume_level')->default(70);
            $table->boolean('snooze_enabled')->default(true);
            $table->unsignedInteger('snooze_minutes')->default(5);

            $table->json('threshold_overrides')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alarm_settings');
        Schema::dropIfExists('escalation_rules');
        Schema::dropIfExists('alert_events');
        Schema::dropIfExists('alerts');
    }
};
