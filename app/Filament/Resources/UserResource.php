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
    protected static ?string $navigationGroup  = 'User Management';
    protected static ?string $navigationLabel  = 'Users';
    protected static ?string $pluralModelLabel = 'Users';
    protected static ?string $modelLabel       = 'User';
    protected static ?int $navigationSort      = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\FileUpload::make('avatar_url')
                    ->label('Avatar')
                    ->nullable()
                    ->image()
                    ->disk('public')
                    ->directory('avatars')
                    ->enableOpen()
                    // ->enableDownload()
                    ->maxSize(2048),
                \Filament\Forms\Components\Grid::make(2)
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Name')
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
                            ->confirmed()
                            ->revealable()
                            ->autocomplete('new-password')
                            ->dehydrated(fn($state) => !empty($state)),
                        \Filament\Forms\Components\TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->required(fn(string $context): bool => $context === 'create')
                            ->string()
                            ->minLength(6)
                            ->revealable()
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
                \Filament\Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->width(50)
                    ->height(50)
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->since()
                    ->dateTimeTooltip()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->sortable(),
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
