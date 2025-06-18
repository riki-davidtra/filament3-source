<?php

namespace App\Filament\Resources\FornasRegistrationResource\Pages;

use App\Filament\Resources\FornasRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class EditFornasRegistration extends EditRecord
{
    protected static string $resource = FornasRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getRedirectUrl(): string
    {
        return FornasRegistrationResource::getUrl('index');
    }

    public function mount($record): void
    {
        parent::mount($record);

        $record = $this->getRecord();

        if (!Auth::user()->hasAnyRole(['Super Admin', 'admin']) && $record->status !== 'Tidak Lengkap') {
            Notification::make()
                ->danger()
                ->title('Akses Ditolak')
                ->body('Anda tidak memiliki izin untuk mengedit data ini.')
                ->send();

            $this->redirect(FornasRegistrationResource::getUrl('index'));
        }
    }
}
