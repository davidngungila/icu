<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class MenuService
{
    /**
     * Get filtered menus for the current user
     */
    public function getMenusForUser(): array
    {
        $user = Auth::user();
        
        if (!$user) {
            return $this->getPublicMenus();
        }

        return Cache::remember(
            "user_menus_{$user->id}_{$user->role}",
            now()->addMinutes(5),
            function () use ($user) {
                return $this->filterMenusByPermissions(
                    config('icu-menus', []),
                    $user->getPermissions()
                );
            }
        );
    }

    /**
     * Get menus available to the public
     */
    protected function getPublicMenus(): array
    {
        return collect(config('icu-menus', []))
            ->filter(function ($menu) {
                return in_array('public', $menu['permissions'] ?? []);
            })
            ->sortBy('priority')
            ->toArray();
    }

    /**
     * Filter menus based on user permissions
     */
    protected function filterMenusByPermissions(array $menus, array $userPermissions): array
    {
        $filteredMenus = [];

        foreach ($menus as $key => $menu) {
            if ($this->hasPermission($menu['permissions'] ?? [], $userPermissions)) {
                $filteredMenu = $menu;
                
                // Filter children if they exist
                if (isset($menu['children']) && is_array($menu['children'])) {
                    $filteredMenu['children'] = $this->filterChildrenByPermissions(
                        $menu['children'],
                        $userPermissions
                    );
                }

                $filteredMenus[$key] = $filteredMenu;
            }
        }

        return collect($filteredMenus)
            ->sortBy('priority')
            ->toArray();
    }

    /**
     * Filter child menu items by permissions
     */
    protected function filterChildrenByPermissions(array $children, array $userPermissions): array
    {
        return collect($children)
            ->filter(function ($child) use ($userPermissions) {
                return $this->hasPermission($child['permissions'] ?? [], $userPermissions);
            })
            ->toArray();
    }

    /**
     * Check if user has required permissions
     */
    protected function hasPermission(array $requiredPermissions, array $userPermissions): bool
    {
        // If no permissions are required, allow access
        if (empty($requiredPermissions)) {
            return true;
        }

        // Check if user has any of the required permissions
        return !empty(array_intersect($requiredPermissions, $userPermissions));
    }

    /**
     * Get real-time badge counts
     */
    public function getBadgeCounts(): array
    {
        return Cache::remember('menu_badge_counts', now()->addMinute(), function () {
            return [
                'critical_alerts' => $this->getCriticalAlertCount(),
                'warning_alerts' => $this->getWarningAlertCount(),
                'unread_messages' => $this->getUnreadMessageCount(),
                'pending_tasks' => $this->getPendingTaskCount(),
                'device_issues' => $this->getDeviceIssueCount(),
            ];
        });
    }

    /**
     * Get critical alert count
     */
    protected function getCriticalAlertCount(): int
    {
        // In production, this would query your alerts table
        return \App\Models\Alert::where('severity', 'critical')
            ->where('acknowledged', false)
            ->count();
    }

    /**
     * Get warning alert count
     */
    protected function getWarningAlertCount(): int
    {
        // In production, this would query your alerts table
        return \App\Models\Alert::where('severity', 'warning')
            ->where('acknowledged', false)
            ->count();
    }

    /**
     * Get unread message count
     */
    protected function getUnreadMessageCount(): int
    {
        // In production, this would query your messages table
        return \App\Models\Message::where('read_at', null)
            ->where('recipient_id', Auth::id())
            ->count();
    }

    /**
     * Get pending task count
     */
    protected function getPendingTaskCount(): int
    {
        // In production, this would query your tasks table
        return \App\Models\Task::where('assigned_to', Auth::id())
            ->where('status', 'pending')
            ->count();
    }

    /**
     * Get device issue count
     */
    protected function getDeviceIssueCount(): int
    {
        // In production, this would query your devices table
        return \App\Models\Device::where('status', 'error')
            ->orWhere('status', 'warning')
            ->count();
    }

    /**
     * Clear menu cache for a user
     */
    public function clearUserMenuCache(int $userId): void
    {
        $user = \App\Models\User::find($userId);
        if ($user) {
            Cache::forget("user_menus_{$user->id}_{$user->role}");
        }
    }

    /**
     * Clear badge cache
     */
    public function clearBadgeCache(): void
    {
        Cache::forget('menu_badge_counts');
    }
}
