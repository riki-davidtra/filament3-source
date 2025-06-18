<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FornasEventResource\Pages;
use App\Filament\Resources\FornasEventResource\RelationManagers;
use App\Models\FornasEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Storage;

class FornasEventResource extends Resource
{
    protected static ?string $model = FornasEvent::class;

    protected static ?string $navigationIcon   = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup  = 'Manajemen FORNAS';
    protected static ?string $navigationLabel  = 'Acara';
    protected static ?string $pluralModelLabel = 'Daftar Acara';
    protected static ?string $modelLabel       = 'Acara';
    protected static ?int $navigationSort      = 31;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('opening_date')
                    ->label('Tanggal Buka')
                    ->required(),
                Forms\Components\DatePicker::make('closing_date')
                    ->label('Tanggal Tutup')
                    ->required(),
                Forms\Components\TextInput::make('letter_number')
                    ->label('Nomor Surat')
                    ->maxLength(255),
                \Filament\Forms\Components\FileUpload::make('letter_file')
                    ->label('Upload Surat')
                    ->nullable()
                    ->disk('public')
                    ->directory('fornas_events')
                    ->enableOpen()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.ms-powerpoint',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    ])
                    ->helperText('Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX')
                    ->maxSize(5120)
                    ->deleteUploadedFileUsing(function ($file, $record) {
                        Storage::disk('public')->delete($file);
                        $record->update([
                            'letter_file' => null,
                        ]);
                    }),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->nullable()
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('opening_date')
                    ->label('Tanggal Buka')
                    ->sortable()
                    ->searchable()
                    ->color(function ($record) {
                        $today = \Carbon\Carbon::today();
                        $start = \Carbon\Carbon::parse($record->opening_date);
                        $end   = \Carbon\Carbon::parse($record->closing_date);
                        return $today->between($start, $end) ? 'success' : 'danger';
                    }),
                Tables\Columns\TextColumn::make('closing_date')
                    ->label('Tanggal Tutup')
                    ->sortable()
                    ->searchable()
                    ->color(function ($record) {
                        $today = \Carbon\Carbon::today();
                        $start = \Carbon\Carbon::parse($record->opening_date);
                        $end   = \Carbon\Carbon::parse($record->closing_date);
                        return $today->between($start, $end) ? 'success' : 'danger';
                    }),
                Tables\Columns\TextColumn::make('letter_number')
                    ->label('Nomor Surat')
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
                Tables\Actions\ViewAction::make(),
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
            'index'  => Pages\ListFornasEvents::route('/'),
            'create' => Pages\CreateFornasEvent::route('/create'),
            'edit'   => Pages\EditFornasEvent::route('/{record}/edit'),
        ];
    }
}
