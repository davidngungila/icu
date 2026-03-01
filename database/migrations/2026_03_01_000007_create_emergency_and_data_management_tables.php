<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emergency_states', function (Blueprint $table) {
            $table->id();
            $table->boolean('override_enabled')->default(false);
            $table->string('override_reason')->nullable();
            $table->timestamp('override_enabled_at')->nullable();

            $table->boolean('surge_mode_enabled')->default(false);
            $table->string('surge_level')->default('normal');
            $table->unsignedInteger('extra_capacity_beds')->default(0);
            $table->timestamp('surge_enabled_at')->nullable();

            $table->boolean('lockdown_enabled')->default(false);
            $table->string('lockdown_scope')->default('admin');
            $table->timestamp('lockdown_enabled_at')->nullable();
            $table->string('lockdown_reason')->nullable();

            $table->timestamps();
        });

        Schema::create('emergency_events', function (Blueprint $table) {
            $table->id();
            $table->timestamp('occurred_at')->useCurrent();
            $table->string('type');
            $table->string('status')->default('ok');
            $table->foreignId('actor_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['occurred_at']);
            $table->index(['type']);
        });

        Schema::create('backup_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('backup');
            $table->string('scope')->default('full');
            $table->string('status')->default('queued');
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->unsignedInteger('size_mb')->nullable();
            $table->string('storage')->default('local');
            $table->string('artifact_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['requested_at']);
            $table->index(['status']);
            $table->index(['type']);
        });

        Schema::create('export_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('dataset');
            $table->string('format')->default('csv');
            $table->string('status')->default('queued');
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->unsignedInteger('rows')->nullable();
            $table->string('artifact_path')->nullable();
            $table->text('notes')->nullable();
            $table->json('filters')->nullable();
            $table->timestamps();

            $table->index(['requested_at']);
            $table->index(['status']);
            $table->index(['dataset']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('export_jobs');
        Schema::dropIfExists('backup_jobs');
        Schema::dropIfExists('emergency_events');
        Schema::dropIfExists('emergency_states');
    }
};
