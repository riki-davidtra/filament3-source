<?php

namespace App\Filament\Schemas;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Facades\Storage;

class FornasParticipantSchema
{
    public static function form(): array
    {
        return [
            Forms\Components\TextInput::make('nama_lengkap')
                ->label('Nama Lengkap')
                ->required()
                ->string()
                ->maxLength(255),
            Forms\Components\Select::make('inorga_id')
                ->label('JENOR/Kategori')
                ->required()
                ->searchable()
                ->preload()
                ->relationship('inorga', 'name', fn($query) => $query->orderBy('name', 'asc'))
                ->getOptionLabelFromRecordUsing(fn($record) => "{$record->abbreviation} ({$record->name})"),
            Forms\Components\TextInput::make('nik')
                ->label('NIK')
                ->required()
                ->string()
                ->maxLength(16),
            Forms\Components\DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->required(),
            Forms\Components\Select::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->required()
                ->options([
                    'Laki-Laki' => 'Laki-Laki',
                    'Perempuan' => 'Perempuan',
                ]),
            Forms\Components\TextInput::make('no_hp')
                ->label('No HP')
                ->required()
                ->tel(),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->required()
                ->email()
                ->maxLength(255),
            Forms\Components\Select::make('ukuran_baju')
                ->label('Ukuran Baju')
                ->required()
                ->options([
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL',
                    'XXL' => 'XXL',
                ]),
            Forms\Components\TextInput::make('jenis_peserta')
                ->label('Jenis Peserta')
                ->required()
                ->string()
                ->maxLength(255),
            Forms\Components\DatePicker::make('tanggal_berangkat')
                ->label('Tanggal Berangkat')
                ->required(),
            Forms\Components\DatePicker::make('tanggal_pulang')
                ->label('Tanggal Pulang')
                ->required(),
            Forms\Components\TextInput::make('penginapan')
                ->label('Penginapan')
                ->required()
                ->string()
                ->maxLength(255),

            Forms\Components\Fieldset::make('Berkas Peserta')
                ->relationship('fornasParticipantFile')
                ->schema([
                    \Filament\Forms\Components\FileUpload::make('ktp')
                        ->label('Upload KTP')
                        ->required()
                        ->disk('public')
                        ->directory('fornas_participant_files')
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
                                'ktp' => null,
                            ]);
                        }),
                    \Filament\Forms\Components\FileUpload::make('kk')
                        ->label('Upload Kartu Keluarga')
                        ->required()
                        ->disk('public')
                        ->directory('fornas_participant_files')
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
                                'kk' => null,
                            ]);
                        }),
                    \Filament\Forms\Components\FileUpload::make('kartu_bpjs')
                        ->label('Upload Kartu BPJS')
                        ->required()
                        ->disk('public')
                        ->directory('fornas_participant_files')
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
                                'kartu_bpjs' => null,
                            ]);
                        }),
                    \Filament\Forms\Components\FileUpload::make('surat_keterangan_sehat')
                        ->label('Upload Surat Keterangan Sehat')
                        ->required()
                        ->disk('public')
                        ->directory('fornas_participant_files')
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
                                'surat_keterangan_sehat' => null,
                            ]);
                        }),
                ]),
        ];
    }

    public static function table(): array
    {
        return [
            Tables\Columns\TextColumn::make('nama_lengkap')
                ->label('Nama Lengkap')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('inorga.abbreviation')
                ->label('JENOR/Kategori')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn($state, $record) => "{$state} ({$record->inorga->name})"),
            Tables\Columns\TextColumn::make('nik')
                ->label('NIK')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('no_hp')
                ->label('No. HP')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('ukuran_baju')
                ->label('Ukuran Baju')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('jenis_peserta')
                ->label('Jenis Peserta')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('tanggal_berangkat')
                ->label('Tanggal Berangkat')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('tanggal_pulang')
                ->label('Tanggal Pulang')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('penginapan')
                ->label('Penginapan')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->sortable()
                ->searchable()
                ->dateTime()
                ->since()
                ->dateTimeTooltip()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Diperbarui')
                ->sortable()
                ->searchable()
                ->dateTime()
                ->since()
                ->dateTimeTooltip()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
