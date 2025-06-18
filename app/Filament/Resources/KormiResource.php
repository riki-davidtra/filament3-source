<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KormiResource\Pages;
use App\Filament\Resources\KormiResource\RelationManagers;
use App\Models\Kormi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KormiResource extends Resource
{
    protected static ?string $model = Kormi::class;

    protected static ?string $navigationIcon   = 'heroicon-o-building-office';
    protected static ?string $navigationGroup  = 'Data Master';
    protected static ?string $navigationLabel  = 'KORMI';
    protected static ?string $pluralModelLabel = 'Daftar KORMI';
    protected static ?string $modelLabel       = 'KORMI';
    protected static ?int $navigationSort      = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->string()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->sortable()
                    ->searchable()
                    ->dateTime()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->sortable()
                    ->searchable()
                    ->dateTime()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKormis::route('/'),
            // 'create' => Pages\CreateKormi::route('/create'),
            // 'edit' => Pages\EditKormi::route('/{record}/edit'),
        ];
    }
}
