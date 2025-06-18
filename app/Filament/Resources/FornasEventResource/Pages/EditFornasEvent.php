<?php

namespace App\Filament\Resources\FornasEventResource\Pages;

use App\Filament\Resources\FornasEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFornasEvent extends EditRecord
{
    protected static string $resource = FornasEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
