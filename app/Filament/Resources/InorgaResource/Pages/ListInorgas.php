<?php

namespace App\Filament\Resources\InorgaResource\Pages;

use App\Filament\Resources\InorgaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInorgas extends ListRecords
{
    protected static string $resource = InorgaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
