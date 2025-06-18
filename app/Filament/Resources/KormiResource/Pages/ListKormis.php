<?php

namespace App\Filament\Resources\KormiResource\Pages;

use App\Filament\Resources\KormiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKormis extends ListRecords
{
    protected static string $resource = KormiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
