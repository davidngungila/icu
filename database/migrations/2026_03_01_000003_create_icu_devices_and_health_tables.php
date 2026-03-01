<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
            $table->string('code');
            $table->timestamps();
            $table->unique(['ward_id', 'code']);
        });

        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->constrained('wards')->cascadeOnDelete();
            $table->foreignId('bed_id')->nullable()->constrained('beds')->nullOnDelete();

            $table->string('name');
            $table->string('type');
            $table->string('firmware_version')->nullable();
            $table->date('last_calibration_date')->nullable();

            $table->string('status')->default('online');
            $table->timestamp('last_seen_at')->nullable();

            $table->json('settings')->nullable();
            $table->timestamps();

            $table->index(['type']);
            $table->index(['status']);
        });

        Schema::create('device_maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices')->cascadeOnDelete();
            $table->string('kind');
            $table->date('scheduled_for')->nullable();
            $table->date('completed_on')->nullable();
            $table->string('status')->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['status']);
            $table->index(['scheduled_for']);
        });

        Schema::create('device_commands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices')->cascadeOnDelete();
            $table->string('command');
            $table->string('status')->default('queued');
            $table->json('payload')->nullable();
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->index(['requested_at']);
        });

        Schema::create('server_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('role')->nullable();
            $table->string('status')->default('online');
            $table->unsignedTinyInteger('cpu_usage')->nullable();
            $table->unsignedTinyInteger('ram_usage')->nullable();
            $table->unsignedTinyInteger('disk_usage')->nullable();
            $table->unsignedTinyInteger('temperature')->nullable();
            $table->unsignedInteger('db_qps')->nullable();
            $table->timestamp('measured_at')->nullable();
            $table->timestamps();
        });

        Schema::create('network_links', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('status')->default('up');
            $table->decimal('latency_ms', 8, 2)->nullable();
            $table->decimal('packet_loss_pct', 5, 2)->nullable();
            $table->string('switch_status')->default('ok');
            $table->string('vlan_integrity')->default('ok');
            $table->string('firewall_status')->default('ok');
            $table->timestamp('measured_at')->nullable();
            $table->timestamps();
        });

        Schema::create('cloud_backups', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->default('cloud');
            $table->timestamp('last_backup_at')->nullable();
            $table->string('sync_status')->default('ok');
            $table->string('encryption_status')->default('enabled');
            $table->unsignedInteger('backup_size_mb')->nullable();
            $table->timestamp('last_recovery_test_at')->nullable();
            $table->string('recovery_test_status')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cloud_backups');
        Schema::dropIfExists('network_links');
        Schema::dropIfExists('server_metrics');
        Schema::dropIfExists('device_commands');
        Schema::dropIfExists('device_maintenance_logs');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('beds');
    }
};
