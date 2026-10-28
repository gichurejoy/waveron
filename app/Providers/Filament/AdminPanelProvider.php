<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\LeadsOverviewWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->domain(env('FILAMENT_DOMAIN', 'admin.waverontechnologies.co.ke'))
            ->login()
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->font('Inter')
            ->colors([
                'primary'   => Color::Emerald,
                'gray'      => Color::Slate,
                'info'      => Color::Sky,
                'success'   => Color::Emerald,
                'warning'   => Color::Amber,
                'danger'    => Color::Rose,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn (): string => \Illuminate\Support\Facades\Blade::render('
                    @vite(["resources/css/app.css"])
                    <script>
                        (function() {
                            const savedWidth = localStorage.getItem("filament-sidebar-width");
                            if (savedWidth) {
                                document.documentElement.style.setProperty("--sidebar-width", `${savedWidth}px`);
                            }
                            
                            // Ctrl+K / Cmd+K listener to focus global search
                            document.addEventListener("keydown", function(e) {
                                if ((e.metaKey || e.ctrlKey) && e.key === "k") {
                                    e.preventDefault();
                                    document.querySelector(".fi-global-search input, div.fi-global-search-field input, input[placeholder*=\"Search\"]")?.focus();
                                }
                            });
                        })();
                    </script>
                '),
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::BODY_END,
                fn (): string => view('filament.partials.resizable-sidebar')->render(),
            )
            ->navigationGroups([
                'Leads & Inquiries',
                'Careers & Referrals',
                'Financial Ledgers',
                'Content Management',
                'System',
            ])
            ->brandName('Waveron Admin')
            ->brandLogo(fn () => view('filament.partials.sidebar-header'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                LeadsOverviewWidget::class,
                \App\Filament\Widgets\FinancialOverviewWidget::class,
                \App\Filament\Widgets\RecentLeadsWidget::class,
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
