<?php

use App\Http\Controllers\Admin\DeviceHealthController;
use App\Http\Controllers\Admin\AlertManagementController;
use App\Http\Controllers\Admin\AiConfigController;
use App\Http\Controllers\Admin\EmergencyDataController;
use App\Http\Controllers\Admin\SecurityComplianceController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IcuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('icu.page', ['page' => 'admin/command-center']);
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/icu/{page?}', [IcuController::class, 'page'])
        ->where('page', '.*')
        ->name('icu.page');

    Route::post('/icu/role', [IcuController::class, 'setRole'])->name('icu.setRole');

    Route::post('/admin/users', [UserManagementController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/roles', [UserManagementController::class, 'createRole'])->name('admin.roles.create');
    Route::post('/admin/roles/assign', [UserManagementController::class, 'assignRole'])->name('admin.roles.assign');

    Route::post('/admin/wards', [UserManagementController::class, 'createWard'])->name('admin.wards.create');
    Route::post('/admin/ward-access-rules', [UserManagementController::class, 'createWardAccessRule'])->name('admin.ward_access_rules.create');

    Route::get('/admin/audit-logs.csv', [UserManagementController::class, 'exportAuditCsv'])->name('admin.audit.exportCsv');

    Route::post('/admin/devices/command', [DeviceHealthController::class, 'queueDeviceCommand'])->name('admin.devices.command');
    Route::post('/admin/devices/maintenance', [DeviceHealthController::class, 'scheduleMaintenance'])->name('admin.devices.maintenance');
    Route::post('/admin/cloud/backup', [DeviceHealthController::class, 'triggerBackup'])->name('admin.cloud.backup');

    Route::post('/admin/alerts/ack', [AlertManagementController::class, 'acknowledge'])->name('admin.alerts.ack');
    Route::post('/admin/alerts/resolve', [AlertManagementController::class, 'resolve'])->name('admin.alerts.resolve');
    Route::post('/admin/alerts/escalation-rules', [AlertManagementController::class, 'createEscalationRule'])->name('admin.alerts.escalationRules.create');
    Route::post('/admin/alerts/alarm-settings', [AlertManagementController::class, 'updateAlarmSettings'])->name('admin.alerts.alarmSettings.update');

    Route::post('/admin/security/settings', [SecurityComplianceController::class, 'updateSecuritySettings'])->name('admin.security.settings.update');
    Route::post('/admin/security/compliance', [SecurityComplianceController::class, 'updateComplianceControl'])->name('admin.security.compliance.update');
    Route::post('/admin/security/privacy-controls', [SecurityComplianceController::class, 'updatePrivacyControl'])->name('admin.security.privacyControls.update');
    Route::post('/admin/security/privacy-requests', [SecurityComplianceController::class, 'createPrivacyRequest'])->name('admin.security.privacyRequests.create');
    Route::post('/admin/security/privacy-requests/update', [SecurityComplianceController::class, 'updatePrivacyRequest'])->name('admin.security.privacyRequests.update');

    Route::post('/admin/ai/models', [AiConfigController::class, 'updateAiModel'])->name('admin.ai.models.update');
    Route::post('/admin/ai/reports/run', [AiConfigController::class, 'runReport'])->name('admin.ai.reports.run');

    Route::post('/admin/config/general', [AiConfigController::class, 'updateGeneralSettings'])->name('admin.config.general.update');
    Route::post('/admin/config/integrations', [AiConfigController::class, 'updateIntegration'])->name('admin.config.integrations.update');

    Route::post('/admin/emergency/override', [EmergencyDataController::class, 'updateOverride'])->name('admin.emergency.override.update');
    Route::post('/admin/emergency/surge', [EmergencyDataController::class, 'updateSurgeMode'])->name('admin.emergency.surge.update');
    Route::post('/admin/emergency/lockdown', [EmergencyDataController::class, 'updateLockdown'])->name('admin.emergency.lockdown.update');

    Route::post('/admin/data/backup', [EmergencyDataController::class, 'requestBackup'])->name('admin.data.backup.request');
    Route::post('/admin/data/export', [EmergencyDataController::class, 'requestExport'])->name('admin.data.export.request');

    // User profile and settings routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/settings/account', [ProfileController::class, 'account'])->name('settings.account');
    Route::post('/settings/account', [ProfileController::class, 'updateAccount'])->name('settings.account.update');
    Route::get('/settings/security', [ProfileController::class, 'security'])->name('settings.security');
    Route::post('/settings/security/password', [ProfileController::class, 'updatePassword'])->name('settings.security.password');

    Route::post('/settings/security/2fa/totp/start', [ProfileController::class, 'startTotp'])->name('settings.security.totp.start');
    Route::post('/settings/security/2fa/totp/confirm', [ProfileController::class, 'confirmTotp'])->name('settings.security.totp.confirm');
    Route::post('/settings/security/2fa/totp/disable', [ProfileController::class, 'disableTotp'])->name('settings.security.totp.disable');
});
