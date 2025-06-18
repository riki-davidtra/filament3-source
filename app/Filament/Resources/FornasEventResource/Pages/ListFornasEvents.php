<?php

namespace App\Filament\Resources\FornasEventResource\Pages;

use App\Filament\Resources\FornasEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFornasEvents extends ListRecords
{
    protected static string $resource = FornasEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
