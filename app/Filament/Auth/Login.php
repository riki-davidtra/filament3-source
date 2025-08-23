<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as FilamentDefaultLoginPage;

class Login extends FilamentDefaultLoginPage
{
    protected static string $view = 'filament.pages.login-custom';
}
