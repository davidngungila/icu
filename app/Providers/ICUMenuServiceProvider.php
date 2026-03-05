<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ICUMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share menu configuration with all views
        View::composer(['layouts.app', 'icu.*'], function ($view) {
            $menus = $this->getMenusForRole();
            $view->with('menus', $menus);
        });
    }

    /**
     * Get menus filtered by user role and permissions
     */
    protected function getMenusForRole(): array
    {
        // Get current role from session or default to nurse
        $role = session()->get('icu_role', 'nurse');
        
        // Load appropriate menu configuration based on role
        if ($role === 'nurse') {
            $allMenus = config('icu-nurse-menus', []);
        } else {
            $allMenus = config('icu-menus', []);
        }
        
        // In a real implementation, you would:
        // 1. Get the current user's role/permissions
        // 2. Filter menus based on permissions
        // 3. Sort by priority
        // 4. Add dynamic badge counts
        
        // For now, return all menus sorted by priority
        $menus = collect($allMenus)
            ->sortBy('priority')
            ->toArray();

        // Add dynamic badge counts (in production, this would come from your database)
        $menus = $this->addDynamicBadges($menus);

        return $menus;
    }

    /**
     * Add dynamic badge counts to menu items
     */
    protected function addDynamicBadges(array $menus): array
    {
        foreach ($menus as $key => &$menu) {
            if (isset($menu['badge'])) {
                // In production, these counts would come from your database
                $menu['badge'] = $this->getBadgeData($menu['badge']);
            }

            if (isset($menu['children'])) {
                foreach ($menu['children'] as $childKey => &$child) {
                    if (isset($child['badge'])) {
                        $child['badge'] = $this->getBadgeData($child['badge']);
                    }
                }
            }
        }

        return $menus;
    }

    /**
     * Get badge data with real counts
     */
    protected function getBadgeData(array $badgeConfig): array
    {
        // In production, these would be real database queries
        $mockCounts = [
            'critical' => rand(1, 15),
            'warning' => rand(1, 10),
            'info' => rand(1, 20),
            'success' => rand(1, 5),
        ];

        return [
            'type' => $badgeConfig['type'] ?? 'info',
            'count' => $mockCounts[$badgeConfig['type']] ?? 0,
            'pulse' => $badgeConfig['pulse'] ?? false,
        ];
    }
}
