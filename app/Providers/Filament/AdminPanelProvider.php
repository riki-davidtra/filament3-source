<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Filament\Navigation\MenuItem;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,

                // 'danger' => Color::Red,
                // 'gray' => Color::Zinc,
                // 'info' => Color::Blue,
                // 'primary' => Color::Amber,
                // 'success' => Color::Green,
                // 'warning' => Color::Amber,
            ])
            ->brandName(App::make('settingItems')['site_name']->value ?? 'Site Name')
            ->favicon(
                data_get(App::make('settingItems'), 'favicon.value')
                    ? Storage::url(data_get(App::make('settingItems'), 'favicon.value'))
                    : asset('/assets/images/favicon.png')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
            ])
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            // ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->resources([\App\Filament\Resources\RoleResource::class, \App\Filament\Resources\PermissionResource::class])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setNavigationLabel('My Profile')
                    ->setTitle('My Profile')
                    ->setIcon('heroicon-o-user')
                    // ->slug('my-profile')
                    ->shouldShowAvatarForm(value: true, directory: 'avatars', rules: 'mimes:jpeg,png|max:2048')
                    // ->setSort(1)
                    // ->setNavigationGroup('Group Profile')
                    // ->canAccess(fn () => auth()->user()->id === 1)
                    ->shouldRegisterNavigation(false)
                    ->shouldShowDeleteAccountForm(false),
                // ->shouldShowSanctumTokens()
                // ->shouldShowBrowserSessionsForm() 
                // ->customProfileComponents([
                //     \App\Livewire\CustomProfileComponent::class,
                // ])
                // ])
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()->label(fn() => Auth::user()->name)->url(fn(): string => EditProfilePage::getUrl()),
                // ->icon('heroicon-m-user-circle')
                // ->visible(function (): bool {
                //     return auth()->user()->company()->exists();
                // })
            ])
            ->renderHook('panels::auth.login.form.after', fn() => view('auth.google-sign-in-button'))
            ->theme(asset('css/filament/admin/theme.css'));
    }
}
