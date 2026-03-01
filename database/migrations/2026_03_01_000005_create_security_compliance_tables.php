<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_settings', function (Blueprint $table) {
            $table->id();

            $table->boolean('mfa_required_for_admin')->default(true);
            $table->boolean('ip_allowlist_enabled')->default(false);
            $table->string('ip_allowlist')->nullable();

            $table->unsignedInteger('session_timeout_minutes')->default(60);
            $table->unsignedInteger('max_failed_logins_per_hour')->default(10);

            $table->boolean('encryption_at_rest')->default(true);
            $table->boolean('encryption_in_transit')->default(true);

            $table->boolean('audit_logging_enabled')->default(true);
            $table->unsignedInteger('audit_retention_days')->default(365);

            $table->string('password_policy')->default('strong');

            $table->timestamps();
        });

        Schema::create('compliance_controls', function (Blueprint $table) {
            $table->id();
            $table->string('framework')->default('PDPA/TMDA');
            $table->string('control_code');
            $table->string('title');
            $table->text('description')->nullable();

            $table->string('status')->default('pass');
            $table->boolean('enabled')->default(true);

            $table->timestamp('last_checked_at')->nullable();
            $table->string('owner')->nullable();
            $table->string('evidence_link')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->unique(['framework', 'control_code']);
            $table->index(['status']);
        });

        Schema::create('privacy_controls', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('enabled')->default(true);
            $table->string('mode')->default('standard');
            $table->json('config')->nullable();
            $table->timestamps();
        });

        Schema::create('privacy_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_type');
            $table->string('subject_identifier');
            $table->string('status')->default('open');
            $table->text('notes')->nullable();
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('handled_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['requested_at']);
            $table->index(['status']);
            $table->index(['request_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privacy_requests');
        Schema::dropIfExists('privacy_controls');
        Schema::dropIfExists('compliance_controls');
        Schema::dropIfExists('security_settings');
    }
};
