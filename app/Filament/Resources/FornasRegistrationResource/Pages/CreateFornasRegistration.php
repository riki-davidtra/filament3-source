<?php

namespace App\Filament\Resources\FornasRegistrationResource\Pages;

use App\Filament\Resources\FornasRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFornasRegistration extends CreateRecord
{
    protected static string $resource = FornasRegistrationResource::class;

    public function getRedirectUrl(): string
    {
        return FornasRegistrationResource::getUrl('index');
    }
}
