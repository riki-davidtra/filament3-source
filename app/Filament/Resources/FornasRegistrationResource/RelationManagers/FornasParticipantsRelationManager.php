<?php

namespace App\Filament\Resources\FornasRegistrationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Schemas\FornasParticipantSchema;

class FornasParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'fornasParticipants';
    protected static ?string $title = 'Daftar Peserta';
    protected static ?string $modelLabel = 'Peserta';

    public function form(Form $form): Form
    {
        return $form->schema(FornasParticipantSchema::form());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_lengkap')
            ->defaultSort('created_at', 'desc')
            ->columns(FornasParticipantSchema::table())
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
