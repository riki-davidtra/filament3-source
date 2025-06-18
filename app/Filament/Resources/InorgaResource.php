<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InorgaResource\Pages;
use App\Filament\Resources\InorgaResource\RelationManagers;
use App\Models\Inorga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InorgaResource extends Resource
{
    protected static ?string $model = Inorga::class;

    protected static ?string $navigationIcon   = 'heroicon-o-fire';
    protected static ?string $navigationGroup  = 'Data Master';
    protected static ?string $navigationLabel  = 'INORGA';
    protected static ?string $pluralModelLabel = 'Daftar INORGA';
    protected static ?string $modelLabel       = 'INORGA';
    protected static ?int $navigationSort      = 22;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->string()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('abbreviation')
                    ->label('Singkatan')
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
                \Filament\Tables\Columns\TextColumn::make('abbreviation')
                    ->label('Singkatan')
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
            'index'  => Pages\ListInorgas::route('/'),
            // 'create' => Pages\CreateInorga::route('/create'),
            // 'edit'   => Pages\EditInorga::route('/{record}/edit'),
        ];
    }
}
