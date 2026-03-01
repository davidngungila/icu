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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->string('language', 10)->nullable();
            $table->string('timezone', 50)->nullable();
            $table->string('date_format', 10)->nullable();
            $table->string('time_format', 5)->nullable();
            $table->string('theme', 10)->nullable();
            $table->boolean('notifications_email')->default(false);
            $table->boolean('notifications_push')->default(false);
            $table->boolean('notifications_sms')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'department',
                'title',
                'language',
                'timezone',
                'date_format',
                'time_format',
                'theme',
                'notifications_email',
                'notifications_push',
                'notifications_sms',
            ]);
        });
    }
};
