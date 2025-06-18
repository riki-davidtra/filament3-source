<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Storage;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon   = 'heroicon-o-users';
    protected static ?string $navigationGroup  = 'Manajemen Pengguna';
    protected static ?string $navigationLabel  = 'Pengguna';
    protected static ?string $pluralModelLabel = 'Daftar Pengguna';
    protected static ?string $modelLabel       = 'Pengguna';
    protected static ?int $navigationSort      = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\FileUpload::make('avatar_url')
                    ->label('Foto')
                    ->nullable()
                    ->image()
                    ->directory('avatars')
                    ->disk('public')
                    ->enableOpen()
                    // ->enableDownload()
                    ->maxSize(2048)
                    ->deleteUploadedFileUsing(function ($file, $record) {
                        Storage::disk('public')->delete($file);
                        $record->update([
                            'avatar_url' => null,
                        ]);
                    }),
                \Filament\Forms\Components\Grid::make(2)
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->string()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->string()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        \Filament\Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->string()
                            ->maxLength(255)
                            ->email()
                            ->unique(ignoreRecord: true),
                        \Filament\Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn(string $context): bool => $context === 'create')
                            ->string()
                            ->minLength(6)
                            ->dehydrated(fn($state) => !empty($state))
                            ->confirmed(),
                        \Filament\Forms\Components\TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->required(fn(string $context): bool => $context === 'create')
                            ->string()
                            ->minLength(6)
                            ->dehydrated(fn($state) => !empty($state)),
                        \Filament\Forms\Components\Select::make('roles')
                            ->label('Roles')
                            ->nullable()
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),
                    ]),
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
                \Filament\Tables\Columns\TextColumn::make('username')
                    ->label('Username')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Foto')
                    ->sortable()
                    ->searchable()
                    ->width(50)
                    ->height(50),
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
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
