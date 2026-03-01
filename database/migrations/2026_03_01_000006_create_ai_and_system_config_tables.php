<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_models', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('provider')->default('local');
            $table->string('model_key')->nullable();
            $table->string('status')->default('active');

            $table->unsignedTinyInteger('risk_level')->default(2);
            $table->boolean('requires_human_review')->default(true);

            $table->decimal('temperature', 4, 2)->default(0.20);
            $table->unsignedInteger('max_tokens')->default(1024);

            $table->json('guardrails')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['provider']);
            $table->index(['status']);
        });

        Schema::create('report_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('category')->default('Operations');
            $table->string('status')->default('active');
            $table->text('description')->nullable();
            $table->json('definition')->nullable();
            $table->timestamps();

            $table->index(['category']);
            $table->index(['status']);
        });

        Schema::create('report_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_template_id')->constrained('report_templates')->cascadeOnDelete();
            $table->string('status')->default('queued');
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->unsignedInteger('rows')->nullable();
            $table->string('output_format')->default('csv');
            $table->json('filters')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['requested_at']);
            $table->index(['status']);
        });

        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name')->default('ICU Monitoring Solutions');
            $table->string('timezone')->default('Africa/Dar_es_Salaam');
            $table->string('locale')->default('en');
            $table->boolean('maintenance_mode')->default(false);
            $table->string('data_retention_policy')->default('365d');
            $table->boolean('alerts_enabled')->default(true);
            $table->string('default_severity')->default('medium');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('integration_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('type');
            $table->boolean('enabled')->default(false);
            $table->string('status')->default('disconnected');
            $table->string('endpoint_url')->nullable();
            $table->json('credentials')->nullable();
            $table->json('config')->nullable();
            $table->timestamp('last_sync_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['type']);
            $table->index(['enabled']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('integration_settings');
        Schema::dropIfExists('general_settings');
        Schema::dropIfExists('report_runs');
        Schema::dropIfExists('report_templates');
        Schema::dropIfExists('ai_models');
    }
};
