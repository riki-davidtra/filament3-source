<?php

namespace App\Filament\Resources\InorgaResource\Pages;

use App\Filament\Resources\InorgaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInorga extends EditRecord
{
    protected static string $resource = InorgaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
