<?php

namespace App\Filament\Resources\FornasRegistrationResource\Pages;

use App\Filament\Resources\FornasRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFornasRegistrations extends ListRecords
{
    protected static string $resource = FornasRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
